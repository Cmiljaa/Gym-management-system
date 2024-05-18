<?php 

require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $trainerId = $_POST['trainer_id'];

    $sql = "DELETE FROM trainers WHERE trainer_id = ?";

    $run = $conn -> prepare($sql);

    $run -> bind_param("i", $trainerId);

    if($run -> execute()){
        $_SESSION['success_message'] = "Trainer is successfully deleted!";
        header("Location: admin_dashboard.php");
        exit();
    }
    else{
        $_SESSION['success_message'] = "Error!";
        header("Location: admin_dashboard.php");
        exit();
    }
}