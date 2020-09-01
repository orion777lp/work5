<?php

include_once('db.php');

class work{

    public function login_form(){

        return '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 login__form">

    <div class="margin__top_mid text-center">

        <img src="img/logo.svg" alt="logo" class="w-25">

    </div>

    <div class="margin__top_big">

        <form action="" method="post">

            <div class="">

                <label for="login_form__login" class="m-0">Login</label>
                <input type="text" id="login_form__login" name="login_form__login" class="d-block w-100" required>

            </div>

            <div class="margin__top_mid">

                <label for="login_form__password" class="m-0">Password</label>
                <input type="password" id="login_form__password" name="login_form__password" class="d-block w-100" required>

            </div>

            <div class="text-right">

                <a href="" onclick="set_registration_view()">registration</a>

            </div>

            <input type="button" id="login_form__btn_login" name="login_form__btn_login" class="btn btn-success margin__top_big" value="Login">

        </form>

    </div>

</div>';

    }

    public function registration(){

        return '<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3 login__form">

    <div class="margin__top_mid text-center">

        <img src="img/logo.svg" alt="logo" class="w-25">

    </div>

    <div class="margin__top_big">

        <form action="" method="post" id="registration_form" name="registration_form">

            <div class="">

                <label for="registration_form__login" class="m-0">Login</label>
                <input type="text" id="registration_form__login" name="registration_form__login" class="d-block w-100" required>

            </div>

            <div class="margin__top_mid">

                <label for="registration_form__email" class="m-0">email</label>
                <input type="text" id="registration_form__email" name="registration_form__email" class="d-block w-100" required>

            </div>

            <div class="margin__top_mid">

                <label for="registration_form__name" class="m-0">Name</label>
                <input type="text" id="registration_form__name" name="registration_form__name" class="d-block w-100" required>

            </div>

            <div class="margin__top_mid">

                <label for="registration_form__password" class="m-0">Password</label>
                <input type="password" id="registration_form__password" name="registration_form__password" class="d-block w-100" required>

            </div>

            <div class="margin__top_mid">

                <label for="registration_form__password_again" class="m-0">Password confirm</label>
                <input type="password" id="registration_form__password_again" name="registration_form__password_again" class="d-block w-100" required>

            </div>

            <div class="text-right">

                <a href="" onclick="set_login_view()">login</a>

            </div>

            <input type="button" id="registration_form__btn_registration" name="registration_form__btn_registration" class="btn btn-success margin__top_big" value="Registration">

        </form>

    </div>

</div>';

    }

    public function work(){

        $db = new db();
        $res = $db->get_user();

        //if all ok drop interface with info
        if($res['ok']){

            $array = [];

            while($row = $res['result']->fetch_assoc()){

                $array = [

                    "name"      => $row['name'],
                    "login"     => $row['login'],
                    "email"     => $row['email'],
                ];

            }

        }else{

            $array = [

                "name"      => "wrong_name",
                "login"     => "wrong_login",
                "email"     => "wrong_email",
            ];

        }

        $str = '<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 login__form">

    <div class="margin__top_mid text-center">

        <img src="img/logo.svg" alt="logo" class="w-25">

    </div>

    <div class="margin__top_big">

        <form action="" method="post">

            <h3 class="m-1">Personal Area</h3>

            <div class="text-right">

                <input type="button" class="btn btn-warning text-white" id="work_form__btn_edit" name="work_form__btn_edit" onclick="edit()" value="edit">
                <input type="button" class="btn btn-success text-white" style="display: none;" id="work_form__btn_save" name="work_form__btn_save" onclick="save()" value="save">
                <input type="button" class="btn btn-danger text-white" style="display: none;" id="work_form__btn_cancel" name="work_form__btn_cancel" onclick="cancel()" value="cancel">

            </div>

        <div class="margin__top_mid">

            <span class="">Login: </span><span>'.$array["login"].'</span>

        </div>

            <div class="margin__top_mid">

                <span class="">email: </span><span>'.$array["email"].'</span>


            </div>

            <div class="margin__top_mid" id="work_form__div_name" name="work_form__div_name">

                <span class="">Name: </span><span>'.$array["name"].'</span>

            </div>

            <div style="display: none" id="work_form__div_edit" name="work_form__div_edit">

                <div class="margin__top_mid">

                    <label for="work_form__name" name="work_form__label_name" id="work_form__label_name" class="m-0">NAME</label>
                    <input type="text" id="work_form__name" name="work_form__name" class="w-100" value="'.$array["name"].'">

                </div>

                <div class="margin__top_mid">

                    <label for="work_form__password" name="work_form__label_password" id="work_form__label_password" class="m-0">New password</label>
                    <input type="password" id="work_form__password" name="work_form__password" class="w-100">

                </div>

                <div class="margin__top_mid">

                    <label for="work_form__password_again" name="work_form__label_password_again" id="work_form__label_password_again" class="m-0">New password confirm</label>
                    <input type="password" id="work_form__password_again" name="work_form__password_again" class="w-100">

                </div>

            </div>




        <input type="button" id="work_form__btn_exit" name="work_form__btn_exit" class="btn btn-success margin__top_big" value="Exit">

        </form>

    </div>

</div>';

        return $str;

    }

}

?>