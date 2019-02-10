<?php
include_once("database.php");
define ('SITE_ROOT', realpath(dirname(__FILE__)));
$uploads_dir = '/music';
if(isset($_FILES['filename'])){
	$errors = array();
	$file_name = $_FILES['filename']['name'];
	$file_tmp = $_FILES['filename']['tmp_name'];
    move_uploaded_file($file_tmp,SITE_ROOT.'/music/'.$file_name);
    echo phpinfo();
}
$insert_query= "INSERT INTO music (Song, Name) VALUES ('$uploads_dir/$file_name','$file_name')";
$result = mysqli_query($connect,$insert_query);
$zapor = "UPDATE music SET id=(SELECT @a:=@a + 1 FROM (SELECT @a:= 0) as music)";
$resultzapor = mysqli_query($connect,$zapor);
if ($result){
    header('location:/music.php');
}

?>
