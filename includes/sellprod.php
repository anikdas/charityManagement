<?php

if(!isset($_POST['type']) || !isset($_POST['indAmmnt']) || !isset($_POST['indId']) || !isset($_POST['indCount']) || !isset($_POST['name']) || !isset($_POST['address']))
	exit();

require './mysql.php';

$type = $_POST['type'];
$indAmmnt = $_POST['indAmmnt'];
$indId = $_POST['indId'];
$indCount = $_POST['indCount'];
$name = $_POST['name'];
$address = $_POST['address'];

$indIdArr = explode(' ', $indId);
$indCountArr = explode(' ', $indCount);

foreach ($indIdArr as $key => $value) {
	$identifier = substr($value, 0,3);
	if(strcasecmp($identifier, 'SDB') == 0){		
		$table = 'book_list';
		$row = 'bookId';
	}
	if(strcasecmp($identifier, 'SDP') == 0){
		$table = 'photo_list';
		$row = 'photoId';
	}
	$countQuery = 'UPDATE `' . $table . '` SET `count` = (`count`-' . intval($indCountArr[$key]) . ') WHERE `' . $row .'` = "' . $value . '"';
	if(mysqli_query($link, $countQuery)){}
	else
		die('error No: ' . mysqli_error($link));
}

include './invnumbergen.php';
$invnum = $invNum;
$ammnts = explode(' ', $indAmmnt);
$cummAmmnt = 0;
foreach ($ammnts as $value) {
	$cummAmmnt += intval($value);
}
require_once './numaricconv.php';
$query = "INSERT INTO `receipt_log` (`invNo`, `time`, `memId`, `donType`, `indAmmnt`, `name`, `address`, `ammnt`, `remarks`, `count`) VALUES ("
			. $invnum . ", " 
			. "NOW(), " 
			. "0, " 
			. '"' . $type . '",' 
			. '"' . str_replace($en, $bn, $indAmmnt) . '",' 
			. '"' . $name . '", ' 
			. '"' . $address . '", ' 
			. $cummAmmnt . ","
			. '"' . $indId . '",' 
			. '"' . $indCount . '")';
if(mysqli_query($link, $query)){
	echo $invnum;
}else{
	die('error No: ' . mysqli_error($link));
}

?>