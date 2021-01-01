<?php
include "../Database/database.data.php";

$query = "INSERT INTO master_useroop(user_name ,user_number, user_email, user_password,user_gender) VALUES('pheonix', '2323', 'pheonix@gmail.com', '43523', 'male');";
$string = "sssss";
$cls = new Connection();
$rturn = $cls->create($query);

print_r($rturn);
