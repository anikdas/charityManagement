<?php

if(!isset($_GET['memId']) || !isset($_GET['tag']) || !isset($_GET['detail']))
	exit();

require_once './mysql.php';

require_once './numaricconv.php';

$memId = $_GET['memId'];
$tag = $_GET['tag'];
$detail = $_GET['detail'];

$query = 'UPDATE `member_info` SET `' . $tag . '` = "' . $detail . '" WHERE `memId` = ' . $memId;
if(mysqli_query($link, $query))
	echo $detail;
else
	die('error:');

?>