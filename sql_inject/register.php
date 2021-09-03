<?php
require_once('includes/connection.php');
include 'includes/sessions.php';

if (isset($_POST['submit'])) {//process only if the 'register' button was clicked
    if ($_POST['username']==null) {
        $_SESSION['ErrorMessage'] = 'Username is required';
    }//for fname and lname empty check
    elseif($_POST['email']==null || $_POST['password']==null){
        $_SESSION['ErrorMessage'] = 'Email and password are required';
    }//for email and password empty check
    elseif(strlen($_POST['password'])<8 || $_POST['password2']!=$_POST['password']){
        $_SESSION['ErrorMessage'] = 'Password must be up to 8 characters and must match';
    }//for checking correctness of password
    else {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $dbconnect;
        //establish connection to db
        $sql = "INSERT INTO registration (username,email,password)";
        $sql .= "VALUES(:usernamE,:emaiL,:pasS)";
        $stmt = $dbconnect->prepare($sql);
        //creates the prepare object - for insertion
        $stmt->bindValue(':usernamE',$username);
        $stmt->bindValue(':emaiL',$email);
        $stmt->bindValue(':pasS',$password);
        
        $Execute = $stmt->execute();
        if($Execute){
            $_SESSION['SuccessMessage'] = 'Registration successful';

        header('location: welcome.php');    
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="CSS/login.css" />
    <title>Not a User?</title>
  </head>
  <body>
    <?php
      echo session_error();
      echo session_success();
    ?>
    <div class="container">
      
      <form id="form" class="form" action="register.php" method="POST">
        
        <h2>Register</h2>
        <div class="form-control">
          <label for="username">Username</label>
          <input type="text" name="username"id="username" placeholder="Username">
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="email">Email</label>
          <input name="email" type="email" id="email" placeholder="Email">
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <input type="password" id="Password" name= "password" placeholder="Password">
          <small>Error message</small>
        </div>
        <div class="form-control">
          <label for="password2">Confirm Password</label>
          <input
            type="password" name="password2"
            id="Password2" placeholder="Confirm Password">
          <small>Error message</small>
        </div>

            <p>Already a user? <a href=index.php>Login</a></p>
        <button name="submit" type="submit">Submit</button>
      </form>
    </div>
    <!--<script src="JS/Register.js"></script>-->
  </body>
</html>