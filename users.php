<?php
require 'head.php';

if (!isset($_SESSION['is_auth']) && $_SESSION['user_role'] == 'admin')
{
	header("Location:index.php");
}

$where = '';

$link = '';

$action = '';

$and = '';

if (isset($_POST['submit_change']))
{
	mysql_query("update table `users` set `user_role` = '".$_POST['change_role']."' where `user_id` = '".$_POST['user_id']."'");
	echo "роль изменена.";
}

if (isset($_GET['search']))
{
	$link = "search=".$_GET['search'];

	if (isset($_GET['section'])) 
	{
		$and = 'and ';
	}
	$where = "where `user_name` like '%".$_GET['search']."%' ".$and;
}
if (isset($_GET['section'])) 
{
	$action = "?section=".$_GET['section'];
	if (isset($_GET['search']))
	{
		$where = $where."`user_role` = '".$_GET['section']."'";
	}
	else
	{
		$where = "where `user_role` = '".$_GET['section']."'";
	}
}

echo "<p align = 'right'><a href = 'users.php".$link."'><button class = 'btn btn-default'>все</button></a></p>";
echo "<p align = 'center'><a href = 'users.php?section=admin&".$link."'><button class = 'btn btn-default'>админы</button></a></p>";
echo "<p align = 'left'><a href = 'users.php?section=user&".$link."'><button class = 'btn btn-default'>пользователи</button></a></p>";


$load_users = mysql_query("select * from `users` ".$where);

echo '<table class = "table-striped" width = "100%">';


echo "<form action = 'users.php".$action."' method = 'get'>
<div class = 'form-inline'>
	<input type = 'text' name = 'search' class = 'form-control'>
	<input type = 'submit' name = 'submit_search' class = 'btn btn-default'>
	</div>
	</form>";


while ($user = mysql_fetch_array($load_users)) 
{
	echo "<tr align = 'center'><td width = '50%'>";
	echo $user['user_name'];
	echo "</td><td>";
	echo "<form action = 'users.php' method = 'post'>";
	echo "<label for = 'change_role'>Изменить роль</label>
	<input type = 'hidden' name = 'user_id' value = '".$user['user_id']."'>
	<select name = 'change_role' id = 'change_role' class = 'form-control'>";
	if ($user['user_role'] == 'user')
	{
		$selected_1 = 'selected = "selected"';
		$selected_2 = '';
	}
	elseif($user['user_role'] == 'admin')
	{
		$selected_1 = '';
		$selected_2 = "selected = 'selected'";
	}
	echo "<option value = 'user' ".$selected_1.">user</option>
		<option value = 'admin' ".$selected_2.">admin</option>
		</select>
		<input type = 'submit_change' value = 'Сохранить' class = 'btn btn-default' name = 'submit_change'>
		</form></td></tr>";
}
?>