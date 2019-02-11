<?php
include_once("app/database.php");
$playlist = $_COOKIE['login'];
define ('SITE_ROOT', realpath(dirname(__FILE__)));
$uploads_dir = '/music';

if(isset($_FILES['filename'])){
	$errors = array();
	$file_name = $_FILES['filename']['name'];
	$file_tmp = $_FILES['filename']['tmp_name'];
    move_uploaded_file($file_tmp,SITE_ROOT.'/music/'.$file_name);
}

$insert_query= "INSERT INTO playlist_$playlist (Song, Name) VALUES ('$uploads_dir/$file_name','$file_name')";
$result = mysqli_query($connect,$insert_query);
$zapor = "UPDATE playlist_$playlist SET id=(SELECT @a:=@a + 1 FROM (SELECT @a:= 0) as music)";
$resultzapor = mysqli_query($connect,$zapor);

$num = select_playlist($connect);
if ($result){
	foreach ($num as $num): ?>
            <div class="content" id="<?=$num['id'] ?>">
                <div class="post"  id="<?=$num['id'] ?>" data-video-src="<?=$num['Song'] ?>">
                    <div class="list-play"><i class="fa fa-play" aria-hidden="true"></i></div>
                    <?php
                    echo $num['Name'];
                    ?>
                </div>
                <div class="controls-song">
                    <div id="<?=$num['id'] ?>" data-video-src="<?=$num['Song'] ?>" class="delete"><i class="fa fa-times" aria-hidden="true"></i></div>
                    <a href="<?=$num['Song'] ?>" download><div class="download"><i class="fa fa-cloud-download" aria-hidden="true"></i></div></a>
                </div>
            </div>
	<?php endforeach;
}
?>
