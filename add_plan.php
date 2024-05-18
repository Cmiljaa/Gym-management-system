<?php 

require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $planName = $_POST['plan_name'];
    $sessions = $_POST['sessions'];
    $price = $_POST['price'];

    $sql = "INSERT INTO training_plans(name, sessions, price) VALUES (?, ?, ?)";

    $run = $conn -> prepare($sql);

    $run -> bind_param("sis", $planName, $sessions, $price);

    if($run -> execute()){
        $_SESSION['success_message'] = "Training plan successfully added!";
        $conn -> close();
        header("Location: admin_dashboard.php");
        exit();
    }else{
        $_SESSION['success_message'] = "Error!";
        $conn -> close();
        header("Location: admin_dashboard.php");
        exit();
    }

}