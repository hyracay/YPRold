<?php
session_start();
include("conne.php");

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($conn, $email);

    $sql_fetch = "SELECT * FROM account WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_fetch);

    if(mysqli_num_rows($result) < 1){
        echo "<script>alert('Incorrect Email or Password');</script>";
    } else {
        $row = mysqli_fetch_assoc($result);
        if(md5($password) === $row['password']){
            $_SESSION['email'] = $row['email'];
            $_SESSION['fname'] = $row['FirstName'];
            $_SESSION['lname'] = $row['LastName'];
            $_SESSION['role'] = $row['role'];
            header("location: homepage.php");
            exit;
        } else {
            echo "<script>alert('Incorrect Email or Password');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>LOGIN</title>
</head>
<body>
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('src/bg.jpg');"></div>
        <div class="contents order-2 order-md-1">
        <div class="container">
            <div class="row align-items-center justify-content-center">
            <div class="col-md-7">
                <h1><strong>Youth Profiling System</strong></h1>
                <p class="mb-4">Centralized profile records for the youth of Barangay Tawang</p>
                <form action="index.php" method="POST">
                <div class="form-group first">
                    <input type="email" name="email" class="form-control" placeholder="Email" id="email"required>
                </div>
                <div class="form-group last mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                </div>
                <input type="submit" value="Log In" name="login" class="login-btn">
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>