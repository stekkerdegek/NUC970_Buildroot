<?php
set('id', -1);
set('title', 'Main');
?>

<ul>
  <li><?php echo link_to('Users', 'users') ?></li>
  <li><?php echo link_to('Doors', 'doors') ?></li>
  <li><?php echo link_to('Events', 'events') ?></li>
</ul>

<div id="led_content">  
	<form id="led_form" name="led_form" action="gpio" method="GET">
        <table width="300" border="1" align="center">
            <tr>
                <td>LED1 Yellow</td>
                <td>LED2 Red</td>
            </tr>   
            <tr>    
                <td>
                    <input type="radio" id="LED1" name="40" value="0">ON <br>
                    <input type="radio" id="LED1" name="40" value="1" checked>OFF
                </td>
                <td>
                    <input type="radio" id="LED2" name="45" value="0">ON <br>
                    <input type="radio" id="LED2" name="45"	value="1" checked>OFF
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="ledimg_content"><hr></div>
<div id="key_content">
    <form id="key_form" action="cgi-bin/key.cgi" method="GET">
		<table width="300" border="1" align="center">
			<tr>
				<td>KEY 1</td>
			</tr>
			<tr>    
				<td>    
					<input type="radio" id="KEY1" name="KEY1" value="1">ON <br>
					<input type="radio" id="KEY1" name="KEY1" value="0" checked>OFF
				</td>
			</tr>
    	</table>
    </form>
</div>

