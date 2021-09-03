<?php
require_once('includes/connection.php');
include 'includes/sessions.php';
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="CSS/boot.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hello,<strong><?php echo $_SESSION["user"]["username"];?></strong> Welcome to our site.</h1>
    </div>

    <p>
        <!--<a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>-->
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
</body>
</html>