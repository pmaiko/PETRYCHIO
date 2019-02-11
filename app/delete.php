<?php
include_once("app/database.php");
//define ('SITE_ROOT', realpath(dirname(__FILE__)));
$id_delete = mysqli_real_escape_string($connect,$_POST['id']);
$allid = mysqli_real_escape_string($connect,$_POST['allid']);
$src_delete = mysqli_real_escape_string($connect,$_POST['src']);
$allsrc = mysqli_real_escape_string($connect,$_POST['allsrc']);
//unlink(SITE_ROOT.$src_delete);
$querydelete = "DELETE FROM music WHERE id = '$id_delete'";
$resultdelete = mysqli_query($connect,$querydelete);
$id_zapor = $id_delete-1;
//$zapor = "ALTER TABLE music AUTO_INCREMENT = $id_zapor";
$zapor = "UPDATE music SET id=(SELECT @a:=@a + 1 FROM (SELECT @a:= 0) as music)";
$resultzapor = mysqli_query($connect,$zapor);
echo $id_delete;
