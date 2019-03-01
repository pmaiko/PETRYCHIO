<?php
include_once("../back/database.php");
    $login = mysqli_real_escape_string($connect,$_POST['login']);
    $pass = mysqli_real_escape_string($connect,$_POST['pass']);
    $inusers = "SELECT * from users";
    $outinbase = mysqli_query($connect, $inusers);
    $users = mysqli_fetch_all($outinbase, MYSQLI_ASSOC);
    foreach ($users as $users){
        if ($login == $users['Login'] && $pass == $users['Password']) {
            header('location:/music.php');
            setcookie('login',$login, time() + (1 * 365 * 24 * 60 * 60));
            setcookie('pass',$pass ,time() + (1 * 365 * 24 * 60 * 60));
            setcookie('id_user',$users['id'],time() + (1 * 365 * 24 * 60 * 60));
//            session_start();
//            $_SESSION['login'] = $login;
//            $_SESSION['pass'] = $pass;
//            $_SESSION['id_user'] = $users['id'];
        }
    }

if (!$_COOKIE['login'] && !$_COOKIE['pass']){
}
else{
    header('location:/music.php');
}

?>

