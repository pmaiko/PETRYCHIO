<?php
include_once('database.php');
$_POST = json_decode(file_get_contents('php://input'), true);
$user_id = (int)$_POST['user_id'];
$music = mysqli_query($connect,"SELECT * FROM covers WHERE id_user = $user_id ORDER BY id DESC");
if ($music) {
    $num = mysqli_fetch_all($music, MYSQLI_ASSOC);
}
$random = rand(1, count($num));
echo json_encode($num[$random]);
//$num[0]['id']
