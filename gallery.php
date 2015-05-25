<?php
require 'head.php';

switch ($_GET['section']) {
	case 'photo':

		echo "<a href = 'gallery.php?section=null'><button class = 'btn btn-default'>назад</button></a><br />";

		if (isset($_SESSION['is_auth']) && $_SESSION['user_role'] == 'admin')
		{
		echo "<a href = 'add_album.php?section=".$_GET['section']."'><button class ='btn btn-default'>(admin) Добавить альбом</button></a>";	
		}

		$albums = mysql_query("select * from `albums` where `album_type` = '1'");
		
		$counter = 0;

		echo "<table border = '0' width = '100%'><tr>";

		while ($album = mysql_fetch_array($albums)) 
		{
			if($counter == 4)
			{
				$counter = 0;

				echo "</tr><tr><td width = '20%'><a href = 'album.php?id=".$album['album_id']."&type=1'>
						<figure><img src = 'gallery/".$album['album_cover']."'>
							<figcaption>".$album['album_name']."<figcaption></a></td>";
				$counter++;
			}

			echo "<td width = '20%'><a href = 'album.php?id=".$album['album_id']."&type=1'>
						<figure><img src = 'gallery/".$album['album_cover']."'>
							<figcaption>".$album['album_name']."<figcaption></a></td>";
				$counter++;

		}

		break;
	
	case 'video':

		echo "<a href = 'gallery.php?section=null'><button class = 'btn btn-default'>назад</button></a><br />";


		if (isset($_SESSION['is_auth']) && $_SESSION['user_role'] == 'admin')
		{
			echo "<a href = 'add_album.php?section=".$_GET['section']."'><button class ='btn btn-default'>(admin) Добавить альбом</button></a>";	
		}
		
		$albums = mysql_query("select * from `albums` where `album_type` = '2'");
		
		$counter = 0;

		echo "<table border = '0' width = '100%'><tr>";

		while ($album = mysql_fetch_array($albums)) 
		{
			if($counter == 4)
			{
				$counter = 0;

				echo "</tr><tr><td width = '20%'><a href = 'album.php?id=".$album['album_id']."&type=2'>
						<figure><img src = 'gallery/".$album['album_cover']."'>
							<figcaption>".$album['album_name']."<figcaption></a></td>";
				$counter++;
			}

			echo "<td width = '20%'><a href = 'album.php?id=".$album['album_id']."&type=2'>
						<figure><img src = 'gallery/".$album['album_cover']."'>
							<figcaption>".$album['album_name']."<figcaption></a></td>";
				$counter++;

		}
		break;

	default:
		
		echo "<p align ='center'><a href = 'gallery.php?section=photo'><button class = 'btn btn-default btn-lg'>фото-альбомы</button></a></p><br /><br />";
		echo "<p align ='center'><a href = 'gallery.php?section=video'><button class = 'btn btn-default btn-lg'>видео-альбомы</button></a></p><br /><br />";

		break;
}

?>