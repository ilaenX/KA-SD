<?php
require_once('includes/connection.php');
include 'includes/sessions.php';

// LOGIN USER
global $dbconnect, $username, $errors;
if (isset($_POST['username']) && !empty($_POST['username']) || isset($_POST['password']) && !empty($_POST['password'])) {

  // grap form values
  $username = $_POST['username'];
  $password = $_POST['password'];

  // make sure form is filled properly
  if (empty($username)) {
    $errors[] = "Username is required";
  }
  if (empty($password)) {
    $errors[] = "Password is required";
  }
  // attempt login if no errors on form

  //establish connection to db
  $sql = "SELECT * FROM registration WHERE username=:username AND password=:password LIMIT 1";
  $stmt = $dbconnect->prepare($sql);
  $stmt->bindValue(':username',$username);
  $stmt->bindValue(':password',$password);
  $stmt->execute();

  if($stmt->rowCount() == 1){
    if($logged_in_user = $stmt->fetch())
    $_SESSION['user'] = $logged_in_user;
    $_SESSION['success']  = "You are now logged in";
    $_SESSION['loggedin']  = true;

    header('location: welcome.php');
  } else{
    // Display an error message if username doesn't exist
    $errors[] = "Wrong username/password combination";
  }
}
?>
<!DOCTYPE HTML>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="CSS/login.css" />
    <title>Login</title>
  </head>
  <body>
    <?php
      echo session_error();
      echo session_success();
    ?>
    <div class="container">
      <form action="index.php" method="POST" id="form" class="form">
        <h2>Login</h2>
        <p style="color: #fff">
          <?php 
            if (isset($errors)) {
              foreach ($errors as $error) {
              echo $error;
              }
            }
          ?>
        </p>
        <div class="form-control">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" placeholder="Enter username"/>
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter password"/>
          <small>Error message</small>
        </div>
        <div class="form-control">
        <p>Not a user? <a href=register.php>Register</a></p>
        </div>
        <button name="login_btn" type="submit">Login</button>
      </form>
    </div>
    <!--<script src="JS/Login.js"></script>-->
  </body>
</html>