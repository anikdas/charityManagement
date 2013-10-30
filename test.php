<?php
require './includes/mysql.php';
$query_gotra = "SELECT * FROM `gotra_list` WHERE 1";
$result_gotra = mysqli_query($link, $query_gotra);
$array_gotra = [];
$val = 'কাশ্যপ';
while($row = mysqli_fetch_array($result_gotra, MYSQLI_NUM))
{
	array_push($array_gotra, $row[0]);
}
print_r($array_gotra);
echo "<select>";

foreach ($array_gotra as $value) {
	if($val == $value)
		echo "<option selected>" . $value . "</option>";
	else
		echo "<option>" . $value . "</option>";
}
?>