<?php
include_once("app/database.php");
if($_POST['submit']) {
    $r_name = $_POST["Name"];
    $r_last_name = $_POST["LastName"];
    $r_mail = $_POST["Email"];
    $r_login = $_POST["Login"];
    $r_password = $_POST["Password"];
    $allUsers = mysqli_query($connect, "SELECT * FROM users");
    $loginUser = mysqli_fetch_all($allUsers, MYSQLI_ASSOC);

    $is_userCreated = 0;
    foreach ($loginUser as $loginUser) {
        if ($loginUser['Login'] == $r_login) {
            $is_userCreated++;
        }
    }

    if ($is_userCreated == 0) {
        if ($_FILES['filename']['size'] > 0) {
            define ('SITE_ROOT', realpath(dirname(__FILE__)));
            $uploads_dir = '/users-photo';
            $file_name = $_FILES['filename']['name'];
            $file_tmp = $_FILES['filename']['tmp_name'];
            move_uploaded_file($file_tmp,SITE_ROOT.'/users-photo/'.$r_login.'.jpg');

            create_user($connect, $r_name, $r_last_name, $r_mail,$r_login, $r_password, '/users-photo/'.$r_login.'jpg');

        }

        else {
            if($r_login && $r_password) {
                create_user($connect, $r_name, $r_last_name, $r_mail,$r_login, $r_password, '');
            }

            else {
                echo 'Вы не заполнили Логин или Пароль. </br>';
            }
        }
    }

    else {
        echo 'Такой пользователь уже существует. </br>';
    }
}
?>

<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" >
    <link rel="stylesheet" href="css/slick.css" >
    <link rel="stylesheet" href="css/animate.css" >
    <link rel="stylesheet" href="css/style.css" >
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
    <title>Document</title>
    <script type="text/javascript">
        function valid(form) {
            var pattern  = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            var name = form.Name.value;
            var last_name = form.LastName.value;
            var email = form.Email.value;
            var login = form.Login.value;
            var password = form.Password.value;
            var secondPassword = form.SecondPassword.value;
            var style_input_text_ok = 'border-bottom: 1px solid #24c482;';
            var style_input_text_error = 'border-bottom: 1px solid #ff3048;';
            if (name === '' || name === ' ') {
                form.Name.style = style_input_text_error;
                event.preventDefault();
            }
            else {
                form.Name.style = style_input_text_ok;
            }
            if (last_name === '' || last_name === ' ') {
                form.LastName.style = style_input_text_error;
                event.preventDefault();
            }
            else {
                form.LastName.style = style_input_text_ok;
            }
            if (pattern.test(email) === false) {
                form.Email.style = style_input_text_error;
                event.preventDefault();
            }
            else {
                form.Email.style = style_input_text_ok;
            }
            if (login === '' || login === ' ') {
                form.Login.style = style_input_text_error;
                event.preventDefault();
            }
            else {
                form.Login.style = style_input_text_ok;
            }

            if (password === '' || password === ' ') {
                form.Password.style = style_input_text_error;
                event.preventDefault();
            }
            else {
                form.Password.style = style_input_text_ok;
            }
            if (secondPassword !== password || secondPassword === '' || secondPassword === ' ') {
                form.SecondPassword.style = style_input_text_error;
                event.preventDefault();
            }
            else {
                form.SecondPassword.style = style_input_text_ok;
            }
        }

    </script>
</head>
<body>
<div class="registration__page">
    <div class="form__registration">
        <div class="form__head">
            <div class="form__title">Форма регистрации</div>
        </div>
        <div class="form__body">
            <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-column" onsubmit="valid(this)">
                <div class="form-group form-group--custom">
                    <label for="Name">Имя<span>*</span></label>
                    <div class="form__wrapper">
                        <i class="fa fa-user-o flex-shrink-0" aria-hidden="true"></i>
                        <input class="input__text" type="text" name="Name" id="Name">
                    </div>
                </div>

                <div class="form-group form-group--custom">
                    <label for="LastName">Фамилия<span>*</span></label>
                    <div class="form__wrapper">
                        <i class="fa fa-gg flex-shrink-0" aria-hidden="true"></i>
                        <input class="input__text" type="text" name="LastName" id="LastName">
                    </div>
                </div>

                <div class="form-group form-group--custom">
                    <label for="Email">Электронная почта<span>*</span></label>
                    <div class="form__wrapper">
                        <i class="fa fa-envelope-open-o flex-shrink-0" aria-hidden="true"></i>
                        <input class="input__text" type="text" name="Email" id="Email">
                    </div>
                </div>
                <div class="form-group form-group--custom">
                    <label for="filename">Фотография</label>
                    <input class="input__text input__text--custom" type="file" name="filename" id="filename">
                </div>
                <div class="form-group form-group--custom">
                    <label for="Login">Логин<span>*</span></label>
                    <div class="form__wrapper">
                        <i class="fa fa-address-card-o flex-shrink-0" aria-hidden="true"></i>
                        <input class="input__text" type="text" name="Login" id="Login">
                    </div>
                </div>

                <div class="form-group form-group--custom">
                    <label for="Password">Пароль<span>*</span></label>
                    <div class="form__wrapper">
                        <i class="fa fa-key flex-shrink-0" aria-hidden="true"></i>
                        <input class="input__text" type="password" name="Password" id="Password">
                    </div>
                </div>

                <div class="form-group form-group--custom">
                    <label for="SecondPassword">Введите пароль еще раз<span>*</span></label>
                    <div class="form__wrapper">
                        <i class="fa fa-keyboard-o flex-shrink-0" aria-hidden="true"></i>
                        <input class="input__text" type="password" name="SecondPassword" id="SecondPassword">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form__error">

                    </div>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <input type="submit" class="btn__red" name="submit" value="Зарегистрироваться">
                    <button class="btn__darkBlue">Отмена</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
