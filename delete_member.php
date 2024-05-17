<?php

require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $sql = "DELETE FROM members WHERE member_id = ?";

    $run = $conn -> prepare($sql);

    $run -> bind_param("i", $_POST['member_id']);

    if($run -> execute()){
        $_SESSION['success_message'] = "Member has been successfully deleted!";
    }
    else{
        $_SESSION['success_message'] = "Error!";
    }

    $conn -> close();

    header("Location: admin_dashboard.php");
    exit(); 
}