<?php
include_once("app/database.php");
if($_POST['submit']) {
    $r_name = $_POST["Name"];
    $r_last_name = $_POST["LastName"];
    $r_mail = $_POST["Mail"];
    $r_login = $_POST["Login"];
    $r_password = $_POST["Password"];
    $allUsers = mysqli_query($connect, "SELECT * FROM users");
    $loginUser = mysqli_fetch_all($allUsers, MYSQLI_ASSOC);
    foreach ($loginUser as $loginUser) {
        if ($loginUser['Login'] == $r_login) {
            echo 'Такой пользователь уже существует. </br>';
        }
    }
    if(isset($_FILES['filename'])){
        define ('SITE_ROOT', realpath(dirname(__FILE__)));
        $uploads_dir = '/users-photo';
        $errors = array();
        $file_name = $_FILES['filename']['name'];
        $file_tmp = $_FILES['filename']['tmp_name'];
        move_uploaded_file($file_tmp,SITE_ROOT.'/users-photo/'.$r_login.'');
        mysqli_query($connect, "INSERT INTO users (Name, Last_Name, Mail, Login, Password, Photo) VALUES ('$r_name','$r_last_name','$r_mail','$r_login','$r_password')");

    }
    else {
        if($r_login && $r_password) {
            $createUser = mysqli_query($connect, "INSERT INTO users (Name, Last_Name, Mail, Login, Password) VALUES ('$r_name','$r_last_name','$r_mail','$r_login','$r_password')");
            if ($createUser) {
                mysqli_query($connect, "CREATE TABLE playlist_$r_login (id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,Song TEXT,Name TEXT)");
                echo 'Пользователь создан. </br>';
            }
        }
        else {
            echo 'Вы не заполнили Логин или Пароль. </br>';
        }
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
    <title>Document</title>
    <script type="text/javascript">
        function valid(form) {
            var pattern  = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            var name = form.Name.value;
            var last_name = form.LastName.value;
            var email = form.Mail.value;
            var login = form.Login.value;
            var password = form.Password.value;
            var secondPassword = form.SecondPassword.value;
            if (name === '' || name === ' ') {
                form.Name.style = "border: 2px solid red";
                event.preventDefault();
            }
            else {
                form.Name.style = "border: none";
            }
            if (last_name === '' || last_name === ' ') {
                form.LastName.style = "border: 2px solid red";
                event.preventDefault();
            }
            else {
                form.LastName.style = "border: none";
            }
            if (pattern.test(email) === false) {
                form.Mail.style = "border: 2px solid red";
                event.preventDefault();
            }
            else {
                form.Mail.style = "border: none";
            }
            if (login === '' || login === ' ') {
                form.Login.style = "border: 2px solid red";
                event.preventDefault();
            }
            else {
                form.Login.style = "border: none";
            }

            if (password === '' || password === ' ') {
                form.Password.style = "border: 2px solid red";
                event.preventDefault();
            }
            else {
                form.Password.style = "border: none";
            }
            if (secondPassword !== password || secondPassword === '' || secondPassword === ' ') {
                form.SecondPassword.style = "border: 2px solid red";
                event.preventDefault();
            }
            else {
                form.SecondPassword.style = "border: none";
            }
        }

    </script>
</head>
<body>
<form action="" method="post" class="d-flex flex-column" onsubmit="valid(this)">
    <div class="form-group">
        <label>Введите Имя:</label>
        <input type="text" name="Name">
    </div>

    <div class="form-group">
        <label>Введите Фамилию:</label>
        <input type="text" name="LastName">
    </div>

    <div class="form-group">
        <label>Введите Email:</label>
        <input type="text" name="Mail">
    </div>

    <div class="form-group">
        <label>Придумайте Login:</label>
        <input type="text" name="Login">
    </div>
    <div class="form-group">
        <label>Придумайте Пароль:</label>
        <input type="password" name="Password">
    </div>

    <div class="form-group">
        <label>Повторите пароль:</label>
        <input type="password" name="SecondPassword">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="submit" value="Зарегистрироваться">
    </div>
</form>
</body>
</html>
