<?php
include_once('app/database.php');
$num = select_playlist($connect);
$infoUser = select_users_info($connect);
if ($_COOKIE['login'] && $_COOKIE['pass']){?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/player.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <meta charset="UTF-8">
    <title><?=$infoUser[0]['Name'] ?> Music</title>
    <script type="text/javascript">
        function autoLogin() {
            event.preventDefault()
            var axsios = new XMLHttpRequest();
            axsios.open('POST', 'logout.php?r=' + Math.random(), true);
            axsios.send();

            if (axsios.status = 200) {
                window.location = "login.php";
            }
            else {
                alert('ebat ti lox');
            }
        }
    </script>
</head>
<body class="page-music">
<div class="over">
</div>
<div class="overlay">
    <div class="load">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <span class="sr-only">Загрузка...</span>
    </div>
</div>
<div class="right-panel">
    <input type="color">
</div>
<audio src="music/01_Intro.mp3"></audio>
<div class="player">
    <button class="btn btn-outline-danger" onclick="autoLogin()">Выход</button>
    <div><?=$infoUser[0]['Mail'] ?></div>
    <img src="<?=$infoUser[0]['Photo'] ?>" alt="" width="30px" height="30px">
    <div class="panel">
        <div class="visualizer">
        </div>
    </div>
    <div class="nameSong">Name Song</div>
    <div class="control">
        <div class="block-lef">
            <div class="repeat"><i class="fa fa-repeat" aria-hidden="true"></i></div>
            <div class="time">0:00</div>
        </div>
        <div class="block-cen">
            <div class="prev"><i class="fa fa-backward" aria-hidden="true"></i></div>
            <div class="play-pause"><i class="fa fa-play marplay" aria-hidden="true"></i></div>
            <div class="pause d-none"><i class="fa fa-pause marpause" aria-hidden="true"></i></div>
            <div class="next"><i class="fa fa-forward" aria-hidden="true"></i></div>
        </div>
        <div class="block-rig">
            <div class="mute"><i class="fa fa-volume-up" aria-hidden="true"></i></div>
            <input type="range" class="volume" min="0" max="100" value="100">
        </div>
    </div>
    <div class="timetobar">

        <div class="setTime">0:00</div>
        <div class="range">
            <div class="progress"></div>
            <div class="loadSongPr"></div>
        </div>

    </div>



</div>
<canvas id="canvas"></canvas>
<div class="list-wrap">
    <div class="list">
        <!--
        <form class="form" action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="filename">
            <!--<input type="submit" class="submit"  value="dow">
            <span id='button'>Select File <i class="fa fa-eject" aria-hidden="true"></i></span>
            <span id='val'></span>
            <button id='download'>Download <i class="fa fa-cloud-upload" aria-hidden="true"></i></button>
        </form>
        -->
        <button id="add">Add music to playlist</button>
        <button data-toggle="modal" data-target="#downloadFile">download file</button>
        <?php include_once("template.php") ?>
    </div>
</div>

<!--form-->

<div class="modal fade" id="downloadFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="file" id="sortpicture" name="filename">
                <input type="submit" id="upload">
<!--                <form action="uploa_music.php" method="post" enctype="multipart/form-data">-->
<!--                    -->
<!--                </form>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="form-add">

    <form action="app/add.php">
        <label for="link">Enter a link to the song</label>
        <input type="text" name="link">
        <label for="name">Enter the name of the song</label>
        <input type="text" name="name">
        <button class="addMusic">Add music</button>
    </form>
    <button class="close">Close form</button>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/player.js"></script>

<script type="text/javascript">
    $('#upload').on('click', function() {
        var file_data = $('#sortpicture').prop('files')[0];
        var form_data = new FormData();
        form_data.append('filename', file_data);
        alert(form_data);
        $.ajax({
            url: 'upload_music.php',
            dataType: 'html',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: appdate
        });
    });
</script>
</body>
</html>
<?php
}
else{
    header('location:/login.php');
}
?>

