<?php
require_once('includes/connection.php');
include 'includes/sessions.php';
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: index.php");
exit;
?>