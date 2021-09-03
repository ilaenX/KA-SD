<?php
$DS="mysql:host=localhost;dbname=methods";
$user='root';
$password='';
$dbconnect= new PDO($DS,$user,$password);

// Check connection
if($dbconnect === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>