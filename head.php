<?php
session_start();
mysql_connect('localhost' , 'root');

mysql_set_charset('UTF-8');

mysql_query("use `site`");

$time = date("H:i");
$date = date("d.m.Y");


function comments($action , $type , $id , $date, $time)
{
	if (isset($_POST['add_comment']) && !empty($_POST['comment_text']))
	{
		mysql_query("insert into `comments` (`to_type` , `comments_to` , `user_id` , `comment_date` , `comment_time` , `comment_text`)
			values ('".$type."' , '".$id."' , '".$_SESSION['user_id']."' , '".$date."' , '".$time."' , '".$_POST['comment_text']."')")
		or die(mysql_error());
	}
	if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 'true')
	{
	echo "<form acion = '".$action."' method = 'post'>
			<textarea name = 'comment_text' class = 'form-control'></textarea>
			<input type = 'submit' name = 'add_comment' class = 'btn btn-default'>
		</form>
		<table class = 'table-striped' width = '100%'>";
	}
	else
	{
		echo "чтобы оставлять коментарии <a href = 'login.php'>войдите</a> или <a href = 'register.php'>зарегистрируйтесь</a><br />";
	}


	$comments = mysql_query("select * from `comments` where `comments_to` = '".$id."' and `to_type` = '".$type."'");
	
	while ($comment = mysql_fetch_array($comments))
	{
		if (empty($comment))
		{
			echo "Нет коментариев";
		}
		$user = mysql_query("select `user_name` from `users` where `user_id` = '".$comment['user_id']."'");
		$user = mysql_fetch_array($user);

		echo "<tr>
				<td valign = 'top' width = '25%'>
					<h3>".$user['user_name']."</h3><br />
					".$comment['comment_date']." , ".$comment['comment_time']."
				</td>
				<td>
					<p>".$comment['comment_text']."</p>
				</td>
			</tr>";
	}

}

?>

<html>
	<head>
		<title>
			my site
		</title>
		<link rel = 'stylesheet' href= 'css/bootstrap.css'>
		<meta charset = 'UTF-8'>
	</head>
	<body>
		<table class = 'table' border = '0' width = '100%'>
			<tr>
				<td with = '20%'><img src = 'sysimg/logo'>

				</td>
				<td><a href = 'index.php'><button class ='btn btn-lg btn-default btn-lg'>На главную</button></a>
				</td>
				<td><a href = 'gallery.php?section=null'><button class = 'btn btn-default btn-lg'>Галерея</button></a>
				</td>
				<td><a href = 'contacts.php'><button class = 'btn btn-default btn-lg'>Контакты</button></a>
				</td>
				<td><a href = 'reviews.php'><button class = 'btn btn-default btn-lg'>Отзывы, пожелания</button></a>
				</td>
				<td>
				<?php
				if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 'true')
				{
					if ($_SESSION['user_role'] == 'admin')
					{
					echo "<br /><a href = 'users.php'><button class = 'btn btn-default'>Пользователи</button></a>";
					}
					echo $_SESSION['user_name'];
					echo "<br /><a href = 'logout.php'><button class = 'btn btn-default'>Выход</button></a>";
				}
				else
				{
					echo "<a href = login.php><button class = 'btn btn-default'>Вход</button></a>  ";
					echo "<a href = register.php><button class = 'btn btn-default'>Регистрация</button></a>";
				}
				?>
				</td>
			</tr>
		</table>
