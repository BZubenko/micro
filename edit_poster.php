<?php
require 'head.php';

if (!isset($_SESSION['is_auth']) && $_SESSION['user_role'] !== 'true')
{
	header("Location:inex.php");
}

$poster_id = $_GET['id'];

$load_poster = mysql_query("select * from `poster` where `poster_id` = '".$poster_id."'");

$poster_info = mysql_fetch_array($load_poster);

if (isset($_POST['edit_poster']))
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
					$photo = $poster_info['poster_photo'];
				}

				if (isset($_POST['video']))
				{
					$media = mysql_num_rows(mysql_query("select `id` from `media_objects`"));
					$media++;
					move_uploaded_file($_FILES['video']['tmp_name'], 'gallery/'.$media);	
					mysql_query("insert into `media_objects` (`object_type`)
					values ('2')");
				$video = $media;
				}
				else
				{
					$video = $poster_info['poster_video'];
				}

				mysql_query("update `poster` set `poster_name` = '".$name."' , `poster_descr` = '".$desrc."' , `poster_date` = '".$date."' , `poster_time` = '".$time."'  , `poster_photo` = '".$photo."' , `poster_video` = '".$video."'
					where poster_id = '".$poster_id."'")
				or die(mysql_error());

				echo "Афиша успешно обновлена!";

			}
echo "<fieldset>
<legend> Изменить афишу</legend>
<form action = 'edit_poster.php?id=".$poster_id."' method = 'post'>
	<label for='name' >Назвиние Мероприятия: </label><br />
	<input id = 'name' type = 'text' name = 'name' value = '".$poster_info['poster_name']."' class = 'form-control'><br /><br />
	<label for = 'desrc'> Описание: </label><br />
	<textarea name = 'desrc' id = 'descr' class='form-control'>".$poster_info['poster_descr']."</textarea><br><br>
	<label for = 'date'>Дата :</label><br />
	<input type = 'date' value = '".$poster_info['poster_date']."' class = 'form-control' id = 'date' name = 'date'><br /><br />
	<label for = 'time'>Время : </label>
	<input type = 'time' class = 'form-control' value = '".$poster_info['poster_time']."' name = 'time' id = 'time'><br/><br />
	<label for = 'photo'> Обложка афиши (постер):</label><br />
	<input type = 'file' name = 'photo' id = 'photo' class = 'form-control'><br /><br />
	<label for = 'video'> Видео (промо) :</label>
	<input type = 'file' name = 'video' id = 'video' class = 'form-control'><br /><br />
	<input type = 'submit' name = 'add_poster' value = 'Изменить афишу' class = 'btn btn-default'>
</form>

</fieldset>"

?>