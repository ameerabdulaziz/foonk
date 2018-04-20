<?php
if (isset($_POST['cancel'])):
    header('Location: ../index.php');
    exit;
endif;
require_once '../init.php';
$customer->signUp();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../<?=CSS?>bootstrap.css">
    <title>Sign Up</title>
</head>

<body>
<div class="container">
    <form method="POST" action="" style=" width: 300px; margin: 50px auto;">
        <h1 style="color: #888;">Please Sign Up</h1>
        <?php Message::display(); ?>
<!--        --><?php //if (isset($_SESSION['error_message'])): ?>
<!--            <div class="alert alert-danger alert-dismissable text-center">-->
<!--                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>-->
<!--                --><?php
//                echo $_SESSION['error_message'];
//                unset($_SESSION['error_message']); ?>
<!--            </div>-->
<!--        --><?php //endif; ?>
        <div class="form-group">
            <label for="full-name">Full Name</label>
            <input class="form-control" style="background-color: #EAEAEA;" type="text" name="full_name" id="full-name">
        </div>

        <div class="form-group">
            <label for="username">username</label>
            <input class="form-control" style="background-color: #EAEAEA;" type="text" name="username" id="username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" style="background-color: #EAEAEA;" type="email" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" style="background-color: #EAEAEA;" type="password" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input class="form-control" style="background-color: #EAEAEA;" type="text" name="address" id="address">
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input class="form-control" style="background-color: #EAEAEA;" type="tel" name="phone" id="phone">
        </div>
        <input class="btn btn-primary" type="submit" name="sign_up" value="Sign Up">
        <a class="btn btn-default" href="../index.php">Cancel</a>
    </form>
</div>
</body>
</html>