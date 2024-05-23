<?php

require_once 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT admin_id, password FROM admins WHERE username = ?";

    $run = $conn -> prepare($sql);

    $run -> bind_param("s", $username);

    $run -> execute();

    $results = $run -> get_result();

    if($results -> num_rows > 0){

        $admin = $results -> fetch_assoc();

        if(password_verify($password, $admin['password'])){
            $_SESSION['admin_id'] = $admin['admin_id'];
            $conn -> close();
            header("Location: admin_dashboard.php");
            exit();
        }
        else{
            $_SESSION['error'] = "Wrong password!";
            $conn -> close();
            header("Location: index.php");
            exit();
        }
    }
    else{
        $_SESSION['error'] = "Wrong username!";
        $conn -> close();
        header("Location: index.php");
        exit();
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin login</title>
</head>
<body>
<div class="container" style="margin-top: 70px;">
    <div class="row justify-content-center">
      <div class="col-md-4">
        <h2 class="text-center">Login</h2>
        <form action="" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary" style="margin-bottom: 8px;">Login</button>
          </div>
        </form>
        <?php 
          if(isset($_SESSION['error']))
          {
              echo $_SESSION['error'];
              unset($_SESSION['error']);
          }
        ?>
      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>