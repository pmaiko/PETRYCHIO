<?php
include_once ("database.php");
$link = $_GET['link'];
$name = $_GET['name'];
$zapros = "INSERT INTO music (Song,Name) VALUES ('$link','$name')";
mysqli_query($connect,$zapros);
$update = "UPDATE music SET id=(SELECT @a:=@a + 1 FROM (SELECT @a:= 0) as music)";
mysqli_query($connect,$update);
header('location:/music.php');
