<?php

require 'head.php';

if (isset($_SESSION['role']))
{
	$role = $_SESSION['role'];

	switch ($role) {
		case 'user':
			header("Location:index.php");
			break;
		
		case 'admin':
			
			if (isset($_POST['add_poster']))
			{
				$name = $_POST['name'];
				$date = $_POST['date'];
				$time = $_POST['time'];
				$desrc = $_POST['desrc'];

				
				if (isset($_POST['photo']))
				{
					$media = mysql_num_rows(mysql_query("select `id` from `media_objects`"));
				$media++;

					move_uploaded_file($_FILES['photo']['tmp_name'], 'gallery/'.$media);
					mysql_query("insert into `media_objects` (`object_type`)
					values ('1')");
					$photo = $media;
				}
				else
				{
					$photo = '1';
				}

				if (isset($_POST['video']))
				{
					$media = mysql_num_rows(mysql_query("select `id` from `media_objects`"));
					$media++;
					move_uploaded_file($_FILES['video']['tmp_name'], 'gallery/'.$media);	
					mysql_query("insert into `media_objects` (`object_type`)
					values ('1')");
				$video = $media;
				}
				else
				{
					$video = null;
				}

				mysql_query("insert into `poster` (`poster_name` , `poster_descr` , `poster_date` , `poster_time` , `poster_photo` , `poster_video`)
					values ('".$name."' , '".$desrc."' , '".$date."' , '".$time."' , '".$photo."' , '".$video."')")
				or die(mysql_error());

				echo "Афиша успешно добавлена!";

			}

			break;
	}
}
else
{
	header("Location:index.php");
}

?>

<fieldset>
<legend> Добавить афишу</legend>
<form action = 'add_poster.php' method = 'post'>
	<label for="name">Назвиние Мероприятия: </label><br />
	<input id = 'name' type = 'text' name = 'name' class = 'form-control'><br /><br />
	<label for = 'desrc'> Описание: </label><br />
	<textarea name = 'desrc' id = 'descr' class="form-control"></textarea><br><br>
	<label for = 'date'>Дата :</label><br />
	<input type = 'date' class = 'form-control' id = 'date' name = 'date'><br /><br />
	<label for = 'time'>Время : </label>
	<input type = 'time' class = 'form-control' name = 'time' id = 'time'><br/><br />
	<label for = 'photo'> Обложка афиши (постер):</label><br />
	<input type = 'file' name = 'photo' id = 'photo' class = 'form-control'><br /><br />
	<label for = 'video'> Видео (промо) :</label>
	<input type = 'file' name = 'video' id = 'video' class = 'form-control'><br /><br />
	<input type = 'submit' name = 'add_poster' value = 'Добавить афишу' class = 'btn btn-default'>
</form>

</fieldset>