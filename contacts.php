<?php
require 'head.php';
if (isset($_SESSION['is_auth']) && $_SESSION['user_role'] == 'admin')
{
	echo "<a href = 'edit_contact.php'><button class ='btn btn-default'>Измениить</button></a>";
}
$load_contacts = mysql_query("select * from `users` where `user_id` = '1'");
$contacts = mysql_fetch_array($load_contacts);

echo "<p align = 'center'> телефон : ".$contacts['user_phone']."<br />
е-мейл : ".$contacts['user_email']."<br />
адрес: ".$contacts['user_addr']."
"; 

?>