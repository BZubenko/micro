<?php
require 'head.php';

$_where = "";

if (isset($_GET['search']))
{
	$date_action = '?search='.$_GET['search'];

	if (isset($_GET['date_search']))
	{
		$and = 'and';
	}
	else
	{
 		$and = '';
	}

	$_where = "where `poster_name` like '%".$_GET['search']."%' or `poster_descr` like '%".$_GET['search']."%'".$and;
}
else
{
	$date_action =  '';
}

if (isset($_GET['date_search']))
{
	$search_action = '?date='.$_GET['date_search'];

	if (isset($_GET['search']))
	{
	$_where = $_where." `poster_date` = '".$_GET['date_search']."'";
	}
	$_where = "where `poster_date` = '".$_GET['date_search']."'";
}
else
{
	$search_action = '';
}

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin')
{
	echo "<a href = 'add_poster.php'><button class = 'btn btn-default'>(admin) добавить афишу</button></a>";
}
?>
<table width="100%" border="0" class = 'table-striped'>
	<tr>
		<td align = 'center'>
			<?php
			echo "<form action = 'index.php".$search_action."' method = 'get'>";
			?>
				<div class = 'form-inline'>
					<label for = 'search'>Поиск: </label>
					<input type = 'text' name = 'search' id = 'search' class = 'form-control'>
					<input type = 'submit' class = 'btn btn-control' name = 'submit_search' value = 'Поиск'>
				</div>
			</form>

			<br /><br />

			<?php
			echo "<form action = 'index.php".$date_action."' method = 'get'>";
			?>
				<div class = 'form-inline'>
					<label for ='date_search'>Поиск по дате: </label>
					<input type = 'date' name = 'date_search' id = 'date_search' class = 'form-control'>
					<input type = 'submit' name = 'submit_date_search' class = 'btn btn-default' value = 'Поиск по дате'>
				</div>
			</form>

		</td>
	</tr>
		<?php
		$get_poster = mysql_query("select * from `poster` ".$_where." order by `poster_id` desc")
		or die(mysql_error());
		while ($poster = mysql_fetch_array($get_poster))
		{
			echo "<tr><td width = '25%'>
			<figure>
			<img src = 'gallery/".$poster['poster_photo']."' style = 'max-width:100%; max-height:100%'>
			<figcaption><br />".$poster['poster_date']." , ".$poster['poster_time']."</figcaption>
			</figure></td>
			<td><a href = 'poster.php?id=".$poster['poster_id']."'><h2>".$poster['poster_name']."</h2></a><br />
			<br /><p>".$poster['poster_descr']."</p></td><tr>";			
		}
		?>
	</table>
			