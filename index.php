<?php
session_start();
include("connection/conne.php");

$error_msg = '';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $email = mysqli_real_escape_string($conn, $email);

    $sql_fetch = "SELECT * FROM account WHERE email = '$email'";
    $result = mysqli_query($conn, $sql_fetch);

    if (mysqli_num_rows($result) < 1) {
        $error_msg = "Invalid credentials!";
    } else {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['fname'] = $row['FirstName'];
            $_SESSION['lname'] = $row['LastName'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['code'] = $row['code'];
    
            if ($row['role'] == "superadmin") {
                $_SESSION["SUPERADMIN"] = $row['role'];
                header("location:superadmin/accounts.php");
                exit;
            } elseif ($row['role'] == "admin") {
                $_SESSION["ADMIN"] = $row["role"];
                header("location:admin/homepage.php");
                exit;
            } else {
                $_SESSION["USER"] = $row["role"];
                header("location:user/homepage.php");
                exit;
            }
        } else {
            $error_msg = "Invalid password!";
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
            width: 93%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-btn {
            width: 26%;
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
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert"></script>
</head>
<body>
    <div class="login-container">
        <h1>Youth Profiling System</h1>
        <p>Centralized profile records for the youth of Barangay Tawang</p>
        <form action="index.php" method="POST">
            <div class="form-group">
                <center><input type="email" name="email" placeholder="Email" required></center>
            </div>
            <div class="form-group">
                <center><input type="password" name="password" placeholder="Password" required></center>
            </div>
                <center><input type="submit" value="Log In" name="login" class="login-btn"></center>
        </form>
    </div>
    <?php if ($error_msg): ?>
        <script>
            swal('Error', '<?php echo $error_msg; ?>', {
                icon: 'error',
                buttons: {
                    confirm: {
                        className: 'btn btn-danger'
                    }
                }
            });
        </script>
    <?php endif; ?>
</body>
</html>
