<?php
session_start();
$id = $_POST['id'];
$pass = $_POST['pass'];
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
require './includes/mysql.php';
$query = "SELECT * FROM `cred` WHERE `user` = '". $id ."' AND `pass` = '" . $pass . "'";
$result = mysqli_query($link,$query);
if($result->num_rows>0)
{
	$_SESSION['id'] = $id;
	echo 'success';

}
else
	echo 'wrong';
?>