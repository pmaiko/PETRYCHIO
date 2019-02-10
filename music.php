<?php
include_once ('database.php');
if ($_COOKIE['login'] && $_COOKIE['pass']){?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/player.css">
    <link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Petryxa Music</title>
</head>
<body>
<div class="over">
</div>
<div class="overlay">
    <div class="load">
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
        <span class="sr-only">Загрузка...</span>
    </div>
</div>
<div class="player">
    <div class="panel">
        <div class="evs">
            <div class="ev1"></div>
            <div class="ev2"></div>
            <div class="ev3"></div>
            <div class="ev4"></div>
            <div class="ev5"></div>
            <div class="ev6"></div>
            <div class="ev7"></div>
            <div class="ev8"></div>
            <div class="ev9"></div>
            <div class="ev10"></div>
            <div class="ev11"></div>
            <div class="ev12"></div>
            <div class="ev13"></div>
            <div class="ev14"></div>
            <div class="ev15"></div>
            <div class="ev16"></div>
            <div class="ev17"></div>
            <div class="ev18"></div>
            <div class="ev19"></div>
            <div class="ev20"></div>
            <div class="ev21"></div>
            <div class="ev22"></div>
            <div class="ev23"></div>
            <div class="ev24"></div>
            <div class="ev25"></div>
            <div class="ev26"></div>
            <div class="ev27"></div>
            <div class="ev28"></div>
            <div class="ev29"></div>
            <div class="ev30"></div>
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
            <div class="load"></div>
        </div>

    </div>



</div>
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
        <?php foreach ($num as $num): ?>
            <div class="content" id="<?=$num['id'] ?>">
                <div class="post"  id="<?=$num['id'] ?>" data-video-src="<?=$num['Song'] ?>">
                    <div class="list-play"><i class="fa fa-play" aria-hidden="true"></i></div>
                    <?php
                    //$masiv = array ('/music/','.mp3');
                    //$f = str_replace($masiv, '', $num['Song']);
                    //echo $f;
                    echo $num['Name'];
                    ?>
                </div>
                <div class="controls-song">
                    <div id="<?=$num['id'] ?>" data-video-src="<?=$num['Song'] ?>" class="delete"><i class="fa fa-times" aria-hidden="true"></i></div>
                    <a href="<?=$num['Song'] ?>" download><div class="download"><i class="fa fa-cloud-download" aria-hidden="true"></i></div></a>
                </div>
            </div>
        <?php endforeach; ?>
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
                <form action="uploadFile.php" method="post" enctype="multipart/form-data">
                    <input name="filename" type="file">
                    <input type="submit">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="form-add">

    <form action="add.php">
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
</body>
</html>
<?php
}
else{
    header('location:/login.php');
}
?>

