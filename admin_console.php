<?php
require 'head.php';

if (!isset($_SESSION['is_auth']) && $_SESSION['user_role'] !== 'true')
{
	header("Location:inex.php");
}

$contacts = mysql_query("select * from `users` where `user_id` = '1'");
$contacts = mysql_fetch_array($contacts);

if (isset($_POST['submit_changes']))
{
	if (isset($_POST['new_logo']) && !empty($_FILE['new_logo']['tmp_name']))
	{
		if(!getimagesize($_FILE['new_logo']['tmp_name']))
		{
			echo "ошибка! файл не является изображением";
		}
		else
		{
			move_uploaded_file($_FILE['new_logo']['tmp_name'], "sysimg/logo");
		}
	}


	if (isset($_POST['new_pass'])) 
	{
		if ($_POST['new_pass'] !== $_POST['veryfi_pass']) 
		{
			$new_pass = $contacts['pass'];
			echo "Ошибка! введеные пароли не совпадают!";

		}
		else
		{
			$new_pass = $_POST['new_pass'];
		}
	}

	mysql_query("update `users` 
		set `user_pass` = '".$new_pass."' ,
		`user_email` = '".$_POST['new_email']."' ,
		`user_phone` = '".$_POST['new_phone']."' ,
		`user_addr` = '".$_POST['new_addr']."'
		where `user_id` = '1'
		");
	echo "Изменения сохранены";
}


echo "<fieldset>
	<legend>
		Изменить контакты
	</legend>
	<form action = 'edit_contact' method = 'post'>
	<label for = 'new_pass'>Изменить пароль</label>
	<input type = 'password' class = 'form-control' name = 'new_pass' id = 'new_pass'>
	<label for = 'veryfi_pass'>Подтвердить пароль</label>
	<input type = 'password' class = 'form-control' name = 'veryfi_pass' id = 'veryfi_pass'>
	<label for = 'new_email'>Изменить е-мейл</label>
	<input type = 'text' name ='new_email' id = 'new_email' value = '".$contacts['user_email']."' class = 'form-control'>
	<label for = 'new_phone'>Изменить телефон</label>
	<input type = 'text' name ='new_phone' id = 'new_phone' value = '".$contacts['user_phone']."' class = 'form-control'>
	<label for = 'new_addr'>Изменить адрес</label>
	<input type = 'text' name ='new_addr' id = 'new_addr' value = '".$contacts['user_addr']."' class = 'form-control'>
	<label for = 'new_logo'>Новый логотип:</label>
	<input type = 'file' name = 'new_logo' id  = 'new_logo' class = 'form-control'>
	<input type = 'submit' name = 'submit_changes' class = 'btn btn-default' value = 'Сохранить изменения'>
	";
?>
