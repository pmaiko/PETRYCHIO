<?php
include_once("database.php");
    $login = mysqli_real_escape_string($connect,$_POST['login']);
    $pass = mysqli_real_escape_string($connect,$_POST['pass']);
    $inusers = "SELECT * from users";
    $outinbase = mysqli_query($connect, $inusers);
    $users = mysqli_fetch_all($outinbase, MYSQLI_ASSOC);
    foreach ($users as $users){
        if ($login == $users['login'] && $pass == $users['password']) {
            header('location:/music.php');
            setcookie('login',$login);
            setcookie('pass',$pass);
        }
    }
?>
<?php
if (!$_COOKIE['login'] && !$_COOKIE['pass']){?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>login</title>
</head>
<body class="body">
<div class="login_wrap">
    <h1 style="text-align: center">#Autorisation</h1>
    <form action="" method="post">
        <label for="">Login</label>
        <input type="text" name="login" placeholder="admin">
        <label for="">Password</label>
        <input type="password" name="pass" placeholder="admin">
        <div class="login_buttons">
            <button type="submit" name="sub">Login</button>
        </div>
    </form>
</div>
<div class="login_logo">
    <h2>IMMORTAL</h2><span>MP3</span><h2>player</h2>
</div>
</body>
</html>
<?php
}
else{
    header('location:/music.php');
}
?>
