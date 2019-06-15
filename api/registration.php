<?php
include_once("database.php");
$r_name = $_POST["Name"];
$r_last_name = $_POST["LastName"];
$r_mail = $_POST["Email"];
$r_login = $_POST["Login"];
$r_password = $_POST["Password"];
$allUsers = mysqli_query($connect, "SELECT * FROM users");
$loginUser = mysqli_fetch_all($allUsers, MYSQLI_ASSOC);

echo $r_name,$r_last_name;

$is_userCreated = 0;
foreach ($loginUser as $loginUser) {
    if ($loginUser['Login'] == $r_login) {
        $is_userCreated++;
    }
}

if ($is_userCreated == 0) {
    if ($_FILES['filename']['size'] > 0) {
        define ('SITE_ROOT', realpath(dirname(__FILE__,2)));
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
