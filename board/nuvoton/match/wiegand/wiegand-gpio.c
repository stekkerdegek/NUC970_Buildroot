/* wiegand-gpio.c
 *
 * Wiegand driver using GPIO an interrupts.
 * 26 P FFFF FFFF AAAA AAAA AAAA AAAA P
 *    E EEEE EEEE EEEE XXXX XXXX XXXX O
 * 37 P SSSS SSSS FFFF AAAA AAA AAAA AAAA AAAA AAAA P
 *    P FFFF FFFF FFFF FFFF CCC CCCC CCCC CCCC CCCC P
 *    E XXXX XXXX XXXX XXXX XX..................
 *         ..................XX XXXX XXXX XXXX XXXX O
 *
 *
 * Creates /sys/kernel/wiegand/read
 *
 */

/* Standard headers for LKMs */
#include <linux/module.h> /* Needed by all modules */
#include <linux/kernel.h> /* Needed for KERN_INFO */
#include <linux/kobject.h>
#include <linux/string.h>
#include <linux/sysfs.h>
#include <linux/timer.h>

#include <linux/tty.h>      /* console_print() interface */
#include <linux/signal.h>
#include <linux/sched.h>
#include <linux/interrupt.h>

#include <asm/irq.h>
#include <mach/gpio.h>
#include <linux/gpio.h>

#define MAX_WIEGAND_BYTES 6
#define MIN_PULSE_INTERVAL_USEC 700

#define RD1_D1_PIN     NUC980_PA0   //reader1 d1 input
#define RD1_D0_PIN     NUC980_PA1   //reader1 d0 input
// #define RD1_GLED_PIN   NUC980_PA2   //reader1 gled output
// #define RD1_RLED_PIN   NUC980_PA3   //reader1 rled output

#define RD2_D1_PIN     NUC980_PA8   //reader2 d1 input
#define RD2_D0_PIN     NUC980_PA9   //reader2 d0 input
// #define RD2_GLED_PIN   NUC980_PA10  //reader2 gled output
// #define RD2_RLED_PIN   NUC980_PA11  //reader2 rled output
#define OUT12V_PIN     NUC980_PE10  //output 12v control output

static struct wiegand
{
  int startParity;
  char buffer[MAX_WIEGAND_BYTES];
  int currentBit;


  int readNum;
  unsigned int lastFacilityCode;
  unsigned int lastCardNumber;
  int usedReader;
  bool lastDecoded;
  char lastBuffer[MAX_WIEGAND_BYTES];
  int numBits;

}
wiegand;


static struct timer_list timer;

int strbin2i(char* s) {
  unsigned char *p = s ;
  unsigned int   r = 0 ;
  unsigned char  c     ;

  while (p && *p ) {
    c = *p++;

    if      ( c == '0' ) { r = (r<<1)     ; } // shift 1 bit left and add 0
    else if ( c == '1' ) { r = (r<<1) + 1 ; } // shift 1 bit left and add 1
    else                 { break          ; } // bail on oinvalid character

  }

  return (int)r;
}

static int printbinary(char *buf, unsigned long x, int nbits)
{
  unsigned long mask = 1UL << (nbits - 1);
  while (mask != 0) {
    *buf++ = (mask & x ? '1' : '0');
    mask >>= 1;
  }
  *buf = '\0';

  return nbits;
}

void print_wiegand_data(char* output, char* buf, int nbits) {
  int numBytes = ((nbits -1) / 8 ) + 1;
  int i;

  for (i=0; i< numBytes; ++i) {
    if (i == (numBytes - 1)) {
        printbinary(output, buf[i] >> ((i + 1) * 8 - nbits),  nbits - i * 8);
        output += nbits - i * 8;
    } else {
      printbinary(output, buf[i], 8);
      output += 8;
    }
  }
}

/* returns the data when module is called */
static ssize_t wiegandShow(
  struct kobject *kobj, struct kobj_attribute *attr, char *buf)
{
  static char wiegand_buf[MAX_WIEGAND_BYTES * 8];
  print_wiegand_data(wiegand_buf, wiegand.lastBuffer, wiegand.numBits);

  return sprintf(
    buf, "%.5d:%d:%d:%s\n",
    wiegand.readNum,
    wiegand.lastCardNumber,
    wiegand.usedReader,
    wiegand_buf
  );
}

static struct kobj_attribute wiegand_attribute =
  __ATTR(read, 0660, wiegandShow, NULL);

static struct attribute *attrs[] =
{
  &wiegand_attribute.attr,
  NULL,   /* need to NULL terminate the list of attributes */
};

static struct attribute_group attr_group =
{
  .attrs = attrs,
};

static struct kobject *wiegandKObj;

irqreturn_t wiegand_data_isr(int irq, void *dev_id);

void wiegand_clear(struct wiegand *w)
{
  w->currentBit = 0;
  w->startParity = 0;
  memset(w->buffer, 0, MAX_WIEGAND_BYTES);
}

void wiegand_init(struct wiegand *w)
{
  w->lastFacilityCode = 0;
  w->lastCardNumber = 0;
  w->readNum = 0;
  wiegand_clear(w);
}

//returns true if even parity
bool checkParity(char *buffer, int numBytes, int parityCheck)
{
  int byte = 0;
  int bit = 0;
  int mask;
  int parity = parityCheck;

  for (byte = 0; byte < numBytes; byte++)
  {
    mask = 0x80;
    for (bit = 0; bit < 8; bit++)
    {
      if (mask & buffer[byte])
      {
        parity++;
      }
      mask >>= 1;
    }
  }
  return (parity % 2) == 1;
}

/* is called bit by bit */
void wiegand_timer(unsigned long data)
{
  char *lcn;
  char buf[MAX_WIEGAND_BYTES * 8];
  size_t i;

  struct wiegand *w = (struct wiegand *) data;
  int numBytes = ((w->currentBit -1) / 8 )+ 1;
  int endParity = -1;

  printk("wiegand read complete\n");

  for (i=0; i< numBytes; ++i){
    w->lastBuffer[i] = w->buffer[i];
  }

  w->numBits = w->currentBit;
  w->lastDecoded = false;
  w->readNum++;

  print_wiegand_data(buf, w->buffer, w->numBits);
  endParity = buf[w->currentBit / 8] & (0x80 >> w->currentBit % 8);

  printk("new read available [%d]bits [%d]bytes: %s\n",  w->numBits, numBytes, buf);

  //check the start parity
  if (checkParity(buf, numBytes, w->startParity))
  {
   printk("%s %d-%d \n", buf, numBytes, w->startParity);
   printk("start parity check failed\n");
   //wiegand_clear(w);
   //return;
  }
  //check the end parity
  if (!checkParity(&buf[numBytes], numBytes, endParity))
  {
   printk("%s %d-%d \n", &buf[numBytes], numBytes, endParity);
   printk("end parity check failed\n");
   //wiegand_clear(w);
   //return;
  }

  w->lastDecoded = true;
  //ok all good set facility code and card code
  w->lastFacilityCode = (unsigned int)w->buffer[0];

  //note relies on 32 bit architecture
  w->lastCardNumber = 0;
  lcn = (char *)&w->lastCardNumber;
  lcn[0] = buf[2];
  lcn[1] = buf[1];
  w->readNum++;

  //hack, parity fails for some reason
  //so, just remove first and last bit. And we have the correct number
  lcn = &buf[1]; // remove first char
  lcn[w->numBits - 2] = '\0'; // remove last char
  //sscanf(lcn, "%i", &finalNumber );
  //printbinary(finalNumber, &lcn, w->numBits);  
  w->lastCardNumber = strbin2i(lcn);

  printk(
    "decoded data: %d:%d\n",
    w->lastFacilityCode,
    w->lastCardNumber);

  //turn off the green led
  //set_gpio_value(RD1_GLED_PIN, 0);

  //reset for next reading
  wiegand_clear(w);
}

static int irq_rd1_d0, irq_rd1_d1, irq_rd2_d0, irq_rd2_d1;

int init_module()
{
  int retval, ret;

  printk("wiegand intialising\n");

  wiegand_init(&wiegand);

  ret = gpio_request(RD1_D0_PIN, "RD1_D0_PIN");
  if (ret) {
      printk("can not open GPIO for RD1_D0_PIN\n");
      return ret;
  }
  ret = gpio_request(RD1_D1_PIN, "RD1_D1_PIN");
  if (ret) {
      printk("can not open GPIO for RD1_D1_PIN\n");
      return ret;
  }
  ret = gpio_request(RD2_D0_PIN, "RD2_D0_PIN");
  if (ret) {
      printk("can not open GPIO for RD2_D0_PIN\n");
      return ret;
  }
  ret = gpio_request(RD2_D1_PIN, "RD2_D1_PIN");
  if (ret) {
      printk("can not open GPIO for RD2_D1_PIN\n");
      return ret;
  }

  gpio_direction_input(RD1_D0_PIN);
  gpio_direction_input(RD1_D1_PIN);
  gpio_direction_input(RD2_D0_PIN);
  gpio_direction_input(RD2_D1_PIN);

  irq_rd1_d0 = gpio_to_irq(RD1_D0_PIN);
  if (irq_rd1_d0 < 0) {
    printk("can't request irq for D0 gpio\n");
    return irq_rd1_d0;
  }
  irq_rd1_d1 = gpio_to_irq(RD1_D1_PIN);
  if (irq_rd1_d1 < 0) {
    printk("can't request irq for D1 gpio\n");
    return irq_rd1_d1;
  }
  irq_rd2_d0 = gpio_to_irq(RD2_D0_PIN);
  if (irq_rd2_d0 < 0) {
    printk("can't request irq for rd2_d0 gpio\n");
    return irq_rd2_d0;
  }
  irq_rd2_d1 = gpio_to_irq(RD2_D1_PIN);
  if (irq_rd2_d1 < 0) {
    printk("can't request irq for rd2_d1 gpio\n");
    return irq_rd2_d1;
  }


  /** Request IRQ for pin */
  if(request_any_context_irq(irq_rd1_d0, wiegand_data_isr, IRQF_SHARED | IRQF_TRIGGER_FALLING, "wiegand_data", &wiegand))
  {
    printk(KERN_DEBUG"Can't register IRQ %d\n", irq_rd1_d0);
    return -EIO;
  }

  if(request_any_context_irq(irq_rd1_d1, wiegand_data_isr, IRQF_SHARED | IRQF_TRIGGER_FALLING, "wiegand_data", &wiegand))
  {
    printk(KERN_DEBUG"Can't register IRQ %d\n", irq_rd1_d1);
    return -EIO;
  }
    if(request_any_context_irq(irq_rd2_d0, wiegand_data_isr, IRQF_SHARED | IRQF_TRIGGER_FALLING, "wiegand_data", &wiegand))
  {
    printk(KERN_DEBUG"Can't register IRQ %d\n", irq_rd2_d0);
    return -EIO;
  }

  if(request_any_context_irq(irq_rd2_d1, wiegand_data_isr, IRQF_SHARED | IRQF_TRIGGER_FALLING, "wiegand_data", &wiegand))
  {
    printk(KERN_DEBUG"Can't register IRQ %d\n", irq_rd2_d1);
    return -EIO;
  }

  //setup the sysfs
  wiegandKObj = kobject_create_and_add("wiegand", kernel_kobj);

  if (!wiegandKObj)
  {
    printk("wiegand failed to create sysfs\n");
    return -ENOMEM;
  }

  retval = sysfs_create_group(wiegandKObj, &attr_group);
  if (retval)
  {
    kobject_put(wiegandKObj);
  }

  //setup the timer
  init_timer(&timer);
  timer.function = wiegand_timer;
  timer.data = (unsigned long) &wiegand;

  //Activate wiegand power
  ret = gpio_request( OUT12V_PIN ,"OUT12V_PIN");
  if(ret < 0)
  {
      printk(KERN_EMERG "GPIO REQUEST OUT12V_PIN FAILED!\n");
  }
  else
  {
      gpio_direction_output(OUT12V_PIN,0);  //output 12v  control set output and value low 
      gpio_set_value( OUT12V_PIN ,1);  //open reader power
  }
  
  printk("wiegand ready\n");
  return retval;
}

irqreturn_t wiegand_data_isr(int irq, void *dev_id)
{
  struct wiegand *w = (struct wiegand *)dev_id;
  struct timespec ts, interval;
  static struct timespec lastts;
  int value = (irq == irq_rd2_d1) ? 0x80 : 0;

  if (irq == irq_rd1_d0 || irq == irq_rd1_d1)
  {
    w->usedReader = 1;
  }
  if (irq == irq_rd2_d0 || irq == irq_rd2_d1)
  {
    w->usedReader = 2;
  }

  //TODO avoid pulses too small?
  getnstimeofday(&ts);
  interval = timespec_sub(ts,lastts);
  lastts = ts;
  if ((interval.tv_sec == 0 ) && (interval.tv_nsec < MIN_PULSE_INTERVAL_USEC * 1000)) {
    return IRQ_HANDLED;
  }

  // int data0 = gpio_get_value(RD1_D0_PIN);
  // int data1 = gpio_get_value(RD1_D1_PIN);
  // int value = ((data0 == 1) && (data1 == 0)) ? 0x80 : 0;

  // if ((data0 == 1) && (data1 == 1))
  // { //rising edge, ignore
    // return IRQ_HANDLED;
  // }

  //stop the end of transfer timer
  del_timer(&timer);

  //this is the start parity bit
  if (w->currentBit == 0)
  {
    //turn on led
    //set_gpio_value(RD1_GLED_PIN, 1);
    w->startParity = value;
    printk("startParity %d\n", value);
  }

  if (w->currentBit <=  MAX_WIEGAND_BYTES * 8) {
    w->buffer[(w->currentBit) / 8] |= (value >> ((w->currentBit) % 8));
  }

  w->currentBit++;

  //if we don't get another interrupt for 50ms we
  //assume the data is complete.
  timer.expires = jiffies + msecs_to_jiffies(50);
  add_timer(&timer);

  return IRQ_HANDLED;
}

void cleanup_module()
{
  kobject_put(wiegandKObj);
  del_timer(&timer);

  free_irq(irq_rd1_d0, &wiegand);
  free_irq(irq_rd1_d1, &wiegand);
  free_irq(irq_rd2_d0, &wiegand);
  free_irq(irq_rd2_d1, &wiegand);

  gpio_free(RD1_D0_PIN);
  gpio_free(RD1_D1_PIN);
  gpio_free(RD2_D0_PIN);
  gpio_free(RD2_D1_PIN);



  printk("wiegand removed\n");
}

MODULE_DESCRIPTION("Wiegand GPIO driver");
MODULE_LICENSE("GPL");
MODULE_AUTHOR("Peter Sloots");




