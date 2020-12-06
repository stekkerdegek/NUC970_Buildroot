<?php
set('id', -1);
set('title', 'Main');
?>


<center>
<strong>Desk lights:
<form action="index.php">
        <input type="submit" class="btn btn-info btn-lg" value="On" name="r-on">
        <input type="submit" class="btn btn-danger btn-lg" value="Off" name="r-off">
</form>
Fan:
<form action="index.php">
        <input type="submit" class="btn btn-info btn-lg" value="On" name="w-on">
        <input type="submit" class="btn btn-danger btn-lg" value="Off" name="w-off">
</form>
Switch 3:
<form action="index.php">
        <input type="submit" class="btn btn-info btn-lg" value="On" name="sw3-on">
        <input type="submit" class="btn btn-danger btn-lg" value="Off" name="sw3-off">
</form>
Switch 4:</strong>
<form action="index.php">
        <input type="submit" class="btn btn-info btn-lg" value="On" name="sw4-on">
        <input type="submit" class="btn btn-danger btn-lg" value="Off" name="sw4-off">
</form>
</center>
<?php
if(isset($_GET['r-on'])){
        $gpio_on = shell_exec('gpio write 1 1');
}
else if(isset($_GET['r-off'])){
        $gpio_off = shell_exec('gpio write 1 0');
}
if(isset($_GET['w-on'])){
        $gpio_on = shell_exec('gpio write 2 1');
}
else if(isset($_GET['w-off'])){
        $gpio_off = shell_exec('gpio write 2 0');
}
if(isset($_GET['sw3-on'])){
        $gpio_on = shell_exec('gpio write 3 1');
}
else if(isset($_GET['sw3-off'])){
        $gpio_off = shell_exec('gpio write 3 0');
}
if(isset($_GET['sw4-on'])){
        $gpio_on = shell_exec('gpio write 4 1');
}
else if(isset($_GET['sw4-off'])){
        $gpio_off = shell_exec('gpio write 4 0');
}
?>





<ul>
  <li><?php echo link_to('Authors', 'authors') ?></li>
  <li><?php echo link_to('Books', 'books') ?></li>
</ul>
