<?php

$database = "my";
$user = "root";
$password = "";
$server = "localhost";

//$database = "y0pta";
//$user = "y0pta";
//$password = "qwe123";
//$server = "db2.ho.ua";

$connect = mysqli_connect($server, $user, $password);

if ($connect) {
    //SHOW DATABASES LIKE 'dbname';
//    mysqli_query($connect, "DROP DATABASE $database");
//    mysqli_query($connect, "CREATE DATABASE $database");
    $connect = mysqli_connect($server, $user, $password, $database);
//    include_once ('app/create_tables.php');
//$login = $_POST['login'];
    $limit = $_POST['limit'];
    $cat = mysqli_real_escape_string($connect,$_POST['cat']);
    $limit +=6;
//    if ($cat == 'all_photo'){
//        $query = "SELECT * FROM images LIMIT $limit";
//        $img = mysqli_query($connect,$query);
//        $images = mysqli_fetch_all($img,MYSQLI_ASSOC);
//    }
//    else{
    if ($cat){
        $query = "SELECT * FROM images WHERE categori = '$cat' LIMIT $limit";
        $img = mysqli_query($connect,$query);
        if ($img) {
            $images = mysqli_fetch_all($img,MYSQLI_ASSOC);
        }
    }
    else{
        $query = "SELECT * FROM images LIMIT $limit";
        $img = mysqli_query($connect,$query);
        if ($img) {
            $images = mysqli_fetch_all($img,MYSQLI_ASSOC);
        }
    }
//    }

    function select_users_info($connect){
        $userLogin = $_COOKIE['login'];
        $query = mysqli_query($connect,"SELECT * FROM users WHERE Login = '$userLogin'");
        if ($query) {
            return $infoUsers = mysqli_fetch_all($query, MYSQLI_ASSOC);
        }
    }

    function select_playlist($connect){
        $playlist = $_COOKIE['login'];
        $music = mysqli_query($connect,"SELECT * FROM playlist_$playlist ORDER BY id DESC");
        if ($music) {
            return $num = mysqli_fetch_all($music, MYSQLI_ASSOC);
        }
    }
}
?>
