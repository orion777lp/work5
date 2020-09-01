<?php

include_once('db.php');

if(!isset($_SESSION)){

    session_start();

}

if(isset($_POST["login"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["name"])){

    $login =    str_replace(' ', '', $_POST["login"]);
    $password = str_replace(' ', '', $_POST["password"]);
    $name =     str_replace(' ', '', $_POST["name"]);
    $email =    str_replace(' ', '', $_POST["email"]);

    //check valid email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array( "result"=>-3, "msg"=>"invalid email" ));
        return false;
    }

    if(strlen($login) == 0 || strlen($password) == 0 || strlen($name) == 0){
        echo json_encode(array( "result"=>-3, "msg"=>"invalid field" ));
        return false;
    }

   $db = new db();

    //try add user
   $res = $db->add_user(
        [
            'login'         =>  $login,
            'password'      =>  $password,
            'email'         =>  $email,
            'name'          =>  $_POST["name"],
        ]
    );

   //drop on login form
    $_SESSION['work'] = "login";

    //return result for ajax
    echo json_encode($res);

}else{

    //TODO: drop 404
    //return result for ajax
    echo json_encode(array("result"=>false, "msg"=>"Field is wrong"));

}