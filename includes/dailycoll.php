<?php
if(!isset($_GET['date']))
	exit();

require_once './mysql.php';
$date = DateTime::createFromFormat('d/m/Y',$_GET['date']);

require_once './numaricconv.php';

$query = "SELECT `donType`,`indAmmnt`,`ammnt` FROM `receipt_log` WHERE DATE(`time`) = '" . $date->format('Y-m-d') . "'";
$resultRaw = mysqli_query($link,$query);
if($resultRaw->num_rows<=0)
{
	echo "nores";
	exit();
}
$res = [];
while($row = mysqli_fetch_array($resultRaw, MYSQLI_NUM))
	array_push($res,$row);
	
$query2 = "SELECT * FROM `donation_types` ORDER BY `id`";
$result2 = mysqli_query($link,$query2);
$donTypes = [];
while($row2 = mysqli_fetch_array($result2))
{
	$donTypes[$row2['id']] = $row2['name'];
	$cummAmmnt[$row2['id']] = 0;
}

$total = 0;
//print_r($donTypes);

foreach ($res as $key => $value) {
	if($value[0]=='1')
	{
		$cummAmmnt[1]+= $value[2];
		$total += $value[2];
	}else{

		//if(strpos($value[0], ' ') == false){
		//	echo "comes";
		//	print_r($value[0]);
        //              $givenDtype = str_split($value[0]);
        //              $itemNo = strlen($value[0]);
        //            }
        //          else{
                    $givenDtype = explode(' ' ,$value[0]);
                    $itemNo = count($givenDtype);
        //          }
		//$itemNo = strlen($value[0]);
        //$givenDtype = str_split($value[0]);
        $indAmmntEn = str_replace($bn, $en, $value[1]);
        $indAmmntArr = explode(' ', $indAmmntEn);
        //var_dump($indAmmntArr);
        for ($i=0; $i < $itemNo ; $i++) { 
        	$cummAmmnt[$givenDtype[$i]] += intval($indAmmntArr[$i]);
        	$total += intval($indAmmntArr[$i]);
        }
	}
}
if($_GET['print']!='true'){
	echo 'তারিখ: ' . str_replace($en, $bn, $date->format('d/m/Y'));
	echo "<table class ='table table-bordered'>";
	$btn = '<button type = "button" class = "btn" onclick = "dailyConn(true)"><i class="icon-print"> প্রিন্ট</i></button>';
}else{
	echo 'তারিখ: ' . str_replace($en, $bn, $date->format('d/m/Y'));
	echo "<table border = '1' cellpadding = '10'>";
	$btn = '';
}
echo "<thead>";
echo "<th style = 'background-color: rgba(163, 163, 163, 0.5);'>ধরণ</th><th style = 'background-color: rgba(163, 163, 163, 0.5);text-align:right;'>পরিমান</th>";
echo "</thead>";
echo "<tbody>";
foreach ($cummAmmnt as $key => $value) {
	if($value == 0) continue;
	echo "<tr>";
	echo "<td>" . $donTypes[$key]  . "</td><td  style ='text-align:right;'> ৳" . str_replace($en, $bn, $value) . '</td>' ;
	echo "</tr>";
}
echo "<tr>";
echo "<td>মোট</td><td style ='text-align:right;'> ৳" . str_replace($en, $bn, $total) . '</td>' ;
echo "</tr>";
echo "</tbody>";
echo "</table>";
echo $btn;
?>