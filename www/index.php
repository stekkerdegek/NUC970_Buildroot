<?php 
$title = "Dashboard";
$id = 0;

include 'header.php';

?>

<div class="content">
    <div class="container-fluid">
       <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Master controller</h4>
                        <p class="card-category">Select a LED and press Submit to turn it on/off on the NK-980IOT board</p>
<div id="led_content">
    <form id="led_form" action="cgi-bin/led.cgi" method="GET">
        <table width="300" border="1">
            <tr>
                <td>LED1 - yellow</td>
                <td>LED2 - red</td>
            </tr>
            <tr>
                <td>
                    <input type="radio" id="LED1" name="LED1" value="1">ON <br>
                    <input type="radio" id="LED1" name="LED1" value="0" checked>OFF
                </td>
                <td>
                    <input type="radio" id="LED2" name="LED2" value="1">ON <br>
                    <input type="radio" id="LED2" name="LED2" value="0" checked>OFF
                </td>
            </tr>
        </table>
        <br>
        <input type="submit" id="led_submit" value="Submit" />
    </form>
</div>
<div id="ledimg_content"  style="display:none">
    <img id="led_img" src="LED_1_off_2_off.jpg">
</div>
                    
        <form action="test/form.sh" method="get">
            Choose backlight value: <br>
            <input id="slider1" type="range" name="pwm" min="0" max="7" step="1" onchange="textbox1.value = slider1.value" /><br>
            <input id="textbox1" type="text" /><br>
            <input type="submit" value="Change it!">
        </form>

<a href="https://docs.google.com/document/d/1ZOc3w04Ov9EECDrhrmd3qmBAxG5lbiUyGuRfasSbtHw/edit" target="docs">Here</a> you can find extra documentation
                    </div>
                    <div class="card-body">
                                This controller has
                        <div class="typography-line">
                            <p>
                                <span>Hardware</span>

                                <ul>
                                    <li>2 relays inputs - to connect to doorlocks</li>
                                    <li>2 wiegand inputs - to connect to keypad or NFC reader</li>
                                    <li>UTP connector - to connect to an LAN</li>
                                    <li>A voltage in - to connect 12 or 24V</li>
                                </ul>

                            </p>
                        </div>
                        <div class="typography-line">
                            <span>Configuration</span>
                            <blockquote>
                                <p class="blockquote blockquote-primary">
                                    <ol>
                                    <li>Add doors from this Master controller, or from other Slave controllers</li>
                                    <li>Add timezones (24h and working hours are predefined)</li>
                                    <li>Create groups with timezones</li>
                                    <li>Create users and assign them to a group</li>
                                    <li>Add keypad code or NFC token to the user</li>
                                </ol>
                                    <br>
                                    <br>
                                    <small>
                                        - these pages are mockups, to show future possibilities
                                    </small>
                                </p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>              
        </div>
    </div>
</div>

<?php include 'footer.php';?>
