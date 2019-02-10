<?
include_once("database.php");
?>
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
		<div id="<?=$num['id'] ?>" data-video-src="<?=$num['Song'] ?>" class="delete">delete</div>
	</div>
	<?}?>
