<?php
require 'head.php';

if (isset($_POST['add_review']) && !empty($_POST['review_text']))
	{
		mysql_query("insert into `reviews` ( `user_id` , `review_date` , `review_time` , `review_text`)
			values ('".$_SESSION['user_id']."' , '".$date."' , '".$time."' , '".$_POST['review_text']."')")
		or die(mysql_error());
	}
	if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == 'true')
	{
	echo "<form acion = 'reviws.php' method = 'post'>
			<textarea name = 'review_text' class = 'form-control'></textarea>
			<input type = 'submit' name = 'add_review' class = 'btn btn-default'>
		</form>
		<table class = 'table-striped' width = '100%'>";
	}
	else
	{
		echo "чтобы оставлять коментарии <a href = 'login.php'>войдите</a> или <a href = 'register.php'>зарегистрируйтесь</a><br />";
	}


	$reviews = mysql_query("select * from `reviews` order by `review_id` desc");
	
	while ($review = mysql_fetch_array($reviews))
	{
		if (empty($review))
		{
			echo "Нет коментариев";
		}
		$user = mysql_query("select `user_name` from `users` where `user_id` = '".$review['user_id']."'");
		$user = mysql_fetch_array($user);

		echo "<tr>
				<td valign = 'top' width = '25%'>
					<h3>".$user['user_name']."</h3><br />
					".$review['review_date']." , ".$review['review_time']."
				</td>
				<td>
					<p>".$review['review_text']."</p>
				</td>
			</tr>";
	}

?>