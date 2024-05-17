<?php 

require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conn -> close();

    session_unset();

    session_destroy();

    header("Location: index.php");
    exit();
}