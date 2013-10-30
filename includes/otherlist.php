<!DOCTYPE html>
<?php
if(!isset($_GET['type']))
	exit();
if($_GET['type'] == 'book'){
	$str1 = "বই";
	$str2 = "বইয়ের";
}
else{
	$str1 = "ছবি";
	$str2 = "ছবির";
}
?>
<html>
<head>
	<title>সদস্য তালিকা</title>
</head>
<body>

<table cellpadding = 10 border = 1>
	<thead>
		<th><?php echo $str1 ?> আইডি</th>
		<th><?php echo $str2 ?> নাম</th>
		<?php
		if($_GET['type'] == 'book'){
			echo "<th>লেখক</th>";
		}
		?>
		<th>মুল্য</th>
		<th>সংখ্যা</th>
	</thead>
	<tbody>
<?php
require './mysql.php';
if($_GET['type'] == 'book'){
	$query_list = "SELECT * FROM `book_list` WHERE 1";
	$result = mysqli_query($link, $query_list);
	require_once './numaricconv.php';
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['bookId'] . "</td>";
		echo "<td>" . $row['bookName'] . "</td>";
		echo "<td>" . $row['writer'] . "</td>";
		echo "<td>৳" .str_replace($en, $bn, $row['price']) . "</td>";
		echo "<td>" . str_replace($en, $bn, $row['count']) . "</td>";
		echo "</tr>";
	}
}
else{
	$query_list = "SELECT * FROM `photo_list` WHERE 1";
	$result = mysqli_query($link, $query_list);
	require_once './numaricconv.php';
	while($row = mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>" . $row['photoId'] . "</td>";
		echo "<td>" . $row['photoName'] . "</td>";
		echo "<td>৳" .str_replace($en, $bn, $row['price']) . "</td>";
		echo "<td>" . str_replace($en, $bn, $row['count']) . "</td>";
		echo "</tr>";
	}
}
?>
	</tbody>
</table>

</body>
</html>
