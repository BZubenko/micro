<?php
session_start();
mysql_connect('localhost' , 'root');

mysql_set_charset('UTF-8');

mysql_query("use `site`");




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
				<td with = '20%'><img src = 'sysimg/logo.jpg'>

				</td>
				<td><a href = 'index.php'><button class ='btn btn-lg btn-default'>На главную</button></a>
				</td>
				<td><a href = 'poster.php'><button class = 'btn btn-default btn-lg'>Афиша</button></a>
				</td>
				<td><a href = 'gallery.php'><button class = 'btn btn-default btn-lg'>Галерея</button></a>
				</td>
				<td>
				<?php
				if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 'true')
				{
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
