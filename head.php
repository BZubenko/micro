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
				<td><a href = 'poster.php'><button class = 'btn btn-default btn-lg'>Афиша</button></a>
				</td>
				<td><a href = 'gallery.php'><button class = 'btn btn-default btn-lg'>Галерея</button></a>
				</td>
				</td>
				<td><a href = 'news.php'><button class = 'btn btn-default btn-lg'>Новости</button></a>
				</td>
			</tr>
		</table>
