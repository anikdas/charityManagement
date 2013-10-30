<?php
$db_host = "host"; //host name
$db_user = "username"; //database user name
$db_pass = "password"; // mysql password 
$db_name = "databasename"; //database name
$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if($link->connect_error)
{
	die('Connection error: '. $link->connect_errno);
	exit();
}
mysqli_query($link,'SET CHARACTER SET utf8');
mysqli_query($link,'SET SESSION collation_connection =`utf8_general_ci`'); 
?>
