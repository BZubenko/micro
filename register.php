<?php
require 'head.php';

if (isset($_POST['register']))
{
	$login = $_POST['login'];
	$password = $_POST['password'];
	$verify_password = $_POST['verify_password'];
	$user_name = $_POST['user_name'];
	$user_email = $_POST['user_email'];
	$user_phone  = $_POST['user_phone'];

	$check_exist_login = mysql_query("select `user_login` from `users` where `user_login` = '".$login."'");

	if (mysql_num_rows($check_exist_login) > 0)
	{
		echo "Логин уже существует";
	}
	elseif($password !== $verify_password)
	{
		echo "Введенные Вами пароли не совпадают";
	}
	else 
	{
		mysql_query("insert into `users` 
			(`user_name`, `user_login`, `user_pass`, `user_email`, `user_phone` , `user_role`)
			values ('".$user_name."' , '".$login."' , '".$password."' , '".$user_email."' , '".$user_phone."' , 'user')")
		or die(mysql_error());

		header("Location:login.php?new=true");
	}
}


?>
<fieldset>
	<legend>Регистрация</legend>
<form action = 'register.php' method = 'post' class = 'form-horisontal'>
	<div class = 'form-group'>
		<label for = 'login' class = 'col-sm-2 control-label'>Желаемый логин: </label>
		<div class = 'col-sm-10'>
			<input type = 'text' class = 'form-control' id = 'login' name = 'login'>
		</div>
	</div>
<br />
	<div class = 'form-group'>
		<label for = 'password' class = 'col-sm-2 control-label'>Пароль: </label>
		<div class = 'col-sm-10'>
			<input type = 'password' class = 'form-control' id = 'password' name = 'password'>
		</div>
	</div>
<br />
	<div class = 'form-group'>
		<label for = 'verify_password' class = 'col-sm-2 control-label'>Повторите: </label>
		<div class = 'col-sm-10'>
			<input type = 'password' class = 'form-control' id = 'verify_password' name = 'verify_password'>
		</div>
	</div>
<br />
	<div class = 'form-group'>
		<label for = 'user_name' class = 'col-sm-2 control-label'>Ваше имя: </label>
		<div class = 'col-sm-10'>
			<input type = 'text' class = 'form-control' id = 'user_name' name = 'user_name'>
		</div>
	</div>
<br />
	<div class = 'form-group'>
		<label for = 'user_email' class = 'col-sm-2 control-label'>Ваш е-мейл: </label>
		<div class = 'col-sm-10'>
			<input type = 'text' class = 'form-control' id = 'user_email' name = 'user_email'>
		</div>
	</div>
<br />
	<div class = 'form-group'>
		<label for = 'user_phone' class = 'col-sm-2 control-label"'>Ваше телефон: </label>
		<div class = 'col-sm-10'>
			<input type = 'text' class = 'form-control' id = 'user_phone' name = 'user_phone'>
		</div>
	</div>

<br />
	<div class = 'form-group'>
		<div class = 'col-sm-10'>
			<input type = 'submit' class = 'btn btn-default' name = 'register' value = 'Зарегестрироваться'>
		</div>
	</div>
</form>
</fieldset>
