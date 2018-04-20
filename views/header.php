<!doctype html>
<html lang="en">
<head>
    <title>Foonk Shop</title>
    <link rel="stylesheet" href="<?=CSS?>bootstrap.css">
    <link rel="stylesheet" href="<?=CSS?>style.css">
</head>
<body onload="loadCart()">
<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container" style="background-color: unset;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img id="logo" src="<?=IMAGES?>logo2.png" alt="Logo"></a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="fruits.php">Fruits</a></li>
                    <li><a href="vegetables.php">Vegetables</a></li>
                    <li><a href="drinks.php">Drinks</a></li>
                    <li><a href="desserts.php">Desserts</a></li>
                    <li><a href="others.php">Others</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['cust_id'])): ?>
                        <li><a href="cart.php"><b>$<?=$_SESSION['balance']?></b> <span class="glyphicon glyphicon-shopping-cart"></span> My Cart</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['full_name']?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="includes/logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><a href="<?=VIEWS?>login.php">Log In</a></li>
                        <li><a href="<?=VIEWS?>sign_up.php">Sign Up</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>