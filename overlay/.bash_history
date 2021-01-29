tail -f /var/log/php_errors.log
tail -f /var/log/lighttpd-error.log
/etc/init.d/S50sshd restart
vi /etc/lighttpd/lighttpd.conf
/etc/init.d/S50lighttpd restart
ls -la /maasland_app/
rmmod /root/wiegand-gpio.ko && insmod /root/wiegand-gpio.ko && /scripts/wieg.sh
insmod /root/wiegand-gpio.ko
/scripts/wieg.sh
