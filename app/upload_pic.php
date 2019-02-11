<?php
if(isset($_FILES['filename'])){
    define ('SITE_ROOT', realpath(dirname(__FILE__)));
    $uploads_dir = '/users-photo';
    $errors = array();
    $file_name = $_FILES['filename']['name'];
    $file_tmp = $_FILES['filename']['tmp_name'];
    move_uploaded_file($file_tmp,SITE_ROOT.'/users-photo/'.$file_name);
    mysqli_query($connect,"INSERT INTO playlist_$playlist (Song, Name) VALUES ('$uploads_dir/$file_name','$file_name')");
}
?>
