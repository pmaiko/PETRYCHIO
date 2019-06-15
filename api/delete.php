<?php
include_once("database.php");
$_POST = json_decode(file_get_contents('php://input'), true);
//define ('SITE_ROOT', realpath(dirname(__FILE__)));
$id_delete = mysqli_real_escape_string($connect,$_POST['id_song_delete']);;
//$src_delete = mysqli_real_escape_string($connect,$_POST['src']);
//unlink(SITE_ROOT.$src_delete);
mysqli_query($connect,"DELETE FROM tracks WHERE id = '$id_delete'");
//$id_zapor = $id_delete-1;
//$zapor = "ALTER TABLE music AUTO_INCREMENT = $id_zapor";
mysqli_query($connect,"UPDATE tracks SET id=(SELECT @a:=@a + 1 FROM (SELECT @a:= 0) as tracks)");
//$num = select_playlist($connect);
//include_once("template.php");
