<?php

include_once('db.php');

if(!isset($_SESSION)){

    session_start();

}

//login fault
function login_fault(){

    $_SESSION['work'] = 'login';
    $_SESSION['user_id'] = -1;

    //return result for ajax
    echo json_encode(array("result"=>false));

}

if(isset($_POST["login"]) && isset($_POST["password"])){

    $db = new db();

    $res = $db->login(
        [
            'login'         =>  $_POST["login"],
            'password'      =>  $_POST["password"]
        ]
    );

    if($res['ok']){

        while($row = $res['result']->fetch_assoc()){

            if($row["NUM"] == 1){

                $_SESSION['work'] = 'work';
                $_SESSION['user_id'] = $row['id'];

                //return result for ajax
                echo json_encode(array("result"=>true));

            }else{

                login_fault();

            }

        }

    }else{

        login_fault();

    }

}else{

    login_fault();

}