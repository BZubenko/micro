<?php

require 'head.php';

$page = $_GET['page'];

$album = $_GET['album'];

$object_type = $_GET['type'];

$get_object = mysql_query("select * from `media_objects`
 where `object_type` = '".$object_type."'
 and `album_id` = '".$album."'
 order by `object_id` desc")
or print mysql_error();
;

echo "<a href = 'album.php?id=".$album."&type=".$object_type."'><button class = 'btn btn-default'>назад</button></a>";

if($page !== 0)
{
	$page--;
	echo "<p align = 'left'><a href = 'object.php?album=".$album."&type=".$object_type."&page=".$page."'>
	<button class = 'btn btn-default'>Предыдущее</button></a></p>";
}

$page = $_GET['page'];

if(mysql_num_rows($get_object)+1 != $page)
{
	$page++;
	echo "<p align = 'right'><a href = 'object.php?album=".$album."&type=".$object_type."&page=".$page."'>
	<button class = 'btn btn-default'>Следующее</button></a></p>";
}

$page = $_GET['page'];

$get_object = mysql_query("select * from `media_objects`
 where `object_type` = '".$object_type."'
 and `album_id` = '".$album."'
 order by `object_id` desc
 limit ".$page." , 1")
;

$object = mysql_fetch_array($get_object);

echo "<p align = 'center'><h2>".$object['object_name']."</h2></p><br />";

if ($object_type == '1')
{
	echo "<figure align = 'center'>
		<img src = 'gallery/".$object['object_id']."' style = 'max-width: 70%; max-height : 70%'>
		<figcaption>".$object['object_descr']."</figcaption></figure>";
}

else
{
	echo "<video src = 'gallery/".$object['object_id']."' align = 'center' controls = 'controls' poster = '".$object['object_cover']."'><br />".$object['object_descr'];
}


comments("a href = 'object.php?album=".$album."&type=".$object_type."&page=".$page , '2' , $object['object_id'] , $date , $time);


?>