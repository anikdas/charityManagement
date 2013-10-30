<?php

if(!isset($_GET['id']))
	exit();

require './includes/mysql.php';
require './includes/numaricconv.php';

if (isset($_POST['submit'])){
 $iden = $_POST['iden'];
 $id = $_POST['id'];
 $name = $_POST['name'];
 $count = str_replace($bn, $en, $_POST['count']);
 $price = str_replace($bn, $en, $_POST['price']);
 if($iden== 'SDB'){
 	$writer = $_POST['writer'];
 	$updateQuery = 'UPDATE `book_list` SET `bookName` = "' . $name . '", `writer` = "' . $writer . '", `count` = (`count`+' . $count . '), `price` = ' . $price . ' WHERE `bookId` = "' . $id .'"';
 }
 if($iden== 'SDP'){
 	$updateQuery = 'UPDATE `photo_list` SET `photoName` = "' . $name . '", `count` = (`count`+' . $count . '), `price` = ' . $price . ' WHERE `photoId` = "' . $id .'"';
 }
 if(mysqli_query($link, $updateQuery)){
 	echo "তথ্য পরিবর্তিত হয়েছে।";
 }else{
 	echo "error!";
 	die('error No: ' . mysqli_error($link));
 }
}

$id = $_GET['id'];
$identifier = substr($id, 0, 3);
if($identifier == 'SDB'){
	$query = 'SELECT * FROM `book_list` WHERE `bookId` ="' . $id . '"';
	$result = mysqli_query($link, $query);
	$detail = mysqli_fetch_array($result, MYSQLI_ASSOC);
}
if($identifier == 'SDP'){
	$query = 'SELECT * FROM `photo_list` WHERE `photoId` ="' . $id . '"';
	$result = mysqli_query($link, $query);
	$detail = mysqli_fetch_array($result, MYSQLI_ASSOC);
}


?>

<!DOCTYPE html>
<html>
<head>
	<title><?php echo $id; ?></title>
</head>
<body>
	<form method="post">
		<?php
		echo "<input style = 'display:none;' name = 'iden' type = 'text' value =  '" . $identifier . "' readonly><br>";
		if($identifier == "SDB"){
			echo "আইডী: <input name = 'id' type = 'text' value =  '" . $detail['bookId'] . "' readonly><br>";
			echo "নাম: <input name = 'name' type = 'text' value = '" . $detail['bookName'] . "'><br>";
			echo "লেখক: <input name = 'writer' type = 'text' value = '" . $detail['writer'] . "'><br>";
		}
		if($identifier == "SDP"){
			echo "আইডি: <input name = 'id' type = 'text' value = '" . $detail['photoId'] . "' readonly><br>";
			echo "নাম: <input name = 'name' type = 'text' value = '" . $detail['photoName'] . "'><br>";
		}
		echo "মুল্য: <input name = 'price' type = 'text' value = '" . str_replace($en, $bn, $detail['price']) . "'><br>";
		echo "স্টক: <input name = 'count' type = 'number' value = '" . $detail['count'] . "' readonly><br>";
		echo "সংযোজন: <input name = 'count' type = 'text' ><br>";
		?>
		<input type="submit" value="submit" name="submit">
	</form>
</body>
</html>