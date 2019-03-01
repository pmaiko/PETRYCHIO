<?php
include_once('database.php');
$_POST = json_decode(file_get_contents('php://input'), true);
$user_id = $_POST['user_id'];
$music = mysqli_query($connect,"SELECT * FROM tracks WHERE id_user = $user_id ORDER BY id DESC");
if ($music) {
    $num = mysqli_fetch_all($music, MYSQLI_ASSOC);
}
echo json_encode($num);
