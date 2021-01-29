<?php

/*
php -f match_listener.php id=12 key=1234 reader=2

id = incremental number, unique for the session
key = code typed by user or cartnumber/keycode
reader = 1 or 2 number of the port the reader is connected to

saveEvent(id, key)

bool canKeyOpenDoor(key, reader) {
	user = getUserByKey(key)
	if(user->canUserOpenDoor()) {
		return true;
	}
	return false
}

*/



require_once '/maasland_app/www/lib/limonade.php';
require_once '/maasland_app/www/lib/db.php';

$_GET['a']

$dsn = 'sqlite:/maasland_app/www/db/dev.db';
try {
        $db = new PDO($dsn);
} catch(PDOException $e) {
        echo "Connexion failed: ".$e;
}

$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
option('db_conn', $db);

setlocale(LC_TIME, "nl_NL");

$users = find_object_by_sql("select name from users where id =1");
echo $users->name;


?>