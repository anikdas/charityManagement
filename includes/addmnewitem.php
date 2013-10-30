<?php

if(!isset($_GET['query']))
	exit();

require './mysql.php';
require_once './numaricconv.php';

$search = $_GET['query'];
$identifier = substr($search, 0, 3);
if(strcasecmp($identifier, 'SDB') == 0){
	//book confirmed
	$query = 'SELECT * FROM `book_list` WHERE `bookId` ="' . $search . '"';
	$result = mysqli_query($link,$query);
	if($result->num_rows>0){
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($row['count']==0){
			echo "1";
			exit();
		}else{
			//echo "<table class = 'table'>";
			echo "<tr id = 'item" . $row['bookId'] . "'>";
			echo "<td>". $row['bookId'] ."</td>";
			echo "<td>". $row['bookName'] . "</td>";
			echo "<td value = '" . $row['price'] . "'>৳". str_replace($en, $bn, $row['price']) ."</td>";
			echo "<td>";
			echo "<select>";
			for ($i=1; $i <= $row['count'] ; $i++) { 
				echo "<option>" . $i . "</option>";
			}
			echo "</select>";
			echo "</td>";
			echo "<td><button class = 'btn btn-small' onclick = " . "$('#item" . $row['bookId'] . "').remove();" . "><i class='icon-remove' ></i> remove</button></td>";
			echo "</tr>";
			//echo "</table>";
		}
	}else{
		echo "2";
		exit();
	}
}elseif (strcasecmp($identifier, 'SDP') == 0) {
	//photo confirmed
	$query = 'SELECT * FROM `photo_list` WHERE `photoId` ="' . $search . '"';
	$result = mysqli_query($link,$query);
	if($result->num_rows>0){
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($row['count']==0){
			echo "1";
			exit();
		}else{
			//echo "<table class = 'table'>";
			echo "<tr id = 'item" . $row['photoId'] . "'>";
			echo "<td>". $row['photoId'] ."</td>";
			echo "<td>". $row['photoName'] . "</td>";
			echo "<td value = '" . $row['price'] . "'>৳". str_replace($en, $bn, $row['price']) ."</td>";
			echo "<td>";
			echo "<select>";
			for ($i=1; $i <= $row['count'] ; $i++) { 
				echo "<option>" . $i . "</option>";
			}
			echo "</select>";
			echo "</td>";
			echo "<td><button class = 'btn btn-small' onclick = " . "$('#item" . $row['photoId'] . "').remove();" . "><i class = 'icon-remove'></i> remove</button></td>";
			echo "</tr>";
			//echo "</table>";
		}
	}else{
		echo "2";
		exit();
	}
}else{
	//string search
	$query = 'SELECT * FROM `book_list` WHERE `bookName` LIKE"%' . $search . '%"';
	$result = mysqli_query($link,$query);
	if($result->num_rows>0){
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($row['count']==0){
			echo "1";
			exit();
		}else{
			//echo "<table class = 'table'>";
			echo "<tr id = 'item" . $row['bookId'] . "'>";
			echo "<td>". $row['bookId'] ."</td>";
			echo "<td>". $row['bookName'] . "</td>";
			echo "<td value = '" . $row['price'] . "'>৳". str_replace($en, $bn, $row['price']) ."</td>";
			echo "<td>";
			echo "<select>";
			for ($i=1; $i <= $row['count'] ; $i++) { 
				echo "<option>" . $i . "</option>";
			}
			echo "</select>";
			echo "</td>";
			echo "<td><button class = 'btn btn-small' onclick = " . "$('#item" . $row['bookId'] . "').remove();" . "><i class = 'icon-remove'></i> remove</button></td>";
			echo "</tr>";
			//echo "</table>";
		}
	}else{
		$query = 'SELECT * FROM `photo_list` WHERE `photoName` LIKE "%' . $search . '%"';
		$result = mysqli_query($link,$query);
		if($result->num_rows>0){
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			if($row['count']==0){
				echo "1";
				exit();
			}else{
				//echo "<table class = 'table'>";
				echo "<tr id = 'item" . $row['photoId'] . "'>";
				echo "<td>". $row['photoId'] ."</td>";
				echo "<td>". $row['photoName'] . "</td>";
				echo "<td value = '" . $row['price'] . "'>৳". str_replace($en, $bn, $row['price']) ."</td>";
				echo "<td>";
				echo "<select>";
				for ($i=1; $i <= $row['count'] ; $i++) { 
					echo "<option>" . $i . "</option>";
				}
				echo "</select>";
				echo "</td>";
				echo "<td><button class = 'btn btn-small' onclick = " . "$('#item" . $row['photoId'] . "').remove();" . "><i class = 'icon-remove'></i> remove<button></td>";
				echo "</tr>";
				//echo "</table>";
			}
		}else{
			echo "2";
			exit();
		}
	}
}

?>