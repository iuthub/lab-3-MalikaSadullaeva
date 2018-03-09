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
						$arr3=explode("\n", file_get_contents("songs/".$_REQUEST["playlist"]));
						//echo "<a href=\"music.php?playlist=\">" ."". "</a>";
						foreach ($arr3 as $key=>$value) {
						echo "<li class=\"playlistitem\"><a href=\"songs/$value\">" . basename($value) . "</a></li>";
						}

						//echo ">>>>>> <li class=\"playlistitem\"><a href=\"music.php?playlist=".basename($arr3)."\">" . basename($arr3) . "</a></li>";						
					}else{
						$dir="songs";
						$arr=glob($dir."/*mp3");
						foreach ($arr as $dir1) {
							echo "<li class=\"mp3item\"><a href=\"$dir1\">" . basename($dir1) . "</a></li>";
						}
						$arr1=glob($dir."/*txt");
						foreach ($arr1 as $dir2) {
							echo "<li class=\"playlistitem\"><a href=\"music.php?playlist=".basename($dir2)."\">" . basename($dir2) . "</a></li>";
						}
					}
				?>	
			</ul>
		</div>
	</body>
</html>
