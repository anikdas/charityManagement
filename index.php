<!DOCTYPE html>

<?php
session_start();
if(!isset($_SESSION['id']))
    header('Location: ./login.php') ;

?>

<html>
<head>
	<title>সত্যধাম</title>
	<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="./css/datepicker.css" rel="stylesheet" media="screen">
	<link href="./font-awesome/css/font-awesome.min.css" rel="stylesheet" media="screen">
	<link href="./css/DT_bootstrap.css" rel="stylesheet" media="screen">
	<style type="text/css">
	#spinner {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background-color: black;
	opacity: .5;
	}
	a.search{
		text-decoration: none;
	}
	a.edit{
		text-decoration: none;
		color: #000;
	}a.edit:hover{
		text-decoration: none;
		color: #08c;
	}
	.navTabs{
		min-height: 20%;
		border-radius: 0px 0px 20px 20px;
		-webkit-box-shadow: 0px 10px 10px 2px ;
		box-shadow: 0px 10px 20px -5px ; 
	}
	.visible{
		overflow: visible;
	}
	legend{
		text-align: center;
	}
	body{
		margin-bottom: 5%; 
	}
	.wronginp{
		border-color: red !important;
		box-shadow: 0 0 5px red !important;
	}
	.searchRes{
		padding: 2%;
		margin: 0% !important;
		-webkit-border-radius: 10px;
		border-radius: 10px; 
		transition:  -webkit-box-shadow,  box-shadow .5s;
		-webkit-transition: -webkit-box-shadow,  box-shadow .5s;
	}
	.searchRes:hover{
		-webkit-border-radius: 10px;
		border-radius: 10px; 
		-webkit-box-shadow: inset 0px 0px 10px 0px ;
		box-shadow: inset 0px 0px 10px 0px ; 
	}
	.monDonUpdtBttn{
		opacity: .1;
		transition: opacity .5s;
		-webkit-transition: opacity .5s;
	}
	.monDonUpdtBttn:hover{
		opacity: 1.0;
	}
	.dataTables_filter{
		display: inline;
	}
	table.table thead .sorting,
table.table thead .sorting_asc,
table.table thead .sorting_desc,
table.table thead .sorting_asc_disabled,
table.table thead .sorting_desc_disabled {
    cursor: pointer;
    *cursor: hand;
}
 
table.table thead .sorting { background: url('images/sort_both.png') no-repeat center right; }
table.table thead .sorting_asc { background: url('images/sort_asc.png') no-repeat center right; }
table.table thead .sorting_desc { background: url('images/sort_desc.png') no-repeat center right; }
 
table.table thead .sorting_asc_disabled { background: url('images/sort_asc_disabled.png') no-repeat center right; }
table.table thead .sorting_desc_disabled { background: url('images/sort_desc_disabled.png') no-repeat center right; }
	</style>
</head>
<body>
	<!--spinner-->
	<div id="spinner"></div>
	<div class = "row-fluid">
		<div class = "span12">
			<div class = "span9" style= "margin-left:12%;margin-top:3%;">
				<div class="navbar">
				  <div class="navbar-inner">
					<a class="brand" href="#">সত্যধাম</a>
					<ul class="nav">
					  <li class="divider-vertical"></li>
					  <li  class="active"><a href="#navTab1" data-toggle = "tab">Home</a></li>
					  <li><a href="#navTab2" data-toggle = "tab">সদস্য বিবরণ</a></li>
					  <li><a href="#navTab3" data-toggle = "tab">প্রনামী</a></li>
					  <li><a href="#navTab4" data-toggle = "tab">বিক্রয়</a></li>
					</ul>
					<ul class = "nav pull-right">
					  <li class="divider-vertical"></li>
					  <li><a href="./changepass.php">change password</a></li>
					  <li class="divider-vertical"></li>
					  <li><a href="./logout.php">log out</a></li>
					</ul>
				  </div>
				</div>
					<div class = "tab-content visible" style = "margin-top:2%;">
						<!--home-->
						<div class = "fade in tab-pane active" id = "navTab1" style = "width:100%;">
							<div id="myCarousel" class="carousel slide" data-interval="3000">
							  <ol class="carousel-indicators">
							    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							    <li data-target="#myCarousel" data-slide-to="1"></li>
							    <li data-target="#myCarousel" data-slide-to="2"></li>
							  </ol>
							  <!-- Carousel items -->
							  <div class="carousel-inner">
							    <div class="active item"><img src = "./img/1.png" /></div>
							    <div class="item"><img src = "./img/2.jpg" /></div>
							    <div class="item"><center><img src = "./img/3.jpg" /></center></div>
							  </div>
							  <!-- Carousel nav -->
							  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
							  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
							</div>
					</div>
						<!--member detail-->
						<div class = "navTabs fade in tab-pane" id = "navTab2">
						<div class = "tabbable">
							<ul class="nav nav-tabs">
							  <li class = "active"><a href="#memTab1" data-toggle="tab">সদস্য ডাটাবেস</a></li>
							  <li class = ""><a href="#memTab2" data-toggle="tab">নতুন সদস্য</a></li>
							  <li class = ""><a href="#memTab3" data-toggle="tab">সংশোধণ</a></li>
							  <li class = ""><a href="#memTab4" data-toggle="tab">সদস্য লিস্ট</a></li>
							</ul>
							<div class = "tab-content">
								<div class = "tab-pane fade in row-fluid active" id = "memTab1" class = "active">
									<div class = "span12" style = "padding:4%;padding-top:0%;text-align:center;">
										<legend>সদস্য সার্চ ইঞ্জিন</legend>
										<form action = "javascript:memSearch('searchEng')" class="form-search">
											  <input id = "searchEng" type="text" class="span6 input-medium search-query" placeholder = "সদস্য আইডি অথবা সদস্যের নাম লিখুন" autocomplete= "off">
											  <a class = "search" href = "#" onclick = "memSearch('searchEng')" style = "margin-left: -30px;"><i class="icon-large icon-search"></i></a>
											</form>
									</div>
									<div id ="searchEngGenRes" class= "span12" style = "padding:4%;padding-top:0%;margin:0%;display:none;">
									</div>
								</div>
								<div class = "tab-pane fade in row-fluid" id = "memTab2">
								<div class = "span12" style = "padding:4%;padding-top:0%">
								<legend>সাধারণ তথ্য</legend>
								<form>
									<div class = "row-fluid">
										<div class = "span4">
											<label for = "mAdd1">*সম্পূর্ন নাম</label>
											<input id = "mAdd1" type="text" placeholder="পূর্ণ নাম">
										</div>
										<div class = "span4">
											<label for = "mAdd2">*গোত্র</label>
											<select id = "mAdd2" onchange = "gotraSelector()">
												<option value = ''>সিলেক্ট করুন</option>
												<option value = 'diff'>অন্যান্য</option>
												<?php
												require './includes/mysql.php';
												$query_gotra = "SELECT * FROM `gotra_list` WHERE 1";
												$result_gotra = mysqli_query($link, $query_gotra);
												$gotra_array = [];
												while($row_gotra = mysqli_fetch_array($result_gotra, MYSQLI_NUM))
												{
													array_push($gotra_array, $row_gotra[0]);
												}
												
												foreach ($gotra_array as $value) {
													echo "<option>" . $value . "</option>";
												}
												?>
											</select>
											<input id = "mAdd13" type = "text"  style = "display:none;">
										</div>
										<div class = "span4">
												<label for = "mAdd12">*সদস্যের ধরণ</label>
												<select id = "mAdd12">
													<option value ="">সিলেক্ট করুন</option>
													<option>কমিটি সদস্য</option>
													<option>সাধারণ সদস্য</option>
												</select>
										</div>
									</div>
									<br>
									<legend>ঠিকানা ও যোগাযোগ</legend>
									<div class = "row-fluid">
										<div class = "span4">
											<label for = "mAdd3">*ঠিকানা</label>
											<input id = "mAdd3" type = "text" placeholder = "অ্যাপার্টমেন্ট নং./রাস্তা নং.">
											<label for = "mAdd4">*পোস্ট অফিস</label>
											<input id = "mAdd4" type = "text" placeholder = "পোস্ট অফিস এর নাম">
											<label for = "mAdd11">*থানা</label>
											<input id = "mAdd11" type = "text" placeholder = "থানা">
										</div>
										<div class = "span4">
											<label for = "mAdd5">*জেলা</label>
											<input id = "mAdd5" type = "text" placeholder = "জেলার নাম" value= "নারায়নগঞ্জ">
											<label for = "mAdd6">পোস্ট কোড</label>
											<input id = "mAdd6" type = "text" placeholder = "যেমনঃ ১৪০০">
											<label for = "mAdd7">*দেশ</label>
											<input id = "mAdd7" type = "text" placeholder = "দেশের নাম" value = "বাংলাদেশ">
										</div>
										<div class = "span4">
											<label for = "mAdd8">ইমেইল</label>
											<input id = "mAdd8" type = "email" placeholder = "e.g. someone@domain.com">
											<label for = "mAdd9">*ফোন/মোবাইল নং.</label>
											<input id = "mAdd9" type = "text" placeholder = "ফোন/মোবাইল নং.">
											<label for = "mAdd10">*মাসিক প্রনামীর পরিমাণ</label>
											<input id = "mAdd10" type = "text" placeholder = "প্রনামীর পরিমাণ"><br>
											<span class="help-block">* চিহ্নিত বক্স গুলো অবস্য পূরনীয়</span>
											<button id = "mAddButton1" class="span4 btn btn-block" type="button" style = "margin:0;" onclick = "memAdd()">ক্লিক</button>
											<button id = "mAddButton2" class="btn btn-link" type="button" style = "display:none;" onclick = "clearAll()">নতুন</button>
										</div>
									</div>
									</form>	
									</div>
									<hr>
								</div>
								<div class = "tab-pane fade in row-fluid" id = "memTab3">
									<!-- for editing info -->
									<div class ="span12">
										<center>
										<legend>তথ্য সংশোধণ</legend>
										<form action = "javascript:memSearch('memEdit')" class="form-search">
											  <input id = "memEdit" type="text" class="span6 input-medium search-query" placeholder = "সদস্য আইডি অথবা সদস্যের নাম লিখুন" autocomplete= "off">
											  <a class = "search" href = "#" onclick = "memSearch('memEdit')" style = "margin-left: -30px;"><i class="icon-large icon-search"></i></a>
										</form>
										</center>
									</div>									
									<div id = "memEditGenRes" class = "span12" style = "padding:4%;padding-top:0%;margin:0%;display:none;"></div>
								</div>
								<div class = "tab-pane fade in row-fluid" id = "memTab4">
									<!-- for member list -->
									<div class = "span12" style = "padding:4%;padding-top:0%;">
										<a href = "./memlist.php" class ="btn btn-primary" target = "_blank"><i class="icon-print"></i> প্রিন্ট</a>
										<br>
										<table id = "memList" class = "table table-bordered">
											<thead>
												<th>সদস্য আইডি</th>
												<th>নাম</th>
												<th>ফোন/মোবাইল নং.</th>
											</thead>
											<tbody>
										<?php
											require './includes/mysql.php';
											$query_list = "SELECT * FROM `member_info` WHERE 1";
											$result = mysqli_query($link, $query_list);
											while($row = mysqli_fetch_array($result))
											{
												echo "<tr>";
												echo "<td>" . $row['memId'] . "</td>";
												echo "<td>" . $row['Name'] . "</td>";
												echo "<td>" . $row['tel'] . "</td>";
												echo "</tr>";
											}
										?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							</div>
						</div>
						<!--donation-->
						<div class = "navTabs tab-pane fade in" id = "navTab3">
							<div class="tabbable">
					              <ul class="nav nav-tabs">
					                <li class="active"><a href="#Don1" data-toggle="tab">মাসিক প্রনামী গ্রহন</a></li>
					                <li class=""><a href="#Don2" data-toggle="tab">অন্যান্য প্রনামী গ্রহন</a></li>
					                <li class=""><a href="#Don3" data-toggle="tab">দৈনিক আদায়</a></li>
					              </ul>
					              <div class="tab-content">
					                <div class="tab-pane row-fluid active fade in" id="Don1">
					                  <div class = "span12" style = "padding:0% 4% 4% 4%">
					                  	<div class = "row-fluid">
					                  		<div id = "searchRes1" class = "span12" style = "text-align:center;">
											<legend>মাসিক প্রনামী গ্রহন</legend>
											<form action = "javascript:memSearch('DonSearch')" class="form-search">
											  <input id = "DonSearch" type="text" class="span5 input-medium search-query" placeholder = "সদস্য আইডি অথবা সদস্যের নাম লিখুন" autocomplete="off">
											  <a class = "search" href = "#" onclick = "memSearch('DonSearch')" style = "margin-left: -30px;"><i class="icon-large icon-search"></i></a>
											</form>
											</div>
											<div id ="DonSearchGenRes" class= "span12" style = "padding:4%;padding-top:0%;margin:0%;display:none;">
											</div>
										</div>
					                  </div>
					                </div>
					                <!--other donation-->
					                <div class="tab-pane row-fluid fade in" id="Don2">
					                  <div class = "span12" style = "padding:0% 4% 4% 4%">
					                  	<center>
					                  	<label class="radio inline" for= "RadioMember">সদস্য</label>
					                  	<input type = "radio" name = "memberType" id = "RadioMember" onclick = "OtherDon('member')" checked />
					                  	<label class="radio inline" for = "RadioNonMember">অন্যান্য</label>
					                  	<input type = "radio" name = "memberType" id = "RadioNonMember" onclick = "OtherDon('nonMember')"/>
					                  	<br><br>
					                  	<form action = "javascript:memSearch('otherDon')" class="form-search">
											  <input id = "otherDon" type="text" class="span6 input-medium search-query" placeholder = "সদস্য আইডি অথবা সদস্যের নাম লিখুন" autocomplete= "off">
											  <a class = "search" href = "#" onclick = "memSearch('otherDon')" style = "margin-left: -30px;"><i class="icon-large icon-search"></i></a>
										</form>
										</center>
					                  	<div id ="otherDonGenRes" class= "span12" style = "padding:4%;padding-top:0%;margin:0%;display:none;">
										</div>
					                  </div>
					                </div>
					                <div class="tab-pane row-fluid fade in" id="Don3">
										<div class = "span12" style = "padding:0% 4% 4% 4%">
											<center>
												<div class = "well">
													<div class="input-append input-prepend">
											  			<span class="add-on"><i class="icon-calendar"></i></span>
											  			<input id="datePicker" type="text">
											  			<button type = "button" class = "btn" onclick = "dailyConn('false')"><i class="icon-ok"></i></button>
													</div>
												</div>
											</center>
											<br>
											<div class = "row-fluid">
												<center>
												<div id = "dailyCollRes" class = "span6" style = "margin-left: 25%;">
												</div>
												</center>
											</div>
										</div>
					                </div>
					              </div>
					            </div>
						</div>
						<div class = "navTabs fade in tab-pane" id = "navTab4" style = "width:100%;">
							<div class="tabbable">
								<ul class="nav nav-tabs">
					                <li class="active"><a href="#Inv1" data-toggle="tab">সামগ্রী ডাটাবেস</a></li>
					                <li class=""><a href="#Inv2" data-toggle="tab">সামগ্রী বিক্রয়</a></li>
					                <!--<li class=""><a href="#Inv3" data-toggle="tab">দৈনিক আদায়</a></li>-->
					            </ul>
					            <div class = "tab-content">
					            	<div class="tab-pane row-fluid active fade in" id="Inv1">
					                  <div class = "span12">
					                  	<div class="tabbable">
					                  		<ul class="nav nav-tabs">
							                <li class="active"><a href="#invDb1" data-toggle="tab">বই</a></li>
							                <li><a href="#invDb2" data-toggle="tab">ছবি</a></li>
							                <li><a href="#invDb3" data-toggle="tab">নতুন বই</a></li>
							                <li><a href="#invDb4" data-toggle="tab">নতুন ছবি</a></li>
							              </ul>
							              <div class="tab-content" style = "padding-left:4%;">
							                <div class="tab-pane active" id="invDb1">
							                  <div class = "span12" style = "padding:4%;padding-top:0%;">
												<a href = "./includes/otherlist.php?type=book" class ="btn btn-primary" target = "_blank"><i class="icon-print"></i> প্রিন্ট</a>
												<br>
												<table id = "bookList" class = "table table-bordered">
													<thead>
														<th>বই আইডি</th>
														<th>বইয়ের নাম</th>
														<th>লেখক</th>
														<th>মুল্য</th>
														<th>সংখ্যা</th>
														<th></th>
													</thead>
													<tbody>
												<?php
													require './includes/mysql.php';
													$query_list = "SELECT * FROM `book_list` WHERE 1";
													$result = mysqli_query($link, $query_list);
													require_once './includes/numaricconv.php';
													while($row = mysqli_fetch_array($result))
													{
														echo "<tr>";
														echo "<td>" . $row['bookId'] . "</td>";
														echo "<td>" . $row['bookName'] . "</td>";
														echo "<td>" . $row['writer'] . "</td>";
														echo "<td>৳" .str_replace($en, $bn, $row['price']) . "</td>";
														echo "<td>" . str_replace($en, $bn, $row['count']) . "</td>";
														echo "<td style = 'text-align: center;'>" . "<a class = 'btn btn-small' href = './edititem.php?id=" . $row['bookId'] . "' target = '_blank'>সংশোধণ/স্টক সংযোজন</a></td>";
														echo "</tr>";
													}
												?>
													</tbody>
												</table>
											  </div>
							                </div>
							                <div class="tab-pane" id="invDb2">
							                  <div class = "span12" style = "padding:4%;padding-top:0%;">
												<a href = "./includes/otherlist.php?type=photo" class ="btn btn-primary" target = "_blank"><i class="icon-print"></i> প্রিন্ট</a>
												<br>
												<table id = "photoList" class = "table table-bordered">
													<thead>
														<th>ছবি আইডি</th>
														<th>ছবির নাম</th>
														<th>মুল্য</th>
														<th>সংখ্যা</th>
														<th></th>
													</thead>
													<tbody>
												<?php
													require './includes/mysql.php';
													$query_list = "SELECT * FROM `photo_list` WHERE 1";
													$result = mysqli_query($link, $query_list);
													require_once './includes/numaricconv.php';
													while($row = mysqli_fetch_array($result))
													{
														echo "<tr>";
														echo "<td>" . $row['photoId'] . "</td>";
														echo "<td>" . $row['photoName'] . "</td>";
														echo "<td>৳" .str_replace($en, $bn, $row['price']) . "</td>";
														echo "<td>" . str_replace($en, $bn, $row['count']) . "</td>";
														echo "<td style = 'text-align: center;'>" . "<a class = 'btn btn-small' href = './edititem.php?id=" . $row['photoId'] . "' target = '_blank'>সংশোধণ/স্টক সংযোজন</a></td>";
														echo "</tr>";
													}
												?>
													</tbody>
												</table>
											  </div>
							                </div>
							                <div class="tab-pane" id="invDb3"  style = "padding-bottom:4%;">
							                	<div class ="row-fluid">
							                		<div class ="span3">
							                		</div>
							                		<div class = "span3">
							                			<label for = "adBk1">বইয়ের নাম:</label>
							                  			<input id = "adBk1" type = "text" />
							                  			<label for = "adBk2">লেখক:</label>
							                  			<input id = "adBk2" type = "text" />
							                		</div>
							                		<div class = "span3">
							                			<label for = "adBk3">মুল্য:</label>
							                  			<input id = "adBk3" type = "text" />
							                  			<label for = "adBk4">পরিমাণ:</label>
							                  			<input id = "adBk4" type = "text" />
							                		</div>
							                		<div class ="span3">
							                		</div>
							                	</div>
							                	<div class ="row-fluid">
							                		<div class = "span4">
							                		</div>
							                		<div class = "span4">
							                			<button type = "button" class = "btn btn-block btn-primary" onclick = "newBook()">নতুন বই</button>
							                		</div>
							                		<div class = "span4">
							                		</div>
							                	</div>
							                </div>
							                <div class="tab-pane" id="invDb4" style = "padding-bottom:4%;">
							                	<div class ="row-fluid" >
							                		<div class ="span3">
							                		</div>
							                		<div class = "span3">
							                			<label for = "adPh1">ছবির নাম:</label>
							                  			<input id = "adPh1" type = "text" />
							                  			<label for = "adPh3">পরিমাণ:</label>
							                  			<input id = "adPh3" type = "text" />
							                		</div>
							                		<div class = "span3">
							                			<label for = "adPh2">মুল্য:</label>
							                  			<input id = "adPh2" type = "text" />
							                		</div>
							                		<div class ="span3">
							                		</div>
							                	</div>
							                	<div class ="row-fluid">
							                		<div class = "span4">
							                		</div>
							                		<div class = "span4">
							                			<button type = "button" class = "btn btn-block btn-primary" onclick = "newPhoto()">নতুন ছবি</button>
							                		</div>
							                		<div class = "span4">
							                		</div>
							                	</div>
							                </div>
							              </div>
							            </div>
					                  </div>
					              </div>
					              <div class="tab-pane row-fluid fade in" id="Inv2">
					                  <div class = "span12" style = "padding:0% 4% 4% 4%">
					                  	<!--sell items-->
					                  	<div class="well/">
					                  		<div class = "row-fluid">
					                  			<div class ="span4">
					                  				<label for = "sellBookPh1">নাম</label>
					                  				<input id="sellBookPh1" type="text"><br>
					                  			</div>
					                  			<div class ="span4">
					                  				<label for ="sellBookPh2">ঠিকানা</label>
					                  				<textarea id = "sellBookPh2" rows = "1"></textarea>
					                  			</div>
					                  			<div class = "span4">
					                  				<form action = "javascript:addNewItem()" >
					                  					<label for = "sellBookPh">item ID: </label>
  														<div class="input-append">
														  <input id="sellBookPh" type="text">
														  <button class="btn" type="submit">Go!</button>
														</div>
					                  				</form>
					                  			</div>
					                  		</div>
										</div>
										<div class = "well">
											<table class ="table"  id = "additems">
												<thead>
													<th>#</th>
													<th>নাম</th>
													<th>মুল্য</th>
													<th>পরিমাণ</th>
												</thead>
											</table>
					                  	</div>
					                  	<button id = "itemDumb" class = "btn" type= "button" onclick= "dumb()">রশিদ</button>
					                  	<button class = "btn" type= "button" onclick= "clearItemTable()">নতুন</button>
					                  </div>
					              </div>
					              <!--<div class="tab-pane row-fluid active fade in" id="Inv3">
					                  <div class = "span12" style = "padding:0% 4% 4% 4%">
					                  </div>
					              </div>-->
					            </div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
									<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style = "width: 80%;left: 30%">
									  <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									    <h3 id="myModalLabel">তথ্য সংশোধণ</h3>
									  </div>
									  <div id = "modalb1" class="modal-body" style = "min-height:50%;max-height:100%">
									    <p>One fine body…</p>
									  </div>
									  <div class="modal-footer">
									    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
									  </div>
									</div>

									<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-header">
									    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									    <h3 id="myModalLabel">অন্যান্য প্রনামী গ্রহন</h3>
									  </div>
									  <div id = "modalb2" class="modal-body">
									  </div>
									  <div class="modal-footer">
									    <button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i></button>
									    <button class="btn btn-primary" onclick = "collectOtherDon()"><i class="icon-ok icon-large"></i></button>
									  </div>
									</div>
	 <script src="./js/jquery.js"></script>
	 <script src="./js/jquery.jeditable.js"></script>
	 <script src="./js/myjs.js"></script>
	 <script src="./js/bootstrap-datepicker.js"></script>
	 <script src="./bootstrap/js/bootstrap.min.js"></script>
	 <script src="./js/jquery.dataTables.min.js"></script>
	 <script src="./js/DT_bootstrap.js"></script>
	 <script src="./js/paging.js"></script>
	 	 <script type="text/javascript">
$('#searchEng').typeahead({
    source: function (query, process) {
        return $.ajax({
        	       url: './includes/searchtypehead.php?typehead=true&q='+query,
                   type:'GET',
                   success: function (data) {
                   	data2 = data.substring(data.indexOf('['), (data.lastIndexOf(']')+1));
                   	console.log(data2.split(''));
                   	console.log(data2);
                   	response = $.parseJSON(data2);
                       return process(response);
                   }
               });
    }

});

$('#memEdit').typeahead({
    source: function (query, process) {
        return $.ajax({
        	       url: './includes/searchtypehead.php?typehead=true&q='+query,
                   type:'GET',
                   success: function (data) {
                   	data2 = data.substring(data.indexOf('['), (data.lastIndexOf(']')+1));
                   	console.log(data2.split(''));
                   	console.log(data2);
                   	response = $.parseJSON(data2);
                       return process(response);
                   }
               });
    }

});

$('#DonSearch').typeahead({
    source: function (query, process) {
        return $.ajax({
        	       url: './includes/searchtypehead.php?typehead=true&q='+query,
                   type:'GET',
                   success: function (data) {
                   	data2 = data.substring(data.indexOf('['), (data.lastIndexOf(']')+1));
                   	console.log(data2.split(''));
                   	console.log(data2);
                   	response = $.parseJSON(data2);
                       return process(response);
                   }
               });
    }
});

    $('#sellBookPh').typeahead({
    source: function (query, process) {
        return $.ajax({
        	       url: './includes/searchitem.php?typehead=true&q='+query,
                   type:'GET',
                   success: function (data) {
                   	data2 = data.substring(data.indexOf('['), (data.lastIndexOf(']')+1));
                   	console.log(data2.split(''));
                   	console.log(data2);
                   	response = $.parseJSON(data2);
                       return process(response);
                   }
               });
    }

});
var nowTemp = new Date();
var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
$('#datePicker').datepicker({
	format: 'dd/mm/yyyy',
	onRender: function(date) {
    return date.valueOf() > now.valueOf() ? 'disabled' : '';
  }
});

//$(document).ready(function(){
//    $('body').on("keyup",'#monDonDate', function(){
//        if(document.getElementById('monDonDate').value==''){
//        	document.getElementById('ConfirmDon').disabled = true;
//        }else{
//        	document.getElementById('ConfirmDon').disabled = false;
//        	}
//    });
//});

$(document).ready(function() {
    $('#memList').dataTable({
    	"sPaginationType": "bootstrap"
    });
    $('#bookList').dataTable({
    	"sPaginationType": "bootstrap"
    });
    $('#photoList').dataTable({
    	"sPaginationType": "bootstrap"
    });
    $('.edit').editable('http://www.example.com/save.php');
} );

	 </script>
	 <script type="text/javascript">// <![CDATA[
$(window).load(function() { $("#spinner").fadeOut("slow"); })
// ]]></script>
</body>
</html>