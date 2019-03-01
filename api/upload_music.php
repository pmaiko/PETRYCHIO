<?php
include_once("app/database.php");
$id_user = $_COOKIE['id_user'];
define ('SITE_ROOT', realpath(dirname(__FILE__)));
$uploads_dir = '/music';

if(isset($_FILES['filename'])){
	$errors = array();
	$file_name = $_FILES['filename']['name'];
	$file_tmp = $_FILES['filename']['tmp_name'];
    move_uploaded_file($file_tmp,SITE_ROOT.'/music/'.$file_name);
}

$insert_query= "INSERT INTO tracks (Song, Name, id_user) VALUES ('$uploads_dir/$file_name','$file_name','$id_user')";
$result = mysqli_query($connect,$insert_query);
$zapor = "UPDATE tracks SET id=(SELECT @a:=@a + 1 FROM (SELECT @a:= 0) as tracks)";
$resultzapor = mysqli_query($connect,$zapor);

$num = select_playlist($connect);
if ($result){
    include_once("template.php");
}
?>
