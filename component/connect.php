<?php

$publishable_key ="pk_test_51OwkapSIjTwHbCfMhcuXsXOtZxiVVQBB0AAq7DMkkGUXx0I6rWIR8U6NZpeYcYcdLFKZzuaXS2Np6ncPK7NTcNPm00pZPHAF4O";
$secret_key="sk_test_51OwkapSIjTwHbCfMgzZxYZ9JcGoHXS2uqdvsPzKW4RpSUAs4EaLsF7kNuJDyHtsWUQbO0X6Nj8XWOOWmOTrSrEmy00OhxFSM9w";


$db_name = 'mysql:host=localhost;dbname=clothes_db';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

?>