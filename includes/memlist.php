<!DOCTYPE html>
<html>
<head>
	<title>সদস্য তালিকা</title>
</head>
<body>

<table cellpadding = 10 border = 1>
	<thead>
		<th>সদস্য আইডি</th>
		<th>নাম</th>
		<th>ফোন/মোবাইল নং.</th>
	</thead>
	<tbody>
<?php
require './mysql.php';
$query_list = "SELECT * FROM `member_info` WHERE 1";
$result = mysqli_query($link, $query_list);
while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['memId'] . "</td>";
	echo "<td>" . $row['Name'] . "</td>";
	echo "<td>" . $row['tel'] . "</td>";
	echo "</tr>";
}
?>
	</tbody>
</table>

</body>
</html>
