<?php
//if the user's browser send a cookie for the session
if( isset( $_COOKIE[ session_name()])) {
    //empty the cookie
    setcookie( session_name(), '', time()-86400, '/');
}

//start the session
@session_start();
//clear all session variables
session_unset();

//destroy the session
session_destroy();


header("Location: ../");
