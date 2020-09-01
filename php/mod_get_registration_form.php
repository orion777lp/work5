<?php

if(!isset($_SESSION)){

    session_start();

}

//set view page on registration form
$_SESSION["work"] = "registration";

//return result for ajax
echo json_encode(array("result"=>true));