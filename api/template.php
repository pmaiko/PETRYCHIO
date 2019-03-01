<?php $i = 1;
foreach ($num as $num): ?>
    <div class="content" id="<?=$i?>">
        <div class="post"  id="<?=$i ?>" data-video-src="<?=$num['Song'] ?>">
            <div class="list-play"><i class="fa fa-play" aria-hidden="true"></i></div>
            <?php
            //$masiv = array ('/music/','.mp3');
            //$f = str_replace($masiv, '', $num['Song']);
            //echo $f;
            echo $num['Name'];
            ?>
        </div>
        <div class="controls-song">
            <div id_song="<?=$num['id']?>" data-video-src="<?=$num['Song'] ?>" class="delete"><i class="fa fa-times" aria-hidden="true"></i></div>
            <a href="<?=$num['Song'] ?>" download><div class="download"><i class="fa fa-cloud-download" aria-hidden="true"></i></div></a>
        </div>
    </div>
<?php $i++; endforeach; ?>
