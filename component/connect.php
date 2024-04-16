<?php

$publishable_key ="YOUR_PUBLISHABLE_KEY";
$secret_key="YOUR_SECRET_KEY";


$db_name = 'mysql:host=localhost;dbname=clothes_db';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

?>