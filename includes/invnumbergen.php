<?php
require_once './mysql.php';
$query = 'SELECT * FROM `receipt_log` ORDER BY `time` DESC LIMIT 1';
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
if($result->num_rows<=0){
	$prevInvYear = 0;
}else{
	$prevInv = $row['invNo'];
	$prevInvYear = intval(substr($prevInv, 0, 4));
}
$today = new dateTime();
$curr_year = intval($today->format('Y'));
if($curr_year>$prevInvYear){
	$invNum = intval($curr_year . '000001');
}else{
	$invNum = ++$prevInv;
}
?>