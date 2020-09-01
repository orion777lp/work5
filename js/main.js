
//click edit button on personal area form
function edit() {

    //hide
    $("#work_form__btn_edit").hide();
    $("#work_form__div_name").hide();

    //show
    $("#work_form__btn_save").show();
    $("#work_form__btn_cancel").show();
    $("#work_form__div_edit").show();

}

//click cancel button on edit user
function cancel() {

    //hide
    $("#work_form__btn_edit").show();
    $("#work_form__div_name").show();

    //show
    $("#work_form__btn_save").hide();
    $("#work_form__btn_cancel").hide();
    $("#work_form__div_edit").hide();

}

//click save button on edit user
function save() {

    var password        = $("#work_form__password").val();
    var password_again  = $("#work_form__password_again").val();
    var name            = $("#work_form__name").val();

    if(password.length > 0 && password == password_again){

        if(name.length > 0 ){

            $.ajax({
                type: "POST",
                url: "./php/mod_edt_user.php",
                data: {
                    name:           name,
                    password:       password
                },
                dataType:'JSON',
                success: function(response){

                    if(response.result){
                        location.reload();
                    }else{
                        alert("Error edit user");
                    }

                }
            });

        }else{

            alert("Field name is required");

        }

    }else{

        alert("Password mismatch/password must be value");

    }


}

//link on login form
function set_registration_view(){

    $.ajax({
        type: "POST",
        url: "./php/mod_get_registration_form.php",
        dataType:'JSON',
        success: function(response){

            if(response.result){
                location.reload();
            }

        }
    });

}

//link on registration form
function set_login_view(){

    $.ajax({
        type: "POST",
        url: "./php/mod_get_login_form.php",
        dataType:'JSON',
        success: function(response){

            if(response.result){
                location.reload();
            }

        }
    });

}


$(document).ready(function(){

    //Click Button Exit
    $("#work_form__btn_exit").click(function () {

        $.ajax({
            type: "POST",
            url: "./php/mod_exit.php",
            data: {
            },
            dataType:'JSON',
            success: function(response){

                if(response.result){
                    location.reload();
                }else{
                    alert("wrong exit");
                }

            }
        });

    });

    //CLick button Registration
   $("#registration_form__btn_registration").click(function () {

        var login       = $("#registration_form__login").val();
        var pass        = $("#registration_form__password").val();
        var pass_again  = $("#registration_form__password_again").val();
        var name        = $("#registration_form__name").val();
        var email       = $("#registration_form__email").val();

        if(login.length > 0 && pass.length > 0 && name.length > 0 && email.length > 0){

            if(pass === pass_again){

                $.ajax({
                    type: "POST",
                    url: "./php/mod_add_user.php",
                    data: {
                        login:      login,
                        password:   pass,
                        email:      email,
                        name:       name,
                    },
                    dataType:'JSON',
                    success: function(response){

                        if(response.result == 0){
                            //user add OK
                            alert(response.msg);
                            location.reload();
                        }else if(response.result == -1){
                            //login busy
                            alert(response.msg);
                        }else if(response.result == -2){
                            //DB ERROR
                            alert(response.msg);
                        }else if(response.result == -3){
                            //validate error
                            alert(response.msg);
                        }else{
                            alert("ERROR");
                        }

                    }
                });

            }else{
                alert('Password mismatch');
            }

        }else{

            alert("Check fields, all fields is required");

        }

   });

   //Click button login
    $("#login_form__btn_login").click(function() {

        var login = $("#login_form__login").val();
        var pass  = $("#login_form__password").val();

        if(login.length > 0 && pass.length > 0){

            $.ajax({
                type: "POST",
                url: "./php/mod_login.php",
                data: {
                    login: login,
                    password: pass,
                },
                dataType:'JSON',
                success: function(response){

                    if(response.result){
                        location.reload();
                    }else{

                        alert("wrong pair login/pass");

                        /*$("#login_form__login").val("");
                        $("#login_form__password").val("");*/
                    }

                }
            });

        }else{

           alert("Login/Password must be value");

        }


    });

});