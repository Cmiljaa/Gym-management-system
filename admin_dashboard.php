<?php 

require_once 'config.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: index.php");
    exit();
}

?>

<?php 

$sql = "SELECT * FROM training_plans";

$run = $conn -> query($sql);

$training_plans = $run -> fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin dashboard</title>
</head>
<body>

<?php if(isset($_SESSION['success_message'])): ?>
  <div class="alert alert-success alert-dismissible fade show">
    <strong><?= $_SESSION['success_message']; unset($_SESSION['success_message']);?></strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="container">
    <div class="row mb-5">
        <div class="col-md-6">
            <h2>Register member</h2>
            <form action="register_member.php" method="POST" enctype="multipart/form-data">
                First name: <input class="form-control" type="text" name="first_name"><br>
                Last name: <input class="form-control" type="text" name="last_name"><br>
                Email: <input class="form-control" type="email" name="email"><br>
                Phone number: <input class="form-control" type="text" name="phone_number"><br>
                Training plan:
                <select class="form-control" name="training_plan_id">
                    <option value="" disabled selected>Training plans</option>
                    <?php foreach($training_plans as $plan): ?>
                        <option value="<?= $plan['plan_id'] ?>">
                        <?= $plan['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>

                <input type="hidden" name="photo_path" id="photoPathInput">
                <div id="dropzone-upload" class="dropzone"></div>

                <input class="btn btn-primary mt-3" type="submit" value="Register member">
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>