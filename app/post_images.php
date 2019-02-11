<?php
include_once("app/database.php");
sleep(1);
?>
<?php foreach ($images as $images): ?>
    <div class="col-md-4">
        <div class="elm" id="<?=$images['id'];?>">
            <div class="image">
                <img src="<?=$images['src'];?>" alt="">
            </div>
            <div class="block">
                <div class="arrow"></div>
                <h3><?=$images['caption'];?></h3>
                <p><?=$images['text'];?></p>
            </div>
        </div>
    </div>
<? endforeach; ?>
