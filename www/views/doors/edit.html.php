<?php

echo html('doors/_form.html.php', null, array('door' => $door, 'method' => 'PUT', 'action' => url_for('doors', $door->id)));

?>
