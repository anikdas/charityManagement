<?php

require_once './mysql.php';

if(!isset($_GET['q']) || !isset($_GET['typehead']))
	exit();

$q = $_GET['q'];


$query = 'SELECT * FROM `book_list` WHERE `bookName` LIKE"%' . $q . '%"';
	$result = mysqli_query($link,$query);
	if($result->num_rows>0){
		if($_GET['typehead']=="true")
				{
					$output = "[";
					while($row = mysqli_fetch_array($result))
					{
						$output .= '"' . $row['bookName'] . '",';
					}
					$output .= ']';
					$output[strrpos($output,',')] = ' ';	
					echo $output;
				}
	}else{
		$query = 'SELECT * FROM `photo_list` WHERE `photoName` LIKE "%' . $q . '%"';
		$result = mysqli_query($link,$query);
		if($result->num_rows>0){
			if($_GET['typehead']=="true")
				{
					$output = "[";
					while($row = mysqli_fetch_array($result))
					{
						$output .= '"' . $row['photoName'] . '",';
					}
					$output .= ']';
					$output[strrpos($output,',')] = ' ';	
					echo $output;
				}
		}else{
			echo "2";
			exit();
		}
	}

?>