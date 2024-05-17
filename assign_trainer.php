<?php 


require_once 'config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $member_id = $_POST['member_select'];
    $trainer_id = $_POST['trainer_select'];

    $sql = "UPDATE members SET trainer_id = ? WHERE member_id = ?";

    $run = $conn -> prepare($sql);

    $run -> bind_param("ii", $trainer_id, $member_id);

    if($run -> execute()){

        $_SESSION['success_message'] = "Trainer is assigned successfully!";
        $conn -> close();
        header("Location: admin_dashboard.php");
        exit();
    }
    else{
        $_SESSION['success_message'] = "Error!";
        header("Location: admin_dashboard.php");
        exit();
    }
}