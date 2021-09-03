<?php
session_start();//start session

//function for displaying error message
function session_error(){
    if (isset($_SESSION['ErrorMessage'])) {
        $message = "<div class=\"alert alert-danger\" role=\"alert\">";
        $message .= htmlentities($_SESSION['ErrorMessage']);//htmlentities: ensures php codes are not broken in html
        $message .= "</div>";
        $_SESSION['ErrorMessage'] = null;//destroy session
        return $message;//display session message
        }
}

//function for displaying success message
function session_success(){
    if (isset($_SESSION['SuccessMessage'])) {
        $message = "<div class=\"alert alert-success\" role=\"alert\">";
        $message .= htmlentities($_SESSION['SuccessMessage']);//htmlentities: ensures php codes are not broken in html
        $message .= "</div>";
        $_SESSION['SuccessMessage'] = null;//destroy session
        return $message;//display session message
        }
}
?>

