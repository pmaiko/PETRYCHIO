<?php
include_once("database.php");
$_POST = json_decode(file_get_contents('php://input'), true);
    $login = mysqli_real_escape_string($connect,$_POST['login']);
    $pass = mysqli_real_escape_string($connect,$_POST['pass']);
    if ($login) {
        $querySelectUsers = mysqli_query($connect, "SELECT * from users");
        $allUsers = mysqli_fetch_all($querySelectUsers, MYSQLI_ASSOC);
    }

    foreach ($allUsers as $user){
        if ($login == $user['Login'] && $pass == $user['Password']) {
            $object = array ("userLoginEd",$login,$pass,$user['id']);
            echo json_encode($object);
        }
    }
