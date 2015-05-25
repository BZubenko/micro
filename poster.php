<?php
require 'head.php';

$poster_id = $_GET['id'];

$poster = mysql_query("select * from `poster` where `poster_id` = '".$poster_id."'") or print(mysql_error());
$poster = mysql_fetch_array($poster);

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')
{
	echo "<a href = 'edit_poster.php?id=".$poster_id."'><button class = 'btn btn-default'>(admin) Редактировать</button></a><br />";
}

echo "<table border = '0' width = '100%'>
		<tr align = 'center'>
			<td width = '30%' valign = 'top'>
				<img src = 'gallery/".$poster['poster_photo']."' style = 'max-width:70%; max-heigth:70%'>
			</td></tr><tr align = 'center'>
			<td>
				<h1>".$poster['poster_name']."</h1><br />
				<h3>".$poster['poster_date'].", ". $poster['poster_time']."
				<br />
				";
				if (!empty($poster['poster_video']))
				{
					echo "<video src = 'gallery/".$poster['poster_video']."' controls = 'controls' width = '40%' heigth = '40%'><br /><br />";
				} 
echo $poster['poster_descr']."</td></tr></table>";

comments('poster.php?id='.$poster_id , $poster_id , '1' , $date , $time);
?>

