<?php

require_once './mysql.php';

$db_name = $_POST['db_name'];
$db_gotra = $_POST['db_gotra'];
$db_addl1 = $_POST['db_addl1'];
$db_po = $_POST['db_po'];
$db_dis = $_POST['db_dis'];
$db_pcode = $_POST['db_pcode'];
$db_con = $_POST['db_con'];
$db_email = $_POST['db_email'];
$db_phone = $_POST['db_phone'];
$db_mondon = $_POST['db_mondon'];
$db_thana = $_POST['db_thana'];
$db_memType = $_POST['db_memType'];

require_once './numaricconv.php';

$db_mondon = str_replace($bn, $en, $db_mondon);

$query_gotra = "SELECT * FROM `gotra_list` WHERE `gotra` LIKE '" . $db_gotra . "'";
$result_gotra = mysqli_query($link, $query_gotra);
if(($result_gotra->num_rows)<=0)
{
  $query_gotra = "INSERT INTO `gotra_list`(`gotra`) VALUES ('" . $db_gotra . "')";
  mysqli_query($link, $query_gotra);
}

$query = "INSERT INTO `member_info`(`Name`, `addl1`, `po`, `dis`, `pcode`, `country`, `gotra`, `email`, `monDon`, `tel`, `thana`, `memType`) VALUES ("
		. "'" .$db_name . "',"
		. "'" .$db_addl1 . "',"
		. "'" .$db_po . "',"
		. "'" .$db_dis . "',"
		. "'" .$db_pcode . "',"
		. "'" .$db_con . "',"
		. "'" .$db_gotra . "',"
		. "'" .$db_email . "',"
		. "'" .$db_mondon . "',"
		. "'" .$db_phone . "',"
    . "'" .$db_thana . "',"
		. "'" .$db_memType . "')";
if(mysqli_query($link,$query))
{
  $newRes = mysqli_query($link,'SELECT MAX(`memId`) AS `memId` FROM `member_info`');
  $memId = mysqli_fetch_array($newRes)['memId'];
	$table_q = "CREATE TABLE IF NOT EXISTS " . 'member_' . $memId . " (
  `year` int(11) NOT NULL,
  `1` int(11) NOT NULL,
  `1d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `2` int(11) NOT NULL,
  `2d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `3` int(11) NOT NULL,
  `3d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `4` int(11) NOT NULL,
  `4d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `5` int(11) NOT NULL,
  `5d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `6` int(11) NOT NULL,
  `6d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `7` int(11) NOT NULL,
  `7d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `8` int(11) NOT NULL,
  `8d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `9` int(11) NOT NULL,
  `9d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `10` int(11) NOT NULL,
  `10d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `11` int(11) NOT NULL,
  `11d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `12` int(11) NOT NULL,
  `12d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00')";
if (mysqli_query($link, $table_q)) {
  for ($i=1420; $i < 1430 ; $i++) { 
    $newQuery = 'INSERT INTO `member_' . $memId . '` (`year`) VALUES (' . $i . ')';
    mysqli_query($link,$newQuery);

  }
  echo 'success';
}else{
	die("error: " . $link->connect_errno);
}
}
?>