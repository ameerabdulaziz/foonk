<?php
if (isset($_POST['cancel'])):
    header('Location: ../index.php');
    exit;
endif;
require_once '../init.php';
$customer = new Customer();
$customer->logIn();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../<?=CSS?>bootstrap.css">
</head>
<body>

<form method="post" style=" width: 300px; margin: 100px auto;">
    <h1>Please Log In</h1>
    <?php Message::display();?>
    <div class="form-group">
        <label for="email">Email</label>
        <input class="form-control" style="background-color: #EAEAEA;" type="email" name="email" id="email">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" style="background-color: #EAEAEA;" type="password" name="password" id="password">
    </div>
    <input class="btn btn-primary" type="submit" name="login" value="Log In" onclick="return doValidate();">
    <input class="btn btn-default" type="submit" name="cancel" value="Cancel">
</form>

<script>
    // function doValidate() {
    //     try {
    //         var email = document.getElementById('email').value;
    //         var password = document.getElementById('password').value;
    //         if (email == null || email === '' || password == null || password === '') {
    //             alert('Both email and password are required');
    //             return false;
    //         } else if (email.indexOf('@') === -1) {
    //             alert('Invalid Email');
    //             return false;
    //         }
    //         return true;
    //     } catch (e) {
    //         return false;
    //     }
    // }
</script>
</body>
</html>