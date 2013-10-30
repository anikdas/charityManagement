<?php

if(!isset($_GET['monDon']) || !isset($_GET['memId']))
	exit();

require_once './mysql.php';

require_once './numaricconv.php';

$memId = $_GET['memId'];
$monDon = str_replace($bn, $en, $_GET['monDon']);

$query = 'UPDATE `member_info` SET `monDon` = ' . $monDon . ' WHERE `memId` = ' . $memId;
if(mysqli_query($link, $query))
	echo $monDon;
else
	die('error:');

?>