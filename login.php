<!DOCTYPE html>

<?php
session_start();
if(isset($_SESSION['id']))
    header('Location: ./index.php') ;

?>
<html>
<head>
<link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>
<div class = "hero-unit" style = "margin:100px 300px;">
    <form style = "margin-left:75px;" class="form-horizontal" action = "javascript:login()" method = "post">
    <div class="control-group">
    <label class="control-label" for="inputEmail">Username</label>
    <div class="controls">
    <input type="text" id="inputEmail" placeholder="Username" name = "id" autocomplete="off" required>
    </div>
    </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
    <input type="password" id="inputPassword" placeholder="Password" name = "pass" required>
    </div>
    </div>
    <div class="control-group">
    <div class="controls">
    <button type="submit" class="btn btn-primary">Sign in</button><span id = "img"></span><br><br>
    <span id = "alert" class="alert" style = "display:none;" >
          <strong>ভুল তথ্য</strong>
    </span>
    </div>
    </div>
    </form>
</div>

<script src="js/jquery.js"></script>
<script src="./bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
function login () {
    var Username = $('#inputEmail').val();
    var password = $('#inputPassword').val();
    $('#img').append('<img src = "./img/ajax-loader.gif" ?/>');
    $.ajax({
        url: './validate.php',
        type: 'POST',
        data:{
            id:Username,
            pass:password
        },
        success: function  (data) {
            $('#img').html('');
            if(data=='success')
            {
                window.location = './index.php';
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