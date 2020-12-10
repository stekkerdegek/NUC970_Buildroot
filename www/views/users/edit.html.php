<?php

echo html('users/_form.html.php', null, array('user' => $user, 'method' => 'PUT', 'action' => url_for('users', $user->id)));

?>
