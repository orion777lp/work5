<!DOCTYPE html>
<?php

//include page class
include('php/work.php');

//enable session
if(!isset($_SESSION)){

    session_start();

}

//page class
$work = new work();

?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			Work - Test Page
		</title>
				
		<link rel="stylesheet" href="./css/main.css">
		<link rel="stylesheet" href="./css/bootstrap.min.css">

        <!--
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        -->

        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

		<script language="javascript" src="./js/main.js"></script>

	</head>
	
<body id="body" class="body">

<div class="container">

    <div class="row">

        <?php

        /*
         * WORK section
         * main function at SESSION [work]
         * */

        //check state session
        if(isset($_SESSION['work'])){

            //drop login form
            if($_SESSION['work'] == 'login'){

                echo $work->login_form();

            //drop registration form
            }else if($_SESSION['work'] == 'registration'){

                echo $work->registration();

            //drop work interface
            }else if($_SESSION['work'] == 'work'){

                echo $work->work();

            //drop login form at default
            }else{

                echo $work->login_form();

            }

        //if session is not start drop login form
        }else{

            echo $work->login_form();

        }

        ?>


    </div>

</div>

</body>

</html>