<?php

require_once './mysql.php';

if(!isset($_GET['memId']) || !isset($_GET['year']))
	exit();

$memId = $_GET['memId'];
$year = $_GET['year'];

$query = 'SELECT * FROM `member_' . $memId . '` WHERE `year` = ' . $year ;
$result = mysqli_query($link,$query);
if($result){
	$row = mysqli_fetch_array($result);
	$mon = '000000000000';
	for ($i=1; $i <= 12 ; $i++) { 
		if($row[$i] != 0)
			$mon[$i-1] = '1';
	}
	echo $mon;
}
?>