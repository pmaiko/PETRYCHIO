<?php
$database = "my";
$user = "root";
$password = "";
$server = "localhost";

//$database = "y0pta";
//$user = "y0pta";
//$password = "qwe123";
//$server = "db2.ho.ua";
$start_time = microtime(true);
//$connect = mysqli_connect($server, $user, $password);
$time_end = microtime(true) - $start_time;
if (1==1) {
    //SHOW DATABASES LIKE 'dbname';
//    mysqli_query($connect, "DROP DATABASE $database");
//    mysqli_query($connect, "CREATE DATABASE $database");
    $connect = mysqli_connect($server, $user, $password, $database);
//    include_once ('create_tables.php');
//$login = $_POST['login'];
    $limit = $_POST['limit'];
    $cat = mysqli_real_escape_string($connect,$_POST['cat']);
    $limit +=6;
//    if ($cat == 'all_photo'){
//        $query = "SELECT * FROM images LIMIT $limit";
//        $images = mysqli_query($connect,$query);
//        $images = mysqli_fetch_all($images,MYSQLI_ASSOC);
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
        $id_user = $_COOKIE['id_user'];
        $music = mysqli_query($connect,"SELECT * FROM tracks WHERE id_user = '$id_user' ORDER BY id DESC");
        if ($music) {
            return $num = mysqli_fetch_all($music, MYSQLI_ASSOC);
        }
    }

    function create_user ($connect, $r_name, $r_last_name, $r_mail,$r_login, $r_password, $nameFile) {
        $createUser = mysqli_query($connect, "INSERT INTO users (Name, Last_Name, Mail, Login, Password, Photo) VALUES ('$r_name','$r_last_name','$r_mail','$r_login','$r_password', '$nameFile')");
        if ($createUser) {
//            mysqli_query($connect, "CREATE TABLE playlist_$r_login (id MEDIUMINT NOT NULL AUTO_INCREMENT PRIMARY KEY,Song TEXT,Name TEXT)");
            echo 'Пользователь создан. </br>';
        }
    }
}
?>
