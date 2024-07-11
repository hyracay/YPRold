<?php
session_start();
include("../conne.php");

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
            header("location: temp_homepage.php");
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
    <title>LOGIN TO YPR</title>
</head>
<body>
    <div class="d-lg-flex half">
        <div class="container">
            <div>
                <h1><strong>Youth Profiling System</strong></h1>
                <p>Centralized profile records for the youth of Barangay Tawang</p>
                <form action="temp_index.php" method="POST">
                <div>
                    <input type="email" name="email" class="form-control" placeholder="Email" id="email"required>
                </div>
                <div>
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                </div>
                <input type="submit" value="Log In" name="login" class="login-btn">
                </form>
            </div>
        </div>
        </div>
    </div>
</body>
</html>