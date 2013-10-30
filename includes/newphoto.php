<?php

if(!isset($_POST['name']) || !isset($_POST['value']) || !isset($_POST['count']))
{
	echo "data missing";
	exit();
}

require_once './mysql.php';
require_once './numaricconv.php';

$name = $_POST['name'];
$value = str_replace($bn, $en, $_POST['value']);
$count = str_replace($bn, $en, $_POST['count']);

$query = 'SELECT * FROM `photo_list` ORDER BY `time` DESC LIMIT 1';
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
if($result->num_rows<=0){
	$prePhYear = 0;
}else{
	$prePhId = $row['photoId'];
	$prePhYear = intval(substr($prePhId, -8, 4));
}
$today = new dateTime();
$curr_year = intval($today->format('Y'));
if($curr_year>$prePhYear){
	$PhId = 'SDP' . $curr_year . '0001';
}else{
	$id = intval(substr($prePhId, 3)) + 1;
	$PhId = 'SDP' . $id;
}

$queryNew = 'INSERT INTO `photo_list` (`photoId`,`photoName`,`price`,`count`,`time`) VALUES('
				. '"' . $PhId . '",'
				. '"' . $name . '",'
				. '"' . $value . '",'
				. '"' . $count . '",'
				. 'NOW())';
if(mysqli_query($link, $queryNew)){
	echo $PhId;
}else{
	die("error: " . $link->connect_errno);
}

?>