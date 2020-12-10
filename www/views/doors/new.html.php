<?php

echo html('doors/_form.html.php', null, array('door' => $door, 'method' => 'POST', 'action' => url_for('doors')));

?>
