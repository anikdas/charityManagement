<!DOCTYPE html>

<?php
session_start();
if(!isset($_SESSION['id']))
    header('Location: ./login.php') ;

?>
<html>
<head>
<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div class = "hero-unit" style = "margin:100px 300px;">
    <form style = "margin-left:75px;" class="form-horizontal" action = "javascript:login()" method = "post">
    <div class="control-group">
    <label class="control-label" for="inputPassword1">Old Password</label>
    <div class="controls">
    <input type="password" id="inputPassword1" placeholder="Password" name = "pass" required>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword2">New Password</label>
    <div class="controls">
    <input type="password" id="inputPassword2" placeholder="Password" name = "pass" required>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword3">Confirm Password</label>
    <div class="controls">
    <input type="password" id="inputPassword3" placeholder="Password" name = "pass" required>
    </div>
    </div>
    <div class="control-group">
    <div class="controls">
    <button type="submit" class="btn btn-primary">change password</button><span id = "img"></span><br><br>
    <span id = "alert" class="alert" style = "display:none;" >
          <strong>ভুল তথ্য</strong>
    </span>
    </div>
    </div>
    </form>
</div>

<script src="js/jquery.js"></script>
<script src="js/myjs.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
function login () {
    var oldPass = $('#inputPassword1').val();
    var newPass = $('#inputPassword2').val();
    var newPass2 = $('#inputPassword3').val();
    if(newPass != newPass2){
        alert('Password does not match');
        return false;
    }
    $('#img').append('<img src = "./img/ajax-loader.gif" ?/>');
    $.ajax({
        url: './includes/cpass.php',
        type: 'POST',
        data:{
            oldPass:oldPass,
            newPass:newPass
        },
        success: function  (data) {
            $('#img').html('');
            if(bomRemover(data)=='success')
            {
                window.location = './login.php';
            }
            else{
                $('#alert').css('display','inline');
                $('#inputEmail').val('');
                $('#inputEmail').val('');
                $('#inputPassword').val('');
            }
        }
    });
}
</script>
</body>
</html>