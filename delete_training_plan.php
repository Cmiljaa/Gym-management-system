<?php 


require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $planId = $_POST['plan_id'];

    $sql = "DELETE FROM training_plans WHERE plan_id = ?";

    $run = $conn -> prepare($sql);
    
    $run -> bind_param("i", $planId);

    if($run -> execute()){
        $_SESSION['success_message'] = "Successfully deleted training plan!";
        header("Location: admin_dashboard.php");
        exit();
    }
    else{
        $_SESSION['success_message'] = "Error";
        header("Location: admin_dashboard.php");
        exit();
    }
}