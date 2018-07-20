<?php
include_once("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/player.css">
	<meta charset="UTF-8">
	<title>Petryxa Mysic</title>
</head>
<body>
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
   <div class="nameSong">Название песни</div>
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

	<form class="form" action="upload.php" method="post" enctype="multipart/form-data">
		<input type="file" name="filename" value="sdasdasd" text="dasdasd">
		<!--<input type="submit" class="submit"  value="dow">-->
        <button><i class="fa fa-eject" aria-hidden="true"></i></button>
	</form>
	<div class="list">	
		<? foreach ($num as $num){?>
            <div class="content" id="<?=$num['id'] ?>">
                
                <div class="post"  id="<?=$num['id'] ?>" data-video-src="<?=$num['Song'] ?>">
                <div class="list-play"><i class="fa fa-play" aria-hidden="true"></i></div>
                <?
                $masiv = array ('/music/','.mp3');
                $f = str_replace($masiv, '', $num['Song']);
                echo $f;
                 ?> 
            </div>
            <div id="<?=$num['id'] ?>" data-video-src="<?=$num['Song'] ?>" class="delete">Delete<i class="fa fa-times" aria-hidden="true"></i></div>
            <a href="<?=$num['Song'] ?>" download><div class="download"><i class="fa fa-cloud-download" aria-hidden="true"></i></div></a>
            </div>
		<?} ?>
	</div>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  <script src="js/player.js"></script>
</body>
</html>