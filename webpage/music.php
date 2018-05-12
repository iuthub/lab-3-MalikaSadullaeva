<?php
	if(isset($_REQUEST['playlist'])){

		/*print_r($_REQUEST['playlist']);*/

		$txt=array();
		$musiclist=array();
		$name_m3u=$_REQUEST['playlist'];

		$list=file("songs/$name_m3u", FILE_IGNORE_NEW_LINES);
		foreach ($list as $l)
		{
			if(!strcmp($l[0], '#')){
				continue;
			}
			$size = filesize('songs/'.$l);
			if($size<1024){
				$size = "(" . $size ." b)";	
			}
			else if($size>=1024 && $size<=104875){
				$size=$size/1024;
				$size=round($size,2);
				$size = "(" . $size .	" kb)";
			}
			else{
				$size=$size/1048576;
				$size=round($size,2);
				$size="(" . $size .	" mb)";
			}
			$musiclist["songs/".$l]=$size;
		}
	}
	else{
		$songs=glob("songs/*.mp3");
		foreach ($songs as $song) {
			$song=basename(trim($song));
			$size = filesize('songs/'.$song);
			if($size<1024){
				$size="(".$size.")b";	
			}
			else if($size>=1024 && $size<=104875){
				$size=filesize($key)/1024;
				$size=round($size,2);
				$size = "(".$size ." kb)";
			}
			else{
				$size=$size/1048576;
				$size=round($size,2);
				$size="(".$size." mb)";
			}
			$musiclist["songs/".$song]=$size;
		}
		$txt=glob("songs/*.m3u");
	}








?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Music Viewer</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="header">

			<h1>190M Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>


		<div id="listarea">		
			<ul id="musiclist">
				
	<?php

			if(isset($_REQUEST["playlist"])){
				print "<a href='music.php'>Back to prev page</a>";
			}
?>

			<?php
			
			if(isset($_REQUEST["playlist"])){
				// $mus=explode("\n",file_get_contents("songs/" .basename($_REQUEST["playlist"])));
					foreach ($musiclist as $song=>$size) {
			?>

					<li class="playlistitem">
							<a href= "<?='songs/'. $song ?>"> <?=basename($song)." ".($size) ?></a>
					</li>


				<?php } ?>



			<?php
				} else {	
				$dir="songs";   				#first task
				$arr=glob($dir . "/*.mp3");     #first task
				$arr2=glob($dir . "/*.txt");    #second task
				foreach ($arr as $key) { 
					$size=filesize($key);
					?>
					<li class="mp3item">
					<a href="<?=$key?>"> <?= basename($key) ?> </a>
					<?php
							if($size<1024){
								$size=filesize($key);	

								print "(" . $size .	" b)";	
							}

							else if($size>=1024 && $size<=104875){
								$size=filesize($key)/1024;
								$size=round($size,2);
								print "(" . $size .	" kb)";
							}
							else{
								$size=filesize($key)/1048576;
								$size=round($size,2);
								print "(" . $size .	" mb)";
							}

					?>

					</li>




			<?php } ?>
				<?php foreach ($arr2 as $key2) {  #second task ?>
						<li class="playlistitem">
						<a href= "music.php?playlist=<?= $key2 ?>"> <?=basename($key2) ?></a>
						</li>

						<?php } } ?>



			</ul>
		</div>
	</body>
</html>
