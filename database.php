<?php 
$database = "my";
$user = "root";
$password = "";
$server = "localhost";

$connect = mysqli_connect($server, $user, $password, $database); 
$query = "SELECT * FROM music ORDER BY id DESC";
$mysic = mysqli_query($connect,$query);
$num = mysqli_fetch_all($mysic, MYSQLI_ASSOC);