<?php

# GET /
function main_page() {
    return html('main.html.php');
}

function gpio_key() {
	return (rand(0, 1)) ? "button on" : "button off";
}

function gpio_state() {
	$id = filter_var(params('id'), FILTER_VALIDATE_INT);
	$state = filter_var(params('state'), FILTER_VALIDATE_INT);
	error_log($id."=".$state);

//led 40 & 45
//1 = off, 0 = on
//$gpio_on = shell_exec('gpio write 1 1');
// echo 40 > /sys/class/gpio/export
// echo out >/sys/class/gpio/gpio40/direction
// echo 1 >/sys/class/gpio/gpio40/value
//switch 90 & 92 not working propably needs a 4.7K pull-down resistor?
// cat /sys/class/gpio/gpio90/active_low	
// echo both > /sys/class/gpio/gpio90/edge
// rising / falling / both / none

	shell_exec('echo '.$id.' > /sys/class/gpio/export');
	shell_exec('echo out >/sys/class/gpio/gpio'.$id.'/direction');
	shell_exec('echo '.$state.' >/sys/class/gpio/gpio'.$id.'/value');

    return html('dashboard.html.php');
}

function canKeyOpenDoor($key, $door) {
	if($key == "00010011101100010011011101") {
		return true;
	}
	return false;
}