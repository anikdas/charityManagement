<?php
require_once './mysql.php';
for ($i=1; $i <= 20 ; $i++) { 
	$table_q = "CREATE TABLE IF NOT EXISTS " . 'member_' . $i . " (
  `year` int(11) NOT NULL,
  `1` int(11) NOT NULL,
  `1d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `2` int(11) NOT NULL,
  `2d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `3` int(11) NOT NULL,
  `3d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `4` int(11) NOT NULL,
  `4d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `5` int(11) NOT NULL,
  `5d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `6` int(11) NOT NULL,
  `6d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `7` int(11) NOT NULL,
  `7d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `8` int(11) NOT NULL,
  `8d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `9` int(11) NOT NULL,
  `9d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `10` int(11) NOT NULL,
  `10d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `11` int(11) NOT NULL,
  `11d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `12` int(11) NOT NULL,
  `12d` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00')";
if(mysqli_query($link,$table_q))
{
  for ($j=1420; $j < 1430 ; $j++) { 
    $newQuery = 'INSERT INTO `member_' . $i . '` (`year`) VALUES (' . $j . ')';
    mysqli_query($link,$newQuery);

  }
}
	echo "success";
}

?>