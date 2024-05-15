<?php

session_start();

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$db = "gym";

$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $db);

if(!$conn){
    die("Database is not connected!");
}