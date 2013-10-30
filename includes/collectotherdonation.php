<?php

if(!isset($_POST['memId']) || !isset($_POST['donType']) || !isset($_POST['name']) || !isset($_POST['address']) || !isset($_POST['ammnt']))
	exit();

require './mysql.php';

$memId = $_POST['memId'];
$donType = $_POST['donType'];
$ammntIndRaw = $_POST['ammntInd'];
$name = $_POST['name'];
$address = $_POST['address'];
$ammntRaw = $_POST['ammnt'];

include './invnumbergen.php';
$invnum = $invNum;

require_once './numaricconv.php';
$ammnt = str_replace($bn, $en, $ammntRaw);
$ammntInd = str_replace($en, $bn, $ammntIndRaw);
$query = "INSERT INTO `receipt_log` (`invNo`, `time`, `donType`, `indAmmnt`, `memId`, `name` ,`address`,`ammnt`) VALUES ("
			. $invnum . ", " 
			. "NOW(), " 
			. "'" . $donType . "', " 
			. "'" . $ammntInd . "', " 
			. $memId . ", " 
			. "'" . $name . "', " 
			. "'" . $address . "', " 
			. $ammnt . ")";
//echo $query;
if(mysqli_query($link, $query))
	echo $invnum;
else
	//echo $rec_query;
	die('error No: ' . mysqli_error($link));


?>