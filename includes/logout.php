<?php
session_start();
unset($_SESSION['cust_id'], $_SESSION['full_name'], $_SESSION['balance'], $_SESSION['max_buying']);
header('Location: ../index.php');