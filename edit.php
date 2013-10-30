<?php
	if(!isset($_GET['memId']))
		exit();

require_once './includes/mysql.php';
$query = 'SELECT * FROM `member_info` WHERE `memId` = ' . $_GET['memId'];
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);

echo "<div class = row-fluid>";
echo "<input data-role = 'edit' id = 'memEditBoxID' type = 'text' style = 'display:none;' value = '" . $row['memId'] ."' disabled/>";
echo "<form>";


echo "<div class = span4>";
echo "<label>নাম</label>";
echo "<input data-role = 'edit' id = 'memEditBox1' type = 'text' value = '" . $row['Name'] ."' disabled/><a id = 'memEditBoxIc1' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox1')></i></a><br>";
echo "<label>ঠিকানা</label>";
echo "<input data-role = 'edit' id = 'memEditBox2' type = 'text' value = '" . $row['addl1'] ."' disabled/><a id = 'memEditBoxIc2' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox2')></i></a><br>";
echo "<label>পোস্ট অফিস</label>";
echo "<input data-role = 'edit' id = 'memEditBox3' type = 'text' value = '" . $row['po'] ."' disabled/><a id = 'memEditBoxIc3' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox3')></i></a><br>";
echo "<label>থানা</label>";
echo "<input data-role = 'edit' id = 'memEditBox4' type = 'text' value = '" . $row['thana'] ."' disabled/><a id = 'memEditBoxIc4' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox4')></i></a><br>";
echo "</div>";


echo "<div class = span4>";
echo "<label>গোত্র</label>";
echo "<select data-role = 'edit' id = 'memEditBox5' disabled>";

$query_gotra = "SELECT * FROM `gotra_list` WHERE 1";
$result_gotra = mysqli_query($link, $query_gotra);
$gotra_array = [];
while($row1 = mysqli_fetch_array($result_gotra, MYSQLI_NUM))
{
	array_push($gotra_array, $row1[0]);
}

foreach ($gotra_array as $value) {
	if($row['gotra'] == $value)
		echo "<option selected>" . $value . "</option>";
	else
		echo "<option>" . $value . "</option>";
}

echo "</select><a id = 'memEditBoxIc5' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox5')></i></a><br>";
echo "<label>জেলা</label>";
echo "<input data-role = 'edit' id = 'memEditBox6' type = 'text' value = '" . $row['dis'] ."' disabled/><a id = 'memEditBoxIc6' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox6')></i></a><br>";
echo "<label>পোস্ট কোড</label>";
echo "<input data-role = 'edit' id = 'memEditBox7' type = 'text' value = '" . $row['pcode'] ."' disabled/><a id = 'memEditBoxIc7' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox7')></i></a><br>";
echo "<label>দেশ</label>";
echo "<input data-role = 'edit' id = 'memEditBox8' type = 'text' value = '" . $row['country'] ."' disabled/><a id = 'memEditBoxIc8' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox8')></i></a><br>";
echo "</div>";


echo "<div class = span4>";
echo "<label>সদস্যের ধরণ</label>";
echo "<select data-role = 'edit' id = 'memEditBox9' disabled>";
switch($row['memType'])
{
	case 'কমিটি সদস্য':
		echo "<option selected>কমিটি সদস্য</option>";
		echo "<option>সাধারণ সদস্য</option>";
		break;
	default:
		echo "<option>কমিটি সদস্য</option>";
		echo "<option selected>সাধারণ সদস্য</option>";
		break;
}
echo "</select><a id = 'memEditBoxIc9' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox9')></i></a><br>";
echo "<label>ই-মেইল</label>";
echo "<input data-role = 'edit' id = 'memEditBox10' type = 'text' value = '" . $row['email'] ."' disabled/><a id = 'memEditBoxIc10' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox10')></i></a><br>";
echo "<label>ফোন নং.</label>";
echo "<input data-role = 'edit' id = 'memEditBox11' type = 'text' value = '" . $row['tel'] ."' disabled/><a id = 'memEditBoxIc11' class = 'edit' role = 'button'><i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox11')></i></a><br>";
echo "</div>";


echo "</form>";
echo "</div>";

?>
