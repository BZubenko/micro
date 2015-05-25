<?php
require 'head.php';

if (!isset($_SESSION['is_auth']) && $_SESSION['user_role'] !== 'true')
{
	header("Location:inex.php");
}

$album_id = $_GET['id'];

$album_type = $_GET['type'];

if (isset($_POST['subm_rename']))
{
	mysql_query("update `albums` set `album_name` = '".$_POST['rename']."' where `album_id` = '".$album_id."'")
	or print "НЕ удалось переименовать";
	echo "Успешно переименован";
}

if (isset($_POST['add_file']))
{
	switch ($album_type) {
		case '1':
			if (!getimagesize($_FILES['new_file']['tmp_name']))
			{
				echo "Ошибка! фаш файл не является фото!";
			}
			else
			{
				$obj_name = mysql_query("select * from `media_objects`");
				$obj_name = mysql_num_rows($obj_name);
				$obj_name++;

				mysql_query("insert into `media_objects` (`object_type`, `object_name` , `object_descr` , `album_id` , `object_cover`)
					values ('".$album_type."' , '".$_POST['name']."' , '".$_POST['descr']."' , '".$album_id."' , '".$obj_name."')")
				or die(mysql_error());

				move_uploaded_file($_FILES['new_file']['tmp_name'], 'gallery/'.$obj_name);
				
				echo "Успешно";
			}
			break;
		
		case '2':
			 $mime = $_FILES['new_file']['type'];
			

			if ( $mime !== "video/mpeg" || $mime !== " video/mp4" ||  $mime !== "video/ogg" ||  $mime !== "video/quicktime" || $mime !== " video/webm" ||  $mime !== "video/x-ms-wmv" ||  $mime !== "video/x-flv")
			{
				echo "Загружаемый файл не является видео!";
			}
			else
			{
				$obj_name = mysql_query("select * from `media_objects`");
				$obj_name = mysql_num_rows($obj_name);
				$obj_name++;

				move_uploaded_file($_FILES['new_file']['tmp_name'], 'gallery/'.$obj_name);

				mysql_query("insert into `media_objects` (`object_type`, `object_name` , `object_descr` , `album_id`)
					values ('".$album_type."' , '".$_POST['name']."' , '".$_POST['descr']."' , '".$album_id."')")
				or die(mysql_error());
				echo "Успешно";
			}

			break;
	}
}

if (isset($_GET['delete']))
{
	$find_in_album = mysql_query("select * from `media_objects` where `album_id` = '".$album_id."'");

	while ($object = mysql_fetch_array($find_in_album)) 
	{
		unlink('gallery/'.$object['object_id']);
	}

	mysql_query("delete from `albums` where `album_id` = '".$album_id."'") or print(mysql_error());
	mysql_query("delete from `media_objects` where `album_id` = '".$album_id."'") or print(mysql_error());

	echo "Вот и все...";
}



echo "<fieldset>
		<legend>Действия над альбомом</legend>
		<form action = 'edit_album.php?id=".$album_id."&type=".$album_type."' method = 'post'>
			<label for = 'rename'>Переименовать</label>
			<input type = 'text' name = 'rename' id = 'rename' class = 'form-control'>
			<input type = 'submit' class = 'btn btn-default' name = 'subm_rename' value = 'Подтвердить'>
		</form>
		<a href = 'edit_album.php?id=".$album_id."&type=".$album_type."&delete=true'><button class = 'btn btn-default'>Удалить (необратимо и не поправимо)</button></a>
	</fieldset>";


echo "<fieldset>
	<legend>
		Добавить файл
	</legend>
	<form action = 'edit_album.php?id=".$album_id."&type=".$album_type."' method = 'post' enctype = 'multipart/form-data'>
		<label for = 'name'>Имя</label>
		<input type = 'text' name = 'name' id = 'name' class = 'form-control'>
		<label for = 'descr'>Описание</label>
		<textarea name = 'descr' id = 'descr' class = 'form-control'></textarea>
		<label for = 'new_file'>Выберите файл</label><br />
		<input type = 'file' name = 'new_file' id = 'new_file' class = 'form-control'><br />
		<input type = 'submit' name = 'add_file' class = 'btn btn-default' value = 'Отправить'>
	</form>
	</fieldset>";

$load_objects = mysql_query("select * from `media_objects` where `album_id` = '".$album_id."'");

echo "<table class = 'table-striped' width = '100%'>";

while($object = mysql_fetch_array($load_objects))
{
	echo "<tr><td>";
	echo "<img src = 'gallery/".$object['object_cover']."' style = 'max-width: 20%; max-height : 20%'></td>";
	echo "<td>".$object['object_name']."<br /><br />".$object['object_descr']."</td>";
	echo "<td> <a href = edit_object.php?id=".$object['object_id']."'><button class = 'btn btn-default'>Изменить</button></a>";
	echo "</tr>";
}

?>

