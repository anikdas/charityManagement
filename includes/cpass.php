<?php
session_start();
if(!isset($_SESSION['id']))
    echo "wrong"; ;

$id = $_SESSION['id'];
$oldPass = $_POST['oldPass'];
$newPass = $_POST['newPass'];
/*$con = mysql_pconnect("localhost", "root", "advanced");
if(!$con)
{
	die("could not connect: " . mysql_error());
	exit();
}
mysql_select_db("test2" , $con);
$fetch = "SELECT col1 , col2 FROM table1 WHERE col1='$id' AND col2 = '$pass'";
$result = mysql_query($fetch, $con);
$row = mysql_fetch_array($result);*/
require './mysql.php';
$query = "SELECT * FROM `cred` WHERE `user` = '". $id ."' AND `pass` = '" . $oldPass . "'";
$result = mysqli_query($link,$query);
if($result->num_rows>0)
{
	$newQuery = "UPDATE `cred` SET `pass` = '". $newPass ."' WHERE `user` = '" .$id. "'";
	if(mysqli_query($link, $newQuery)){
		session_destroy();
		echo 'success';
	}
	else
		echo "wrong";
}
else
	echo 'wrong';
?>