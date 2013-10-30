<?php
if(!isset($_GET['id']))
  exit();

require './includes/mysql.php';
$id = $_GET['id'];

$query = "SELECT * FROM `receipt_log` WHERE `invNo` = " . $id;
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$time = new DateTime($row['time']);
$date = $time->format('d/m/Y');

require_once './includes/numaricconv.php';
$id_bn = str_replace($en, $bn, $id);
$date_bn = str_replace($en, $bn, $date);
$ammnt = str_replace($en, $bn, $row['ammnt']);

$query2 = "SELECT * FROM `donation_types` ORDER BY `id`";
$result2 = mysqli_query($link,$query2);
$donTypes = [];
while($row2 = mysqli_fetch_array($result2))
{
$donTypes[$row2['id']] = $row2['name'];
}
?>


<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $id; ?></title>
    <!-- Bootstrap -->
    <!--link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">-->
    <style type="text/css">
    body{
      margin-left: 20px;
      font-family: kalpurush;
      line-height: 1em;
      font-size: 80%;
    }
	div.box{
	border: solid 1px;
	display: inline-block;
	padding: 3px;
	border-radius: 5px;
  background-color: rgba(141, 140, 140, 0.3);
	}
  .border-left{
    border-left: solid black 1px;
    width: 25%;
  }
  .border-right{
    border-right: solid black 1px;
  }
  .border-bottom{
    border-bottom: solid black 1px;
  }
  .main{
    border-collapse:collapse;
    border: solid 1px;
    width: 100%;
    height: 200px;
  }
  .main th{
    border: solid 1px;
  }
  .main td{
    border-bottom: none;
  }
  .devide{
    width: 300px;
    display: inline-block;
  }
  .footer{
    float: right;
    border-top: solid 1px;
  }
  .watermark{
    position:absolute;
  z-index: -1000;
  font-size: 3em;
  color: rgba(0, 0, 0, 0.3);
  -webkit-transform: rotate(-45deg);
  -moz-transform: rotate(-45deg);
  margin-left: 80px;
  margin-top: 100px;
  }
  .head{
    font-size: 20;
    -webkit-margin-after: 0px;
    -webkit-margin-before: 0px;
  }
  @font-face {
    font-family: kalpurush;
    src: url('font/kalpurush.ttf');
}
@media print {
  .page-break { display: block; page-break-before: always; }
}
    </style>
  </head>
  <body>
      <div>
        <div class = "devide" style = "margin-left:20px">
          <center>
          <h4 class= "head">শ্রী শ্রী সত্যধাম</h4>
          <p>
          ৪৪৮, নূতন পালপাড়া, নারায়নগঞ্জ - ১৪০০, <br>  বাংলাদেশ, ফোন - ০২-৭৬৪-৪৭২৮ 
          </p>
          <div class = "box"><small>প্রনামী রসিদ</small></div>
          </center>
          <table>
            <tbody>
              <tr>
                <td>নং:</td>
                <td><strong><?php echo $id_bn; ?><strong></td>
              </tr>
            </tbody>
          </table>
          <table>
            <tbody>
              <tr>
                <td style = "white-space:nowrap;">শ্রী/শ্রীমতী</td>
                <td>: <?php echo $row['name']; ?></td>
              </tr>
              <tr>
                <td>ঠিকানা</td>
                <td>: <?php echo $row['address']; ?></td>
              </tr>
            </tbody>
          </table>
          <p>হইতে নিম্ন লিখিত মর্মে মোট <strong><u><?php echo $ammnt; ?>/=</u></strong> টাকা বুঝিয়া পাইলাম।</p>
          <table class = "main">
            <thead>
              <th style = "padding-top:5px;height:10%;width:5%;">নং</th>
              <th style = "padding-top:5px;">প্রনামী</th>
              <th style = "padding-top:5px;">পরিমান</th>
            </thead>
            <tbody>
              <?php
                if($row['donType']!='1'){
                  //if(strpos($row['donType'], ' ') == false){
                  //    $givenDtype = str_split($row['donType']);
                  //    $itemNo = strlen($row['donType']);
                  //  }
                  //else{
                    $givenDtype = explode(' ' ,$row['donType']);
                    $itemNo = count($givenDtype);
                    $itemIdArr = explode(' ', $row['remarks']);
                    $itemCountArr = explode(' ', $row['count']);
                  //}
                  //var_dump($givenDtype);
                  $indAmmnt = explode(' ', $row['indAmmnt']);
                  for ($i=1; ($i <=$itemNo || $i<=10) ; $i++) { 
                    if($i <=$itemNo){
                      if($givenDtype[$i-1] != 11 && $givenDtype[$i-1] != 12){
                        echo "<tr>";
                        echo '<td class ="border-right" style = "height:20%;padding: 0px;padding-left: 5px;">' .str_replace($en, $bn, $i). '.</td>';
                        echo '<td><span style = "padding-left: 5px;">' . $donTypes[$givenDtype[$i-1]] . '</span></td>';
                        echo '<td class = "border-left"><span style = "float:right;">' . $indAmmnt[$i-1] . '/=</span></td>';
                        echo "</tr>";
                      }else{
                        if($givenDtype[$i-1] == 11){
                          $queryBookDetail = 'SELECT `bookName` FROM `book_list` WHERE `bookId` = "' . $itemIdArr[$i-1] . '"';
                          $resBook = mysqli_query($link, $queryBookDetail);
                          $bookName = mysqli_fetch_array($resBook, MYSQLI_ASSOC)['bookName'];
                          echo "<tr>";
                          echo '<td class ="border-right" style = "height:20%;padding: 0px;padding-left: 5px;">' .str_replace($en, $bn, $i). '.</td>';
                          echo '<td><span style = "padding-left: 5px;">' . $bookName . ' (' . str_replace($en, $bn, $itemCountArr[$i-1]) .  'টি)</span></td>';
                          echo '<td class = "border-left"><span style = "float:right;">' . $indAmmnt[$i-1] . '/=</span></td>';
                          echo "</tr>";
                        }
                        if($givenDtype[$i-1] == 12){
                          $queryPhotoDetail = 'SELECT `photoName` FROM `photo_list` WHERE `photoId` = "' . $itemIdArr[$i-1] . '"';
                          $resPhoto = mysqli_query($link, $queryPhotoDetail);
                          $photoName = mysqli_fetch_array($resPhoto, MYSQLI_ASSOC)['photoName'];
                          echo "<tr>";
                          echo '<td class ="border-right" style = "height:20%;padding: 0px;padding-left: 5px;">' .str_replace($en, $bn, $i). '.</td>';
                          echo '<td><span style = "padding-left: 5px;">' . $photoName . ' (' . str_replace($en, $bn, $itemCountArr[$i-1]) .  'টি)</span></td>';
                          echo '<td class = "border-left"><span style = "float:right;">' . $indAmmnt[$i-1] . '/=</span></td>';
                          echo "</tr>";
                        }
                      }
                    }else{
                      echo "<tr>";
                      echo '<td class ="border-right" style = "height:10%;padding: 0px;"></td>';
                      echo '<td></td>';
                      echo '<td class = "border-left"></td>';
                      echo "</tr>";
                    }
                  }
                }else{
                  $givenDtype = str_split($row['donType']);
                  $mon_list = [ 'বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন', 'কার্তিক', 'অগ্রহায়ণ', 'পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র'
                  ];
                  $split = explode(' ', $row['indAmmnt']);
                  $year = str_replace($en, $bn, $split[0]);
                  $months = str_split($split[2]);
                  $nm = substr_count($split[2], '1');
                  $str = '';
                  if($nm>1){
                    $flag= 0;
                    for ($i=0; $i < count($months) ; $i++) { 
                      if($months[$i]=='1')
                      {
                        if($flag == 1) continue;
                        $str .= $mon_list[$i];
                        if(($i+1)==count($months)-1 && $months[$i+1]=='1')
                        {
                          $str .= '-' . $mon_list[$i+1];
                          break;
                        }
                        if($months[$i+1]=='1') $flag =1;
                      }else{
                        if($flag==1){
                          $str .= '-' . $mon_list[$i-1] .', ' ;
                          $flag=0;
                        }else{
                          if($i!=0){
                            if($months[$i-1]=='1')
                              $str .= ', ';
                          }
                        }
                      }
                    }
                  }else{
                    for ($i=0; $i <count($months) ; $i++) { 
                      if($months[$i]=='1')
                        $str .= $mon_list[$i];
                    }
                  }
                  echo '<td class ="border-right" style = "height:20%;padding: 0px;padding-left: 5px;vertical-align: top;">১.</td>';
                  echo '<td><span style = "padding-left: 5px;">'
                   . $donTypes[1] . '<br>'
                   . 'মাস: ' . $str . '<br>'
                   . 'সাল: ' . $year .
                   '</span></td>';
                  echo '<td class = "border-left" style = "vertical-align: top;"><span style = "float:right;">' . $ammnt . '/=</span></td>';
                  echo "</tr>";
                  for ($i=1; $i <=6 ; $i++) { 
                    echo "<tr>";
                    echo '<td class ="border-right" style = "height:10%;padding: 0px;"></td>';
                    echo '<td></td>';
                    echo '<td class = "border-left"></td>';
                    echo "</tr>";
                  }
                }
                echo "<tr>";
                echo '<td style = "border-top:solid 1px;height:8%;padding: 0px;"></td>';
                echo '<td style = "border-top:solid 1px;"><span style= "float:right;">মোট টাকা:</span></td>';
                echo '<td class = "border-left" style = "border-top:solid 1px;"><span style = "float:right;">' . $ammnt . '/=</span></td>';
                echo "</tr>";
                ?>
            </tbody>
          </table>
          <table style = "width:100%;margin-top:25px;">
            <tbody>
              <tr>
                <td style = "float:left;">তারিখ</td>
                <td style = "float:left">: <?php echo $date_bn; ?> ইং</td>
                <td><span class = "footer">আদায়কারীর সাক্ষর</span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <span class ="page-break"></span>
        <div class = "devide" style = "margin-left:20px">
          <center>
          <h4 class = "head">শ্রী শ্রী সত্যধাম</h4>
          <p>
          ৪৪৮, নূতন পালপাড়া, নারায়নগঞ্জ - ১৪০০, <br>  বাংলাদেশ, ফোন - ০২-৭৬৪-৪৭২৮ 
          </p>
          <div class = "box"><small>প্রনামী রসিদ</small></div>
          </center>
          <table>
            <tbody>
              <tr>
                <td>নং:</td>
                <td><strong><?php echo $id_bn; ?></strong></td>
              </tr>
            </tbody>
          </table>
          <table>
            <tbody>
              <tr>
                <td style = "white-space:nowrap;">শ্রী/শ্রীমতী</td>
                <td>: <?php echo $row['name']; ?></td>
              </tr>
              <tr>
                <td>ঠিকানা</td>
                <td>: <?php echo $row['address']; ?></td>
              </tr>
            </tbody>
          </table>
          <p>হইতে নিম্ন লিখিত মর্মে মোট <strong><u><?php echo $ammnt; ?>/=</u></strong> টাকা বুঝিয়া পাইলাম।</p>
          <span class ="watermark">অফিস কপি</span>
          <table class = "main">
            <thead>
              <th style = "padding-top:5px;height:10%;width:5%;">নং</th>
              <th style = "padding-top:5px;">প্রনামী</th>
              <th style = "padding-top:5px;">পরিমান</th>
            </thead>
            <tbody>
              <?php
                if($row['donType']!='1'){
                  //if(strpos($row['donType'], ' ') == false){
                  //    $givenDtype = str_split($row['donType']);
                  //    $itemNo = strlen($row['donType']);
                  //  }
                  //else{
                    $givenDtype = explode(' ' ,$row['donType']);
                    $itemNo = count($givenDtype);
                  //}
                  //var_dump($givenDtype); 
                  $indAmmnt = explode(' ', $row['indAmmnt']);
                  for ($i=1; ($i <=$itemNo || $i<=7) ; $i++) {
                    if($i <=$itemNo){
                      if($givenDtype[$i-1] != 11 && $givenDtype[$i-1] != 12){
                        echo "<tr>";
                        echo '<td class ="border-right" style = "height:20%;padding: 0px;padding-left: 5px;">' .str_replace($en, $bn, $i). '.</td>';
                        echo '<td><span style = "padding-left: 5px;">' . $donTypes[$givenDtype[$i-1]] . '</span></td>';
                        echo '<td class = "border-left"><span style = "float:right;">' . $indAmmnt[$i-1] . '/=</span></td>';
                        echo "</tr>";
                      }else{
                        if($givenDtype[$i-1] == 11){
                          $queryBookDetail = 'SELECT `bookName` FROM `book_list` WHERE `bookId` = "' . $itemIdArr[$i-1] . '"';
                          $resBook = mysqli_query($link, $queryBookDetail);
                          $bookName = mysqli_fetch_array($resBook, MYSQLI_ASSOC)['bookName'];
                          echo "<tr>";
                          echo '<td class ="border-right" style = "height:20%;padding: 0px;padding-left: 5px;">' .str_replace($en, $bn, $i). '.</td>';
                          echo '<td><span style = "padding-left: 5px;">' . $bookName . ' (' . str_replace($en, $bn, $itemCountArr[$i-1]) .  'টি)</span></td>';
                          echo '<td class = "border-left"><span style = "float:right;">' . $indAmmnt[$i-1] . '/=</span></td>';
                          echo "</tr>";
                        }
                        if($givenDtype[$i-1] == 12){
                          $queryPhotoDetail = 'SELECT `photoName` FROM `photo_list` WHERE `photoId` = "' . $itemIdArr[$i-1] . '"';
                          $resPhoto = mysqli_query($link, $queryPhotoDetail);
                          $photoName = mysqli_fetch_array($resPhoto, MYSQLI_ASSOC)['photoName'];
                          echo "<tr>";
                          echo '<td class ="border-right" style = "height:20%;padding: 0px;padding-left: 5px;">' .str_replace($en, $bn, $i). '.</td>';
                          echo '<td><span style = "padding-left: 5px;">' . $photoName . ' (' . str_replace($en, $bn, $itemCountArr[$i-1]) .  'টি)</span></td>';
                          echo '<td class = "border-left"><span style = "float:right;">' . $indAmmnt[$i-1] . '/=</span></td>';
                          echo "</tr>";
                        }
                      }
                    }else{
                      echo "<tr>";
                      echo '<td class ="border-right" style = "height:10%;padding: 0px;"></td>';
                      echo '<td></td>';
                      echo '<td class = "border-left"></td>';
                      echo "</tr>";
                    }
                  }
                  
                }else{
                  $givenDtype = str_split($row['donType']);
                  $mon_list = [ 'বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন', 'কার্তিক', 'অগ্রহায়ণ', 'পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র'
                  ];
                  $split = explode(' ', $row['indAmmnt']);
                  $year = str_replace($en, $bn, $split[0]);
                  $months = str_split($split[2]);
                  $nm = substr_count($split[2], '1');
                  $str = '';
                  if($nm>1){
                    $flag= 0;
                    for ($i=0; $i < count($months) ; $i++) { 
                      if($months[$i]=='1')
                      {
                        if($flag == 1) continue;
                        $str .= $mon_list[$i];
                        if(($i+1)==count($months)-1 && $months[$i+1]=='1')
                        {
                          $str .= '-' . $mon_list[$i+1];
                          break;
                        }
                        if($months[$i+1]=='1') $flag =1;
                      }else{
                        if($flag==1){
                          $str .= '-' . $mon_list[$i-1] .', ';
                          $flag=0;
                        }else{
                          if($i!=0){
                            if($months[$i-1]=='1')
                              $str .= ', ';
                          }
                        }
                      }
                    }
                  }else{
                    for ($i=0; $i <count($months) ; $i++) { 
                      if($months[$i]=='1')
                        $str .= $mon_list[$i];
                    }
                  }
                  echo '<td class ="border-right" style = "height:20%;padding: 0px;padding-left: 5px;vertical-align: top;">১.</td>';
                  echo '<td><span style = "padding-left: 5px;">'
                   . $donTypes[1] . '<br>'
                   . 'মাস: ' . $str . '<br>'
                   . 'সাল: ' . $year .
                   '</span></td>';
                  echo '<td class = "border-left" style = "vertical-align: top;"><span style = "float:right;">' . $ammnt . '/=</span></td>';
                  echo "</tr>";
                  for ($i=1; $i <=6 ; $i++) { 
                    echo "<tr>";
                    echo '<td class ="border-right" style = "height:10%;padding: 0px;"></td>';
                    echo '<td></td>';
                    echo '<td class = "border-left"></td>';
                    echo "</tr>";
                  }
                }
                echo "<tr>";
                echo '<td style = "border-top:solid 1px;height:8%;padding: 0px;"></td>';
                echo '<td style = "border-top:solid 1px;"><span style= "float:right;">মোট টাকা:</span></td>';
                echo '<td class = "border-left" style = "border-top:solid 1px;"><span style = "float:right;">' . $ammnt . '/=</span></td>';
                echo "</tr>";
                ?>
            </tbody>
          </table>
          <table style = "width:100%;margin-top:25px;">
            <tbody>
              <tr>
                <td style = "float:left;">তারিখ</td>
                <td style = "float:left">: <?php echo $date_bn; ?> ইং</td>
                <td><span class = "footer">আদায়কারীর সাক্ষর</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <script src="./js/jquery.js"></script>
      <script type="text/javascript">
      $(document).ready(function () {
        window.print();
      });
      </script> 
  </body>
</html>