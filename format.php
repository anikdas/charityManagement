<?php

require './includes/mysql.php';
$user_count_q = 'SELECT COUNT(*) FROM `member_info`;';
$result = mysqli_query($link, $user_count_q);
$count = intval(mysqli_fetch_array($result)[0]);

for ($i=1; $i <= $count ; $i++) { 
	for ($j=1; $j <= 12 ; $j++) { 
		$q = 'UPDATE `member_' . $i . '` SET `' . $j . '` = 0, `' . $j . 'd` = "0000-00-00 00:00:00";';
		if(mysqli_query($link, $q)){}
			else
				continue;
	}
	echo "formatted MEMBER: " . $i . '<br>';
}

$receipt_q = "TRUNCATE `receipt_log`";
if(mysqli_query($link, $receipt_q))
	echo "RECEIPT LOG CLEARED";

?>