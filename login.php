<?php
require 'head.php';

if (isset($_POST['submit']))
{
	$login = $_POST['login'];
	$pwd = $_POST['pwd'];

	$login_find = mysql_query("select * from `users` where user_login = '".$login."'");
	$login_find = mysql_fetch_array($login_find);

	if (empty($login_find))
	{
		echo "Логин введен неверно!";
	}
	else 
	{
		switch ($pwd) {
			case $login_find['user_pass']:
				$_SESSION['is_auth'] = 'true';
				$_SESSION['id'] = $login_find['user_id'];
				$_SESSION['user_name'] = $login_find['user_name'];
				header("Location:index.php");
				break;
			
			default:
				echo "Пароль введен неверно";
				break;
		}
	}
}


?>

<form action = 'login.php' method = 'post'>
	<div class = 'form-group' align = 'center'>
		<fieldset>
			<legend align = 'center'>
				Вход
			</legend>
			<label>логин: </label>
			<input class = 'form-control' type = 'text' name = 'login'>
			<br /><br /><label>пароль: </label>
			<input class = 'form-control' type = 'password' name = 'pwd'>
			<br /><br /><input type = 'submit' name = 'submit'class = 'btn btn-default' value = 'Вход'>
	</fieldset>
	</div>
</form>

			<a href = 'register.php'><button class = 'btn btn-default'>Регистрация</button></a>	
</body>
