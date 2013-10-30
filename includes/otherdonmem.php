<?php
	if(!isset($_GET['memId']))
		exit();

require_once './mysql.php';
if ($_GET['memId']!= 'nonMember') {
	$query = 'SELECT * FROM `member_info` WHERE `memId` = ' . $_GET['memId'];
	$result = mysqli_query($link,$query);
	$row = mysqli_fetch_array($result);
	echo "<input data-role = 'edit' id = 'otherDonID' type = 'text' style = 'display:none;' value = '" . $row['memId'] ."' disabled/>";
	echo '<form class="" style = "margin-left:10%">';
	echo '  <div class="control-group">';
	echo '    <label class="control-label" for="otherDon1">নাম</label>';
	echo '    <div class="controls">';
	echo '      <input type="text" id="otherDon1" value = "' . $row['Name'] .  '" disabled>';
	echo '    </div>';
	echo '  </div>';
	echo '  <div class="control-group">';
	$address = $row['addl1'] . ", "  . $row['dis'];
	echo '    <label class="control-label" for="otherDon2">ঠিকানা</label>';
	echo '    <div class="controls">';
	echo '      <textarea id ="otherDon2" rows="2" class="span5" style = "resize:vertical;"  disabled>'. $address .'</textarea>';
	echo '    </div>';
	echo '  </div>';
	echo '  <div class="control-group">';
	echo '      <label for = "otherDon3" class="control-label">প্রনামী</label>';
	echo '    <div class="controls">';


	//echo '        <select id = "otherDon3">';
	//echo '        	<option value = "">সিলেক্ট করুন</option>';
	//$donTypeQ = "SELECT * FROM `donation_types` WHERE `id` != 1 ORDER BY `id` ASC";
	//$result = mysqli_query($link, $donTypeQ);
	//while($row = mysqli_fetch_array($result))
	//	echo '        	<option value = "' . $row['id'] . '">'. $row['name'] .'</option>';
	//echo '        </select>';

	echo '    <table cellpadding = "5">';
	echo '    <tbody>';
	$donTypeQ = "SELECT * FROM `donation_types` WHERE `id` != 1 ORDER BY `id` ASC";
	$result = mysqli_query($link, $donTypeQ);
	while($row = mysqli_fetch_array($result)){
		if($row['id']==11 || $row['id']==12 ) continue;
		echo "<tr>";
		echo "<td><input type='checkbox' onclick= 'javascript:donTypeChecker(" . $row['id'] . ",this)'> " . $row['name'] . "</td>";
		echo "<td>";
		echo '		<div class="input-prepend input-append">';
		echo '		  <span class="add-on">৳</span>';
		echo '		  <input id = "ammntDonType'.$row['id'].'" class="span2" id="otherDon4" type="text" disabled>';
		echo '		  <span class="add-on">.00</span>';
		echo '		</div>';
		echo "</td>";
		echo "</tr>";
	}	
	echo "<tr>";
	echo '<td><label class="control-label" for="otherDon4">পরিমান</label></td>';
	echo "<td>";
	echo '		<div class="input-prepend input-append">';
	echo '		  <span class="add-on">৳</span>';
	echo '		  <input class="span2" id="otherDon4" type="text" disabled>';
	echo '		  <span class="add-on">.00</span><button id = "OtherDonAdderBtn" class = "btn" type = "button" onclick = "OtherDonAdder()" disabled>+</button>';
	echo '		</div>';
	echo "</td>";
	echo "<tr>";
	echo '    </tbody>';
	echo '    </table>';
	echo '    </div>';
	echo '  </div>';
	echo '</form>';
}else{
echo "<input data-role = 'edit' id = 'otherDonID' type = 'text' style = 'display:none;' value = 'nonMem' disabled/>";
	echo '<form class="" style = "margin-left:10%">';
	echo '  <div class="control-group">';
	echo '    <label class="control-label" for="otherDon1">নাম</label>';
	echo '    <div class="controls">';
	echo '      <input type="text" id="otherDon1">';
	echo '    </div>';
	echo '  </div>';
	echo '  <div class="control-group">';
	echo '    <label class="control-label" for="otherDon2">ঠিকানা</label>';
	echo '    <div class="controls">';
	echo '      <textarea id ="otherDon2" rows="2" class="span5" style = "resize:vertical;"></textarea>';
	echo '    </div>';
	echo '  </div>';
	echo '  <div class="control-group">';
	echo '      <label for = "otherDon3" class="control-label">প্রনামী</label>';
	echo '    <div class="controls">';


	//echo '        <select id = "otherDon3">';
	//echo '        	<option value = "">সিলেক্ট করুন</option>';
	//$donTypeQ = "SELECT * FROM `donation_types` WHERE `id` != 1 ORDER BY `id` ASC";
	//$result = mysqli_query($link, $donTypeQ);
	//while($row = mysqli_fetch_array($result))
	//	echo '        	<option value = "' . $row['id'] . '">'. $row['name'] .'</option>';
	//echo '        </select>';

	echo '    <table cellpadding = "5">';
	echo '    <tbody>';
	$donTypeQ = "SELECT * FROM `donation_types` WHERE `id` != 1 ORDER BY `id` ASC";
	$result = mysqli_query($link, $donTypeQ);
	while($row = mysqli_fetch_array($result)){
		if($row['id']==11 || $row['id']==12 ) continue;
		echo "<tr>";
		echo "<td><input type='checkbox' onclick= 'javascript:donTypeChecker(" . $row['id'] . ",this)'> " . $row['name'] . "</td>";
		echo "<td>";
		echo '		<div class="input-prepend input-append">';
		echo '		  <span class="add-on">৳</span>';
		echo '		  <input id = "ammntDonType'.$row['id'].'" class="span2" type="text" disabled>';
		echo '		  <span class="add-on">.00</span>';
		echo '		</div>';
		echo "</td>";
		echo "</tr>";
	}	
	echo "<tr>";
	echo '<td><label class="control-label" for="otherDon4">পরিমান</label></td>';
	echo "<td>";
	echo '		<div class="input-prepend input-append">';
	echo '		  <span class="add-on">৳</span>';
	echo '		  <input class="span2" id="otherDon4" type="text" disabled>';
	echo '		  <span class="add-on">.00</span><button id = "OtherDonAdderBtn" class = "btn" type = "button" onclick = "OtherDonAdder()" disabled>+</button>';
	echo '		</div>';
	echo "</td>";
	echo "<tr>";
	echo '    </tbody>';
	echo '    </table>';
	echo '    </div>';
	echo '  </div>';
	echo '</form>';
}
?>