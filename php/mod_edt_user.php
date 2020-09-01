<?php

include_once('db.php');

if(!isset($_SESSION)){

    session_start();

}

if(isset($_POST["name"]) && isset($_POST["password"]) && $_SESSION['work'] == 'work'){

    $password = str_replace(' ', '', $_POST["password"]);
    $name =     str_replace(' ', '', $_POST["name"]);

    if(strlen($password) == 0 || strlen($name) == 0){
        echo json_encode(array( "result"=>false, "msg"=>"invalid field" ));
        return false;
    }

   $db = new db();

   $res = $db->edt_user(
        [
            'name'         =>  $_POST["name"],
            'password'     =>  $_POST["password"]
        ]
    );

    echo json_encode(array("result"=>$res));


}else{

    //TODO: drop 404
    //return result for ajax
    echo json_encode(array("result"=>false));

}