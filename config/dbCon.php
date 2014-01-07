<?php
$db_host = 'localhost';
$db_username = 'phoenix';
$db_password = 'phoenix789';
$db_database = 'phoenix';


//connect to the database
mysql_connect($db_host, $db_username, $db_password);
@mysql_select_db($db_database) or die("Unable to select database");

?>
