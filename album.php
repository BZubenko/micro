<?php
require 'head.php';

$album_id = $_GET['id'];

$album_type = $_GET['type'];

switch ($album_type) {
	case '1':
		$section = 'photo';
		break;
	
	case '2':
		$section = 'video';
		break;
}

$objects = mysql_query("select * from `media_objects` where `album_id` = '".$album_id."' and `object_type` = '".$album_type."' order by `object_id` desc");

$table_counter = 0;

$page_counter = 1;

if (isset($_SESSION['is_auth']) && $_SESSION['user_role'] == 'admin')
{
	echo "<a href = 'edit_album.php?id=".$album_id."&type=".$album_type."'><button class = 'btn btn-default'>управление альбомом</button></a>";
}


echo "<a href = 'gallery.php?section=".$section."'><button class = 'btn btn-default'>Назад</button></a><br />";

echo "<table width = '100%' border = '0'><tr>";

while ($object = mysql_fetch_array($objects)) 
{
	if ($table_counter == 4)
	{
		echo "</tr><tr><td><figure><a href = 'object.php?album=".$album_id."&type=".$album_type."&page=".$page_counter."'>
		<img src='gallery/".$object['object_cover']."'>
		<figcaption>".$object['object_name']."</figcaption>
		</a></figure></td>";


		$table_counter++;
		$page_counter++;
	}

	echo "<td><figure><a href = 'object.php?album=".$album_id."&type=".$album_type."&page=".$page_counter."'>
		<img src='gallery/".$object['object_cover']."'>
		<figcaption>".$object['object_name']."</figcaption>
		</a></figure></td>";

		$table_counter++;
		$page_counter++;
}

?>