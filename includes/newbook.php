<?php

if(!isset($_POST['name']) || !isset($_POST['writer']) || !isset($_POST['value']) || !isset($_POST['count']))
{
	echo "data missing";
	exit();
}

require_once './mysql.php';
require_once './numaricconv.php';

$name = $_POST['name'];
$writer = $_POST['writer'];
$value = str_replace($bn, $en, $_POST['value']);
$count = str_replace($bn, $en, $_POST['count']);

$query = 'SELECT * FROM `book_list` ORDER BY `time` DESC LIMIT 1';
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
if($result->num_rows<=0){
	$prevBkYear = 0;
}else{
	$prevBkId = $row['bookId'];
	$prevBkYear = intval(substr($prevBkId, -8, 4));
}
$today = new dateTime();
$curr_year = intval($today->format('Y'));
if($curr_year>$prevBkYear){
	$BkId = 'SDB' . $curr_year . '0001';
}else{
	$id = intval(substr($prevBkId, 3)) + 1;
	$BkId = 'SDB' . $id;
}

$queryNew = 'INSERT INTO `book_list` (`bookId`,`bookName`,`writer`,`price`,`count`,`time`) VALUES('
				. '"' . $BkId . '",'
				. '"' . $name . '",'
				. '"' . $writer . '",'
				. '"' . $value . '",'
				. '"' . $count . '",'
				. 'NOW())';
if(mysqli_query($link, $queryNew)){
	echo $BkId;
}else{
	die("error: " . $link->connect_errno);
}

?>