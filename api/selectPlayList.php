<?php
include_once('database.php');
$_POST = json_decode(file_get_contents('php://input'), true);
$limit = $_POST['limit'];
$user_id = $_POST['user_id'];
$val = mysqli_query($connect,"SELECT COUNT(*) as maxCount FROM tracks");
$music = mysqli_query($connect,"SELECT * FROM tracks WHERE id_user = $user_id ORDER BY id DESC LIMIT $limit");

class Music {
    public $playList;
    public $maxCount;
}




if ($music && $val) {
    $musicObj = new Music();
    $a = new stdClass();
    $a->playList = mysqli_fetch_all($music, MYSQLI_ASSOC);
    $a->maxCount = mysqli_fetch_assoc($val);
//    $musicObj->playList = mysqli_fetch_all($music, MYSQLI_ASSOC);
//    $musicObj->maxCount = mysqli_fetch_assoc($val);
}
echo json_encode($a);
//var_dump($time_end);
