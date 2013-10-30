function memAdd() {
	var flag = 0;
	for (var i = 1; i <= 13; i++) {
		if($('#'+'mAdd'+i).val()=='')
		{
			if (i==6 || i==8) continue;
			flag = 1;
			$('#'+'mAdd'+i).addClass('wronginp');
		}else{
			if($('#'+'mAdd'+i).hasClass('wronginp'))
			{
				$('#'+'mAdd'+i).removeClass('wronginp');
			}
		}
	};
	if(flag==1)
	{
		return false;
	}else
	{
		$('#mAddButton1').attr('disabled', true);
		var value = new Array('');
		for (var i = 1; i <= 12; i++) {
	
			value[i-1] = $('#'+'mAdd'+i).val();
		};
		value[1] = $('#mAdd13').val();
		$.ajax({
			url:'./includes/newmember.php',
			dataType:'text',
			type: 'POST',
			data:{
				db_name : value[0],
				db_gotra : value[1],
				db_addl1 : value[2],
				db_po : value[3],
				db_dis : value[4],
				db_pcode : value[5],
				db_con : value[6],
				db_email : value[7],
				db_phone : value[8],
				db_mondon : value[9],
				db_thana : value[10],
				db_memType : value[11]
			},
			success: function  (data) {
				if(bomRemover(data)=='success')
				{
					$('#mAddButton2').css('display', 'inline');
					alert("success");
				}
			}
		});
		return false;
	}
}
function gotraSelector () {
	var val = document.getElementById('mAdd2').value;
	if(val=='diff'){
		document.getElementById('mAdd13').value = '';
		$('#mAdd13').css('display','inline');
	}
	else{
		$('#mAdd13').css('display','none');
		document.getElementById('mAdd13').value = val;
	} 
}
function bomRemover (str) {
	str2 = str.split('');
	console.log(str2);
	console.log(str2.length);
	for (var i = 0; i < str2.length; i++) {
		var c = str2[i].charCodeAt(0);
		if(c==65279)
		{
			str2[i] = null;
		}
	}
	console.log(str2);
	str = str2.join('');
	console.log(str);
	return str;
}

function clearAll () {
	$('#mAddButton1').attr('disabled', false);
	for (var i = 1; i <= 11; i++) {
		$('#'+'mAdd'+i).val('');
	};
}

var searchResMem = [];
function memSearch (id) {
	if($('#'+id).val()=='')
	{
		alert('blank field');
	}else{
		$('#'+id+'GenRes').slideUp();
		$.ajax({
			url: './includes/searchtypehead.php?&typehead=false&',
			type: 'GET',
			contentType : 'text',
			data:{
				q:$('#'+id).val()
			},
			dataFilter: function (data) {
				data2 = data.substring(data.indexOf('['), (data.lastIndexOf(']')+1));
				return data2;
			},
			dataType: 'json',
			success: function (data) {
				if (id == "searchEng") {
					$('#'+id+'GenRes').html('<p><i class="icon-quote-left icon-muted"></i><strong>' + $('#'+id).val()+ '</strong><i class="icon-quote-right icon-muted"></i> এর জন্য ' + data.length + ' টি  ফলাফল পাওয়া গেছেঃ </p><hr>');
					if(data.length>0)
					{
						searchResMem = data;
						for (var i = 0; i < data.length; i++) {
						var searchRes = "<div class = 'span12 searchRes' style = 'padding-left:2%;'>";
						searchRes += "<div class = 'row-fluid'>";
						searchRes += "<div class = 'span2' style = 'text-align:center;padding-top: 7%;'><span style = 'font-size: 30pt;'>#"+ data[i].memId +"<span><br>";
						searchRes += "<div style = 'font-size: 10pt;'><strong></strong></div></div>";
						searchRes += "<div class = 'span3' style = ''><address><i class='icon-quote-left'></i><strong style = 'font-size: 12pt;'> "+  data[i].Name  +" </strong><i class='icon-quote-right'></i><br>";
						searchRes += "<p style = 'margin-top:10px'><strong>ঠিকানাঃ </strong><br>";
						searchRes += data[i].addl1 + '<br>';
						searchRes += 'থানাঃ '+data[i].thana + '<br>';
						searchRes += 'পোস্ট অফিসঃ '+data[i].po + '<br>';
						searchRes += 'জেলাঃ '+data[i].dis + '<br>';
						searchRes += 'দেশঃ '+ data[i].country + '-' + data[i].pcode + '<br><button id = "AddPrint' +i+ '" class = "btn btn-block btn-mini btn-primary" style = "margin-top:3%" onclick = "printAdd(this.id)"><i class="icon-print"></i> ঠিকানা</button></p></div>';
						searchRes += '<div class = "span3">'
						searchRes += '<strong>যোগাযোগঃ </strong><br>';
						searchRes += '<span style = "margin-top:4px;"> ই-মেইলঃ '+ data[i].email + '<br>';
						searchRes += 'টেলিফোনঃ '+ data[i].tel + '<br></span>';
						searchRes += '</div>';
						searchRes += '<div class = "span4">';
						searchRes += '<label><strong>প্রনামী</strong></label>';
						searchRes += '<select class = "span12" id = "selectId'+ data[i].memId +'" onchange = "DonChk(this.id)">';
						searchRes += '<option value = "">সিলেক্ট করুন</option>';
						searchRes += '<option value = "1420">১৪২০</option>';
						searchRes += '<option value = "1421">১৪২১</option>';
						searchRes += '<option value = "1422">১৪২২</option>';
						searchRes += '<option value = "1423">১৪২৩</option>';
						searchRes += '<option value = "1424">১৪২৪</option>';
						searchRes += '<option value = "1425">১৪২৫</option>';
						searchRes += '<option value = "1426">১৪২৬</option>';
						searchRes += '<option value = "1427">১৪২৭</option>';
						searchRes += '<option value = "1428">১৪২৮</option>';
						searchRes += '<option value = "1429">১৪২৯</option>';
						searchRes += '</select>';
						searchRes += '<table id = "DonChkTable'+data[i].memId+'" class = "table table-hover">';
						searchRes += '<tbody>';
						searchRes += '<tr>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd1">বৈশাখ</td>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd2">জ্যৈষ্ঠ</td>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd3">আষাঢ়</td>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd4">শ্রাবণ</td>';
						searchRes += '</tr>';
						searchRes += '<tr>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd5">ভাদ্র</td>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd6">আশ্বিন</td>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd7">কার্তিক</td>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd8">অগ্রহায়ণ</td>';
						searchRes += '</tr>';
						searchRes += '<tr>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd9">পৌষ</td>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd10">মাঘ</td>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd11">ফাল্গুন</td>';
						searchRes += '<td id = "'+data[i].memId+'DonChkTableTd12">চৈত্র</td>';
						searchRes += '</tr>';
						searchRes += '</tbody>';
						searchRes += '</table>';

						searchRes += '</div>';
						searchRes += '</div>';
						searchRes += '</div>';
						$('#'+id+'GenRes').append(searchRes);
					};
					$('#'+id+'GenRes').slideDown();
				}else{
					$('#'+id+'GenRes').html('<p><strong>'+$('#'+id).val()+'</strong> এর জন্য কিছু খুঁজে পাওয়া যায়নি।</p><br>');
					$('#'+id+'GenRes').slideDown();
                }
				};
				if (id=='DonSearch') {
					//$('#'+id+'GenRes').html('<div class="span12" style= "padding-bottom:2%;">Search result for: <strong>'+$('#'+id).val()+'</strong><div>');
					$('#'+id+'GenRes').html('<p><i class="icon-quote-left icon-muted"></i><strong>' + $('#'+id).val()+ '</strong> <i class="icon-quote-right icon-muted"></i> এর জন্য ' + data.length + ' টি  ফলাফল পাওয়া গেছেঃ </p><hr>');
					if(data.length>0)
					{
						searchResMem = data;
						var searchRes = "<div class = 'row-fluid'>";
							searchRes += "<div class = 'span4 searchRes'>";
							searchRes += "<table class = 'table table-hover'><thead>";
							searchRes += "<th>#</th>";
							searchRes += "<th>নাম</th>";
							searchRes += "<th></th></thead>";
							searchRes += "<tbody>";
						for (var i = 0; i < data.length; i++) {
							searchRes += "<tr>";
							searchRes += "<td style = 'max-width: 2%;word-wrap:break-word;'><strong>" + data[i].memId + "</strong></td>";
							searchRes += "<td style = 'word-wrap:break-word;'>" + data[i].Name + "</td>";
							searchRes += "<td>" + '<i id="DonSearch' + i +'" class="icon-chevron-right icon-large" style = "cursor: pointer;" onclick= "DonMemSelect(this.id)"></i>' + "</td>";
						};
							searchRes += "</tbody></table></div>";
							searchRes += '<div id = "selected" class = "span4 searchRes" style= "display:none;text-align:center;"></div>'
							searchRes += '<div id = "selected2" class = "span4 searchRes" style= "display:none; padding: 2%;text-align:center;"></div></div>'
							$('#'+id+'GenRes').append(searchRes);
							$('#'+id+'GenRes').slideDown();
					}else{
						//$('#'+id+'GenRes').html('<div class="span12" style= "padding-bottom:2%;">Search result for: <strong>'+$('#'+id).val()+'</strong><div>');
						$('#'+id+'GenRes').html('<p><strong>'+$('#'+id).val()+'</strong> এর জন্য কিছু খুঁজে পাওয়া যায়নি।</p><br>');
						$('#'+id+'GenRes').slideDown();
					}
				};
				if(id=='memEdit'){
					$('#'+id+'GenRes').html('<p><i class="icon-quote-left icon-muted"></i><strong>' + $('#'+id).val()+ '</strong><i class="icon-quote-right icon-muted"></i> এর জন্য ' + data.length + ' টি  ফলাফল পাওয়া গেছেঃ </p><hr>');
					if(data.length>0)
					{
						var searchRes = "<div class = 'span12'>";
							searchRes += "<div class = 'row-fluid'>";
						for (var i = 0; i < data.length; i++) {
							searchRes += "<div class = 'span3' style = 'text-align:'><address><i class='icon-quote-left'></i><strong style = 'font-size: 12pt;'> "+  data[i].Name  +" </strong><i class='icon-quote-right'></i><br>";
							searchRes += "<p style = 'margin-top:10px'><strong>ঠিকানাঃ </strong><br>";
							searchRes += data[i].addl1 + '<br>';
							searchRes += 'থানাঃ '+data[i].thana + '<br>';
							searchRes += 'পোস্ট অফিসঃ '+data[i].po + '<br>';
							searchRes += 'জেলাঃ '+data[i].dis + '<br>';
							searchRes += '<strong>যোগাযোগঃ </strong><br>';
							searchRes += '<span style = "margin-top:4px;"> ই-মেইলঃ '+ data[i].email + '<br>';
							searchRes += 'টেলিফোনঃ '+ data[i].tel + '<br></span>';
							//searchRes += 'দেশঃ '+ data[i].country + '-' + data[i].pcode + '<br><button id = "AddPrint' +i+ '" class = "btn btn-small btn-block" style = "margin-top:3%" onclick = "printAdd(this.id)"><i class="icon-print"></i> ঠিকানা</button></p>';
							searchRes += '<a role="button" class="btn btn-info btn-small btn-block" onclick = "editMem('+data[i].memId+')" style = "margin-top:5px">সংশোধণ</a>';
							searchRes += '</div>';
							if((i+1)%4==0){
								searchRes += '</div>';
								searchRes += '<hr>';
								searchRes += '<div class = "row-fluid">';
							}
						};
							searchRes += "</div>";
							$('#'+id+'GenRes').append(searchRes);
							$('#'+id+'GenRes').slideDown();
					}else{
						//$('#'+id+'GenRes').html('<div class="span12" style= "padding-bottom:2%;">Search result for: <strong>'+$('#'+id).val()+'</strong><div>');
						$('#'+id+'GenRes').html('<p><strong>'+$('#'+id).val()+'</strong> এর জন্য কিছু খুঁজে পাওয়া যায়নি।</p><br>');
						$('#'+id+'GenRes').slideDown();
					}
				}
				if(id=='otherDon'){
					$('#'+id+'GenRes').html('<p><i class="icon-quote-left icon-muted"></i><strong>' + $('#'+id).val()+ '</strong><i class="icon-quote-right icon-muted"></i> এর জন্য ' + data.length + ' টি  ফলাফল পাওয়া গেছেঃ </p><hr>');
					if(data.length>0)
					{
						var searchRes = "<div class = 'span12'>";
							searchRes += "<div class = 'row-fluid'>";
						for (var i = 0; i < data.length; i++) {
							searchRes += "<div class = 'span3' style = 'text-align:'><address><i class='icon-quote-left'></i><strong style = 'font-size: 12pt;'> "+  data[i].Name  +" </strong><i class='icon-quote-right'></i><br>";
							searchRes += "<p style = 'margin-top:10px'><strong>ঠিকানাঃ </strong><br>";
							searchRes += data[i].addl1 + '<br>';
							searchRes += 'থানাঃ '+data[i].thana + '<br>';
							searchRes += 'পোস্ট অফিসঃ '+data[i].po + '<br>';
							searchRes += 'জেলাঃ '+data[i].dis + '<br>';
							searchRes += '<strong>যোগাযোগঃ </strong><br>';
							searchRes += '<span style = "margin-top:4px;"> ই-মেইলঃ '+ data[i].email + '<br>';
							searchRes += 'টেলিফোনঃ '+ data[i].tel + '<br></span>';
							//searchRes += 'দেশঃ '+ data[i].country + '-' + data[i].pcode + '<br><button id = "AddPrint' +i+ '" class = "btn btn-small btn-block" style = "margin-top:3%" onclick = "printAdd(this.id)"><i class="icon-print"></i> ঠিকানা</button></p>';
							searchRes += '<a role="button" class="btn btn-info btn-small btn-block" onclick = "OtherDonColl('+data[i].memId+')" style = "margin-top:5px">সিলেক্ট</a>';
							searchRes += '</div>';
							if((i+1)%4==0){
								searchRes += '</div>';
								searchRes += '<hr>';
								searchRes += '<div class = "row-fluid">';
							}
						};
							searchRes += "</div>";
							$('#'+id+'GenRes').append(searchRes);
							$('#'+id+'GenRes').slideDown();
					}else{
						//$('#'+id+'GenRes').html('<div class="span12" style= "padding-bottom:2%;">Search result for: <strong>'+$('#'+id).val()+'</strong><div>');
						$('#'+id+'GenRes').html('<p><strong>'+$('#'+id).val()+'</strong> এর জন্য কিছু খুঁজে পাওয়া যায়নি।</p><br>');
						$('#'+id+'GenRes').slideDown();
					}
				}
			}
		});
	}
}

function DonChk (id) {
	memId = id.replace('selectId', '');
	year = document.getElementById(id).value;
	for (var i = 0; i < data2.length; i++) {
					$('#'+memId+'DonChkTableTd'+(i+1)).css('text-decoration', 'none');
			};
	if($('#'+id).val()== '')
		return false;
	$('#'+'DonChkTable'+memId).css('opacity', '0.5');
	$.ajax({
		url: './includes/monchecker.php',
		type: 'GET',
		data:{
			memId:memId,
			year:year
		},
		success:function  (data) {
			data2 = bomRemover(data).split('');
			$('#'+'DonChkTable'+memId).css('opacity', '1');
			for (var i = 0; i < data2.length; i++) {
				if(data2[i]==1)
				{
					$('#'+memId+'DonChkTableTd'+(i+1)).css('text-decoration', 'line-through');
				}
			};
		}
	});
}

var currId = 0;

function DonMemSelect(Oldid){
	$('#selected').css('display','none');
	$('#selected2').css('display','none');
	id = parseInt(Oldid.replace('DonSearch',''));
	currId = id;
	console.log('id: '+id);
    console.log('searchResMem:');
    console.log(searchResMem);
		var selected = '<legend>সদস্য ববরণ</legend>';
		selected += "<address><i class='icon-quote-left icon-muted'></i>   <strong style = 'font-size: 12pt;'>"+  searchResMem[id].Name  +"</strong>   <i class='icon-quote-right icon-muted'></i><br>";
		selected += "<strong style = 'margin-top:4px;'>ঠিকানাঃ </strong><br>";
		selected += searchResMem[id].addl1 + '<br>';
		selected += 'থানাঃ '+searchResMem[id].thana + '<br>';
		selected += 'পোস্ট অফিসঃ '+searchResMem[id].po + '<br>';
		selected += 'জেলাঃ '+searchResMem[id].dis + '<br>';
		selected += 'দেশঃ '+ searchResMem[id].country + '-' + searchResMem[id].pcode + '<br><br>';
		selected += '<label>মাসিক প্রনামীঃ </label>'
		selected += '<div>'
		selected += '<input id="MonDonSelectedInp'+id+'" class = "" type = "text"'+ 'value="'+ searchResMem[id].monDon+ '" disabled />';
		selected += '<div class="btn-group" style = "margin-left:-22%;margin-bottom: 4%;">';
		selected += '<button id = "MonDonSelectedBttn1" class="btn btn-mini monDonUpdtBttn" onclick ="monDonUpdt1()"><i class="icon-edit"></i></button>';
		selected += '<button id = "MonDonSelectedBttn2" class="btn btn-mini monDonUpdtBttn" onclick = "monDonUpdate()" disabled><i class="icon-save"></i></button>';
		selected += '</div>';
		selected += '<span id = "MonDonSelectedSpan'+ id +'">' + '</span>';
		selected += '<button id = "ConfirmMember" class="btn btn-info btn-block" style = "margin-top: 6%;" type="button" onclick = "confMem(this.id)">Confirm Member</button>';
		selected += '</div>';
		$('#selected').html(selected);
		$('#selected').fadeIn('slow');
}

function monDonUpdt1() {
	$('#MonDonSelectedSpan'+currId).html('');
	document.getElementById('MonDonSelectedInp'+currId).disabled = false;
	document.getElementById('ConfirmMember').disabled = true;
	document.getElementById('MonDonSelectedBttn2').disabled = false;
	document.getElementById('MonDonSelectedBttn1').disabled = true;
	document.getElementById('MonDonSelectedInp'+currId).value = '';
}

function monDonUpdate () {
	memId = searchResMem[currId].memId;
	monDon = document.getElementById('MonDonSelectedInp'+currId).value;
	if(monDon == '')
		{
			alert('blank field');
			return false;
		}
		document.getElementById('MonDonSelectedBttn2').disabled = true;
	$.ajax({
		url: './includes/mondonupdate.php',
		type: 'GET',
		data:{
			memId: memId,
			monDon:monDon
		},
		success: function (data) {
			dataNew = bomRemover(data);
			if(data != 'error')
			{
				document.getElementById('MonDonSelectedInp'+currId).value = bomRemover(data);
				document.getElementById('MonDonSelectedInp'+currId).disabled = true;
				$('#MonDonSelectedSpan'+currId).html('<span class="label label-success" style = "float: left;margin-left: 7%;margin-top: -5%;padding: 4px;">Success</span>');
				document.getElementById('MonDonSelectedBttn1').disabled = false;
				document.getElementById('ConfirmMember').disabled = false;
			}else{
				alert(data);
			}
		}
	});
}

function confMem (id) {
	document.getElementById(id).disabled = true;
	document.getElementById('MonDonSelectedBttn1').disabled = true;
	document.getElementById('MonDonSelectedBttn2').disabled = true;
	var selected2 = '';
	selected2 += '<label>সাল</label>';
	selected2 += '<select id = "monSelect" onchange= "monSelectChange()">';
	selected2 += '<option value = "">সিলেক্ট করুন</option>';
	selected2 += '<option value = "1420">১৪২০</option>';
	selected2 += '<option value = "1421">১৪২১</option>';
	selected2 += '<option value = "1422">১৪২২</option>';
	selected2 += '<option value = "1423">১৪২৩</option>';
	selected2 += '<option value = "1424">১৪২৪</option>';
	selected2 += '<option value = "1425">১৪২৫</option>';
	selected2 += '<option value = "1426">১৪২৬</option>';
	selected2 += '<option value = "1427">১৪২৭</option>';
	selected2 += '<option value = "1428">১৪২৮</option>';
	selected2 += '<option value = "1429">১৪২৯</option>';
	selected2 += '</select>';
	selected2 += '<label>মাস</label>';
	selected2 += '<table id = "monthTable" cellpadding = "10" class = "table"><tbody>';
	selected2 += '<tr>';
	selected2 += '<td><input type="checkbox" id="monOp1" value="1" disabled onclick = "valueUpdate(this.id)">  বৈশাখ</td>';
	selected2 += '<td><input type="checkbox" id="monOp2" value="2" disabled onclick = "valueUpdate(this.id)">  জ্যৈষ্ঠ</td>';
	selected2 += '<td><input type="checkbox" id="monOp3" value="3" disabled onclick = "valueUpdate(this.id)">  আষাঢ়</td>';
	selected2 += '</tr>';
	selected2 += '<tr>';
	selected2 += '<td><input type="checkbox" id="monOp4" value="4" disabled onclick = "valueUpdate(this.id)">  শ্রাবণ</td>';
	selected2 += '<td><input type="checkbox" id="monOp5" value="5" disabled onclick = "valueUpdate(this.id)">  ভাদ্র</td>';
	selected2 += '<td><input type="checkbox" id="monOp6" value="6" disabled onclick = "valueUpdate(this.id)">  আশ্বিন</td>';
	selected2 += '</tr>';
	selected2 += '<tr>';
	selected2 += '<td><input type="checkbox" id="monOp7" value="7" disabled onclick = "valueUpdate(this.id)">  কার্তিক</td>';
	selected2 += '<td><input type="checkbox" id="monOp8" value="8" disabled onclick = "valueUpdate(this.id)">  অগ্রহায়ণ</td>';
	selected2 += '<td><input type="checkbox" id="monOp9" value="9" disabled onclick = "valueUpdate(this.id)">  পৌষ</td>';
	selected2 += '</tr>';
	selected2 += '<tr>';
	selected2 += '<td><input type="checkbox" id="monOp10" value="10" disabled onclick = "valueUpdate(this.id)">  মাঘ</td>';
	selected2 += '<td><input type="checkbox" id="monOp11" value="11" disabled onclick = "valueUpdate(this.id)">  ফাল্গুন</td>';
	selected2 += '<td><input type="checkbox" id="monOp12" value="12" disabled onclick = "valueUpdate(this.id)">  চৈত্র</td>';
	selected2 += '</tr>';
	selected2 += '</tbody></table>';
	selected2 += '<label>পরিমান<label>';
	selected2 += '<div class="input-prepend">';
	selected2 += '<span class="add-on">৳</span>';
	selected2 += '<input class="span8" id = "finalMonDonAmnt" type= "text" value = "0" disabled>';
	selected2 += '</div>';
	selected2 += '<button id = "ConfirmDon" class="btn btn-success btn-block" type="button" onclick = "collectDonation()" disabled>Confirm Donation</button>';
	$('#selected2').html(selected2);
	$('#selected2').fadeIn('slow');
}

function valueUpdate (id) {
	val = parseInt(document.getElementById('MonDonSelectedInp'+currId).value);
	val1 = parseInt(document.getElementById('finalMonDonAmnt').value);
	if(document.getElementById(id).checked)
	{
		val1 += val;
	}
	else{
		val1 -= val;
	}
	document.getElementById('finalMonDonAmnt').value = val1;
	if(val1!=0)
	{
		document.getElementById('ConfirmDon').disabled = false;
	}else{
		document.getElementById('ConfirmDon').disabled = true;
	}
}

function monSelectChange() {
	for (var i = 1; i <= 12; i++) {
			document.getElementById('monOp'+i).checked = false;
			document.getElementById('monOp'+i).disabled= true;
	};
	document.getElementById('finalMonDonAmnt').value = 0;
	if(document.getElementById('monSelect').value!="")
	{
		$('#monthTable').css('opacity', '0.5');
		$.ajax({
			url: './includes/monchecker.php',
			type: 'GET',
			data: {
				memId: searchResMem[currId].memId,
				year: document.getElementById('monSelect').value
			},
			success: function (data) {
				$('#monthTable').css('opacity', '1');
				var data2 = bomRemover(data).split('');
				console.log(data2);	
				for (var i = 0; i < data2.length; i++) {
					if(data2[i]==='0')
					{
						document.getElementById('monOp'+(i+1)).disabled=false;
						console.log(i+1);
					}
				};
			}
		});
	}else{
		for (var i = 1; i < 13; i++) {
			document.getElementById('monOp'+i).disabled=true;
		};
	}
}

function collectDonation () {
	document.getElementById('ConfirmDon').disabled = true;
	memId = searchResMem[currId].memId;
	monDonStr = '000000000000';
	monDonStrArr = monDonStr.split('');
	for (var i = 0; i < monDonStrArr.length; i++) {
		if(document.getElementById('monOp'+(i+1)).checked)
		{
			monDonStrArr[i] = 1;
		}
	};
	$.ajax({
		url: './includes/collectdonation.php',
		type: 'GET',
		data: {
			memId:memId,
			monDonStr: monDonStrArr.join(''),
			year: $('#monSelect').val()
		},
		success: function (data) {
			data_new = bomRemover(data);
			if(data!='error')
			{
				for (var i = 1; i < 13; i++) {
					document.getElementById('monOp'+i).disabled = true;
					document.getElementById('monOp'+i).checked = false;
					document.getElementById('finalMonDonAmnt').value = '';
				};
				url = './receipt.php?id='+data_new;
				window.open(url,'_blank');
			}
		}
	});
}

function printAdd (str) {
	id = parseInt(str.replace('AddPrint',''));
	var address = '<!DOCTYPE html>';
		address += '<html>';
		address += '<head>';
		address += '<style>';
		address += '@media print{';
		address += 'button{display:none;}}';
		address += '</style>';
		address += '</head>';
		address += '<body>';
		address += "<div style = 'display:inline;position: fixed;-moz-transform: rotate(-90deg);-webkit-transform: rotate(-90deg);margin-top: 6%;margin-left: 2%;'>"+searchResMem[id].Name + '<br>';
		address += searchResMem[id].addl1 + '<br>';
		address += 'থানাঃ '+searchResMem[id].thana + '<br>';
		address += 'পোস্ট অফিসঃ '+searchResMem[id].po + '<br>';
		address += 'জেলাঃ '+searchResMem[id].dis + '<br>';
		address += 'দেশঃ '+ searchResMem[id].country + '-' + searchResMem[id].pcode + '</div>';
		address += '<button style = "" type = "button" onclick = "javascript: window.print()">print</button>';
		address += '</body>';
		address += '</html>';
	var newWindow = window.open('','_blank');
	newWindow .document.open();
    newWindow .document.write(address);
     newWindow .document.close();
}

function editMem (id) {
	$("#modalb1").html('<center><img src = "./384.gif" /></center>');
	$.ajax({
		url: './edit.php',
		type: 'GET',
		data:{
			memId:id
		},
		dataType:'text',
		success:function (html) {
			$("#modalb1").html(html).fadeIn();
		}
	});
	$('#myModal').modal();
}

function memEdit2 (id) {
	if($('#'+id).data('role') === 'edit')
	{
		$('#'+id).data('role', 'save');
		var newId1 = id.replace('memEditBox', ''); 
		document.getElementById(id).disabled = false;
		$('#memEditBoxIc'+newId1).html("<i class='icon-save icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox"+newId1+"')></i>");
	}else{
		if($('#'+id).data('role') === 'save')
	{
		document.getElementById(id).disabled = true;
		var newId2 = id.replace('memEditBox', '') ;
		$('#memEditBoxIc'+newId2).html("<i class='icon-spinner icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox"+newId2+"')></i>");
		var mapTag = {
			'memEditBox1': 'Name',
			'memEditBox2': 'addl1',
			'memEditBox3': 'po',
			'memEditBox4': 'thana',
			'memEditBox5': 'gotra',
			'memEditBox6': 'dis',
			'memEditBox7': 'pcode',
			'memEditBox8': 'country',
			'memEditBox9': 'memType',
			'memEditBox10': 'email',
			'memEditBox11': 'tel'
		};
		$.ajax({
			url : './includes/meminfoupdate.php',
			type: 'GET',
			data:{
				memId: $('#memEditBoxID').val(),
				tag: mapTag[id],
				detail:$('#'+id).val()
			},
			success:function (data) {
				$('#'+id).data('role', 'edit');
				console.log(mapTag[id]);
				if(mapTag[id]!= 'memType'&& mapTag[id]!= 'gotra')
					$('#'+id).val(data);
				document.getElementById(id).disabled = true;
				$('#memEditBoxIc'+newId2).html("<i class='icon-ok icon-large' style = 'color:green;margin:5px;position:absolute;'></i>");
				setTimeout(
					function () {
						$('#memEditBoxIc'+newId2).html("<i class='icon-edit icon-large' style = 'cursor:pointer;margin:5px;position:absolute;' onclick=memEdit2('memEditBox"+newId2+"')></i>").fadeIn();
					},2000
					);
			}
		});
	}
	}
}

function OtherDon (type) {
	if(type == 'member'){
		if(document.getElementById('RadioMember').checked)
		{
			document.getElementById('otherDon').disabled = false;
		}
	}else{
		if(document.getElementById('RadioNonMember').checked)
		{
			document.getElementById('otherDon').value = '';
			document.getElementById('otherDon').disabled = true;
			$('#otherDonGenRes').slideUp();
			//launch modal
			OtherDonColl('nonMember');
		}
		
	}
}

function OtherDonColl (id) {
	$("#modalb2").html('<center><img src = "./384.gif" /></center>');
	$.ajax({
		url: './includes/otherdonmem.php',
		type: 'GET',
		data:{
			memId:id
		},
		dataType:'text',
		success:function (html) {
			$("#modalb2").html(html).fadeIn();
		}
	});
	$('#myModal2').modal();
	return true;
}

function collectOtherDon() {
	for (var i = 1; i < 5; i++) {
		if(i==3) continue;
		if($('#otherDon'+i).val() == '')
		{
			alert('Blank field');
			return false;
		}
	};
	if($('#otherDonID').val()=='nonMem')
	{
		memId = 0;
	}else{
		memId = $('#otherDonID').val();
	}
	var ammntInd = '';
	var donType = '';
	for (var i = 2; i <= 10; i++) {
		if(document.getElementById('ammntDonType'+i).disabled == false && document.getElementById('ammntDonType'+i).value != '')
		{
			donType += i;
			donType += ' ';
			ammntInd += document.getElementById('ammntDonType'+i).value;
			ammntInd += ' ';
		}
	};
	$.ajax({
		url: './includes/collectotherdonation.php',
		type: 'POST',
		data:{
			memId: memId,
			donType: $.trim(donType),
			ammntInd: $.trim(ammntInd),
			name: $('#otherDon1').val(),
			address: $('#otherDon2').val(),
			ammnt: $('#otherDon4').val()
		},
		success: function (data) {
			data_new = bomRemover(data);
			if(data!='error')
			{
				url = './receipt.php?id='+data_new;
				window.open(url,'_blank');
			}
		}
	});
}

var donTypeChkdCounter = 0;
function donTypeChecker (id, obj) {
	if(obj.checked)
	{
		++donTypeChkdCounter;
		document.getElementById('ammntDonType'+id).disabled = false;
	}else{
		--donTypeChkdCounter;
		document.getElementById('ammntDonType'+id).disabled = true;
	}
	if(donTypeChkdCounter>=1)
	{
		document.getElementById('OtherDonAdderBtn').disabled = false;
	}else{
		document.getElementById('OtherDonAdderBtn').disabled = true;
	}
}

function OtherDonAdder (){
	var data1 = ['০','১','২','৩','৪','৫', '৬', '৭', '৮', '৯'];
	var ammnt = 0;
	for (var i = 2; i <= 10; i++) {
		if(document.getElementById('ammntDonType'+i).disabled == false)
		{
			var data2str = document.getElementById('ammntDonType'+i).value;
			var data2 = data2str.split('');
			for (var j = 0; j < data2.length; j++) {
				for (var k = 0; k < data1.length; k++) {
					if(data2[j] == data1[k])
					{
						data2[j] = data1.indexOf(data1[k]);
						break;
					}
				};
			};
			data2join = data2.join('');
			ammnt += parseInt(bomRemover(data2join));
		}
	};
	var ammnt2 = ammnt.toString();
	ammntArr = ammnt2.split('');
	for (var i = 0; i < ammntArr.length; i++) {
		ammntArr[i] = data1[ammntArr[i]];
	};
	ammntBn = ammntArr.join('');
	document.getElementById('otherDon4').value = ammntBn;
}

function dailyConn (print) {
	if(print == 'false'){
		var date = $('#datePicker').val();
		if (date==''){
			alert('Blank Field');
			return false;
		} 
		$.ajax({
			url: './includes/dailycoll.php',
			data: {
				date:date,
				print:print,
			},
			success: function (data) {
				if(bomRemover(data)!='nores')
				{
					$('#dailyCollRes').html(data).fadeIn();
				}else{
					$('#dailyCollRes').html('কিছু খুঁজে পাওয়া যায়নি।');
				}
			}
		});
	}else{
		var date = $('#datePicker').val();
		url='./includes/dailycoll.php?print=true&date='+date;
		window.open(url, '_blank');
	}
}

function newBook () {
	var flag = 0;
	for (var i = 1; i <= 4; i++) {
		if($('#adBk'+i).val() == ''){
			flag = 1;
			$('#adBk'+i).addClass('wronginp');
		}else{
			if($('#adBk'+i).hasClass('wronginp')){
				$('#adBk'+i).removeClass('wronginp');
			}	
		}
	};
	if(flag == 1){
		return false;
	}

	$.ajax({
		url: './includes/newbook.php',
		type: 'POST',
		data:{
			name: $('#adBk1').val(),
			writer: $('#adBk2').val(),
			value: $('#adBk3').val(),
			count: $('#adBk4').val()
		},
		success: function (data) {
			alert(data);
		}
	});
}

function newPhoto () {
	var flag = 0;
	for (var i = 1; i <= 3; i++) {
		if($('#adPh'+i).val() == ''){
			flag = 1;
			$('#adPh'+i).addClass('wronginp');
		}else{
			if($('#adPh'+i).hasClass('wronginp')){
				$('#adPh'+i).removeClass('wronginp');
			}	
		}
	};
	if(flag == 1){
		return false;
	}

	$.ajax({
		url: './includes/newphoto.php',
		type: 'POST',
		data:{
			name: $('#adPh1').val(),
			value: $('#adPh2').val(),
			count: $('#adPh3').val()
		},
		success: function (data) {
			alert(data);
		}
	});
}

function addNewItem () {
	var query =  $('#sellBookPh').val();
	var x = document.getElementById("additems");
	var y = x.getElementsByTagName("tr");
	var z = [];
	for (var i = 1; i < y.length; i++) {
		z.push(y[i].getElementsByTagName("td"));
	};
	for (var i = 0; i < z.length; i++) {
		var itemId = z[i][0].innerText;
		if(query.toUpperCase() == itemId){
			alert('Item Already added!');
			return false;
		}
	}
	$.ajax({
		url: './includes/addmnewitem.php',
		type: 'GET',
		data: {
			query: query
		},
		success: function (data) {
			if(bomRemover(data)=='1'){
				alert('Item out of number!');
			}else{
				if (bomRemover(data)=='2') {
					alert('Item not found!');
				}else{
					$('#additems').append(data);
				}
			}
		}
	});
}

function dumb (obj) {
	var x = document.getElementById("additems");
	var y = x.getElementsByTagName("tr");
	console.log(x);
	//console.log(y);
	var z = [];
	for (var i = 1; i < y.length; i++) {
		z.push(y[i].getElementsByTagName("td"));
	};
	//console.log(z);
	var type = '';
	var indAmmnt = '';
	var indId = '';
	var indCount = '';
	if(z.length<1){
		alert('No item in the list!');
		return false;
	}
	for (var i = 0; i < z.length; i++) {
			//console.log(z[i][0].innerText);
			var itemId = z[i][0].innerText;
			console.log(itemId);
			if(itemId.substring(0,3)=="SDB"){
				type += '11 ';
			}
			if(itemId.substring(0,3)=="SDP"){
				type += '12 ';
			}
			indId += itemId;
			indId += ' ';
			//console.log(z[i][1].innerText);
			//console.log(z[i][2].getAttribute("value"));
			//console.log(z[i][3].getElementsByTagName("select")[0].value);
			var ammnt = parseInt(z[i][2].getAttribute("value")) * z[i][3].getElementsByTagName("select")[0].value;
			indAmmnt += ammnt;
			indAmmnt += ' ';
			indCount += z[i][3].getElementsByTagName("select")[0].value;
			indCount += ' ';
	};
	console.log(type);
	console.log(indAmmnt);
	console.log(indId);
	console.log(indCount);

	$.ajax({
		url: './includes/sellprod.php',
		type: 'POST',
		data: {
			type: type.trim(),
			indAmmnt: indAmmnt.trim(),
			indId: indId.trim(),
			indCount: indCount.trim(),
			name: $('#sellBookPh1').val(),
			address: $('#sellBookPh2').val()
		},
		success: function (data) {
			url='./receipt.php?id='+ bomRemover(data);
		window.open(url, '_blank');
		document.getElementById('itemDumb').disabled = true;
		}
	});

	//var z = y[1].getElementsByTagName("td");
    //console.log(z[0][0].innerText);
    //console.log(z[2].getAttribute("value"));
    //console.log(z[3].getElementsByTagName("select")[0].value);
	//console.log(x.length);
	//for (var i = 0; i <= 2; i++) {
	//    if(i==2){
	//        console.log(y[1].cells[i].value);
	//        continue;
	//    }
	//	//console.log(y[1].cells[i].innerText);
	//};
	//console.log(y[1].cells);
}

function clearItemTable () {
	document.getElementById('itemDumb').disabled = false;
	var html = '';
	//html += '<thead>';
	//html += '	<th>#</th>';
	//html += '	<th>নাম</th>';
	//html += '	<th>মুল্য</th>';
	//html += '	<th>পরিমাণ</th>';
	//html += '</thead>';
	$('#additems tbody').html(html);
}