<?php

require_once './mysql.php';

if(!isset($_GET['memId']) || !isset($_GET['monDonStr']) || !isset($_GET['year']))
	exit();

$memId = $_GET['memId'];
$monDonStr = trim($_GET['monDonStr']);
$year = $_GET['year'];

$query = 'SELECT * FROM `member_info` WHERE `memId` = ' . $memId;
$result = mysqli_query($link, $query);
$row = mysqli_fetch_array($result);
$monDon = $row['monDon'];

if($monDon!= '0')
{
	$queryNew = 'UPDATE `member_' .$memId. '` SET ';
	for ($i=0; $i < 12 ; $i++) { 
		if($monDonStr[$i] == 1)
		{
			$queryNew .= '`'. ($i+1) . '` =' . $monDon . ', `' . ($i+1) . 'd` = NOW(), ';
		}
	}
	$commaPos = strrpos($queryNew, ',');
	$queryNew[$commaPos] = ' ';
	$queryNew .= ' WHERE `year` = ' . $year;
	if(mysqli_query($link, $queryNew))
		{
			include './invnumbergen.php';
			$query = 'SELECT * FROM `member_info` WHERE `memId` = ' . $memId;
			$result = mysqli_query($link, $query);
			$row = mysqli_fetch_array($result);
			$invnum = $invNum;
			$count = $row['monDon'] * array_count_values(str_split($monDonStr))['1'];
			$donType = 1;
			$address = $row['addl1'] . ", " . $row['dis'];
			$rec_query = "INSERT INTO `receipt_log` (`invNo`, `time`, `donType`, `indAmmnt`, `memId`, `name` ,`address`,`ammnt`) VALUES ("
			. $invnum . ", " 
			. "NOW(), " 
			. "'" . $donType . "', " 
			. "'" .$year . ' ' . $row['monDon'] . ' ' . $monDonStr . "', " 
			. $memId . ", " 
			. "'" . $row['Name'] . "', " 
			. "'" . $address . "', " 
			. $count . ")";
			 if(mysqli_query($link, $rec_query))
				echo $invnum;
			else
				//echo $rec_query;
				die('error No: ' . mysqli_error($link));
		}
	else
		die('error No: ' . $link->connect_errno);
}

?>