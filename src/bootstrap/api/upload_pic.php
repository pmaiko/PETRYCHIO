<?php
include_once("database.php");
$files = $_FILES['file'] ;

$id_user = $_POST['user_id'];
define ('SITE_ROOT', realpath(dirname(__FILE__,2)));
$uploads_dir = '/covers';

if(isset($files)){
    $errors = array();
    $file_name = $files['name'];
    $file_tmp = $files['tmp_name'];
    move_uploaded_file($file_tmp,SITE_ROOT.'./covers/'.$file_name);
}

$insert_query= "INSERT INTO covers (images, id_user) VALUES ('$uploads_dir/$file_name','$id_user')";
$result = mysqli_query($connect,$insert_query);
$zapor = "UPDATE covers SET id=(SELECT @a:=@a + 1 FROM (SELECT @a:= 0) as covers)";
$resultzapor = mysqli_query($connect,$zapor);

$num = select_playlist($connect);
if ($result){
    echo 'ok';
}
?>
