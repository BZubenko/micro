<?php
require 'head.php';
?>
<table width="100%" border="0">
	<tr align = 'center'><td><a href = 'poster.php'><button class = 'btn btn-default'>Афиша</button></a></td></tr><tr>
		<?php
		$poster = mysql_query("select * from `poster` order by `poster_id` desc limit 0 , 5")
		or die(mysql_error());
		while($poster == mysql_fetch_array($poster))
		{

			echo "<td>
			<figure>
			<img src = 'gallery/".$poster['poster_photo']."' style = 'max-width:20%; max-height:20%'>
			<figcaption>".$poster['poster_name']."</figcaption>
			</figure></td>";			
		}
		?>