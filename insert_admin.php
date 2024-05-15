<?php 

require_once 'config.php';

$username = "ivan";
$password = "sifra123";

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO admins(username, password) VALUES (?, ?)";

$run = $conn->prepare($sql);

$run -> bind_param("ss", $username, $hashedPassword);

$run -> execute();