<?php

require './includes/mysql.php';

$query = 'SELECT `invNo`,`donType` FROM `receipt_log` WHERE 1';
$result = mysqli_query($link,$query);
while($row = mysqli_fetch_array($result)){
	if($row['donType']!=1){
		if(strpos($row['donType'], ' ') == false){
			$invNo = $row['invNo'];
			$newDonTypeSplit = str_split($row['donType']);
			$newDonType = implode(' ', $newDonTypeSplit);
			$newQuery = 'UPDATE `receipt_log` SET `donType` = "' . $newDonType . '" WHERE `invNo` = ' .$row['invNo'];
			if(mysqli_query($link, $newQuery))
				echo $invNo . '<br>';
		}
	}
}

?>