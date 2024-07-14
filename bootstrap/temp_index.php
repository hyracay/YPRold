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
        if(password_verify($password, $row['password'])){
            $_SESSION['email'] = $row['email'];
            $_SESSION['fname'] = $row['FirstName'];
            $_SESSION['lname'] = $row['LastName'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['code'] = $row['code'];

            // Redirect based on role
            if ($_SESSION['role'] == 'superadmin') {
                header("location:temp_accounts.php");
            } else {
                header("location:temp_homepage.php");
            }
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('src/bg.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container p {
            margin-bottom: 20px;
            color: #666;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Youth Profiling System</h1>
        <p>Centralized profile records for the youth of Barangay Tawang</p>
        <form action="temp_index.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <input type="submit" value="Log In" name="login" class="login-btn">
        </form>
    </div>
</body>
</html>
