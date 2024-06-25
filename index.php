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
            
            // Fetch user's role from the database
            $_SESSION['role'] = $row['role']; // Assuming 'role' is a column in your 'account' table
            
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>LOGIN</title>
</head>
<body style="color: white; background-color: #1d2630">
    
    <div class="container mt-5">
        <div class="text-center">
            <h1 class="display-5 mb-5"><strong>LOGIN</strong></h1>
        </div>
        <div class="main row justify-content-center">
            <form action="index.php" method="post" id="student-form" class="row justify-content-center mb-4" autocomplete="off">
                <div class="col-7 mb-2">
                    <label for="firstName">Email</label>
                    <input class="form-control" id="email" type="text" name="email" placeholder="Email" required>
                </div>
                <div class="col-7 mb-2">
                    <label for="middleName">Password</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                </div>
                <div class="col-7">
                    <button type="submit" name="login" class="btn btn-success add-btn">Login</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
