<?php 

require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phone_number'];

    $sql = "INSERT INTO trainers(first_name, last_name, email, phone_number) VALUES (?, ?, ?, ?)";

    $run = $conn -> prepare($sql);

    $run -> bind_param("ssss", $firstName, $lastName, $email, $phoneNumber);

    if($run -> execute()){
        $_SESSION['success_message'] = 'Trainer successfully added!';
        header("Location: admin_dashboard.php");
        $conn -> close();
        exit();
    }else{
        $_SESSION['success_message'] = "Error!";
        header("Location: admin_dashboard.php");
        exit();
    }
}