<?php
require 'head.php';

if (!isset($_SESSION['is_auth']) || $_SESSION['user_role'] !== 'admin')
{
	header("Location:index.php");
}

if (isset($_POST['add_album']))
{
	mysql_query("insert into `albums` (`album_name` , `album_type` , `album_cover`)
		values ('".$_POST['name']."' , '".$_POST['type']."' , '2')")
	or die(mysql_error());

	$new_album = mysql_query("select `album_id` from `albums` order by `album_id` desc limit 0 , 1");
	$new_album = mysql_fetch_array($new_album);
	echo "Успешно добавлен ";
	echo "<a href = 'edit_album.php?id=".$new_album['album_id']."&type=".$_POST['type']."'><button class = 'btn btn-default'>Перейти к редактированию</button></a>";
}

?>

<fieldset>
	<legend>ДОбавить альбом</legend>
	<form action = 'add_album.php' method = 'post'>
		<div class = 'form-group'>
			<label for = 'name'>Имя:</label>
			<input type = 'text' name = 'name' id = 'name' class = 'form-control'>
			<label for = 'type'>Тип альбома:</label>			
			<select name = 'type' class = 'form-control' id = 'type' >
				<option value = '1'>Фото</option>
				<option value = '2'>Видео</option>
			</select>
			<input type = 'submit' name = 'add_album' class = 'btn btn-default'>
		</div>
	</form>
</fieldset>