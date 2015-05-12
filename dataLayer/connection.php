<?php

$username = 'root';
$password = '123456';
$db = 'testDB';
$dbhost = 'localhost';

//@mysql_connect($dbhost,$username,$password) or die('Imposible conectarse a la base de datos');
//@mysql_select_db($db);	

$mysqli = new mysqli($dbhost, $username, $password, $db);
if ($mysqli->connect_errno) {
    echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
//echo $mysqli->host_info . "\n";

?>