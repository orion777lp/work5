<?php

if(!isset($_SESSION)){

    session_start();

}

$_SESSION["work"] = "login";//set view page on registration form

//return result for ajax
echo json_encode(array("result"=>true));