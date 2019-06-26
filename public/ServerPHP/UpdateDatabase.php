<?php
include "env.php";

$connect = mysqli_connect($server, $user, $password);
mysqli_query($connect, "DROP DATABASE $database");
mysqli_query($connect, "CREATE DATABASE $database");
$connect = mysqli_connect($server, $user, $password, $database);

include_once ('tables/AllTable.php');
