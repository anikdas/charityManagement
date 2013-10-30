<?php

require_once './mysql.php';

if(!isset($_GET['q']) || !isset($_GET['typehead']))
	exit();

$q = $_GET['q'];

require_once './numaricconv.php';

$q = str_replace($bn, $en, $q);
$query = 'SELECT * FROM `member_info` WHERE ';
if(is_numeric($q))
{
	$query .= '`memId` =' . $q;
}
else{
	$query .= "`Name` LIKE '%" . $q . "%'";
}

$result = mysqli_query($link, $query);
if(($result->num_rows)>0)
{
	if($_GET['typehead']=="true")
	{
		echo $_GET['typehead'];
		$output = "[";
		while($row = mysqli_fetch_array($result))
		{
			$output .= '"' . $row['Name'] . '",';
		}
		$output .= ']';
		$output[strrpos($output,',')] = ' ';	
		echo $output;
	}else{
		$memList = array();
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{
			array_push($memList, $row);
		}
		echo json_encode($memList, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
	}
}
else{
	echo "[]";
}



?>