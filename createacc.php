<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

$FirstName = $LastName = $email = $password = $cpassword = ""; 
$show_alert = false; 
$form_submitted = false; 

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $FirstName = $_POST['fname'];
    $LastName = $_POST['lname'];
    $role = $_POST['role']; 

    $check_query = "SELECT * FROM account WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Email already exists');</script>";
    } else if ($password != $cpassword) {
        $show_alert = true;
    } else {
        $password = md5($password); 

        $sql_insert = "INSERT INTO account(email, password, FirstName, LastName, role) 
                       VALUES('$email','$password', '$FirstName', '$LastName', '$role')";
        $result_insert = mysqli_query($conn, $sql_insert);

        if ($result_insert) {
            $form_submitted = true;
            echo "<script>
                    alert('User Successfully Registered.');
                    window.location.href = window.location.href; // Refresh the page
                  </script>";
        } else {
            echo "<script>alert('Error registering user.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="src/css.css">
         
    <title>Registration Form</title> 
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            font-family: "Helvetica", Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            position: relative;
            max-width: 100%;
            width: 78%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 0 30px;
        }

        .container .forms {
            display: flex;
            align-items: center;
            height: auto;
            width: 100%;
            transition: height 0.2s ease;
        }

        .container .form {
            width: 100%;
            padding: 30px;
            background-color: #fff;
            transition: margin-left 0.18s ease;
        }

        .container .form .title {
            position: relative;
            font-size: 27px;
            font-weight: 600;
        }

        .form .title::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 30px;
            background-color: #4070f4;
            border-radius: 25px;
        }

        .form .input-field {
            position: relative;
            height: 50px;
            width: 100%;
            margin-top: 30px;
        }

        .input-field input,
        .input-field select {
            position: absolute;
            height: 100%;
            width: 100%;
            padding: 0 35px;
            border: none;
            outline: none;
            font-size: 16px;
            border-bottom: 2px solid #ccc;
            border-top: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .input-field input:is(:focus, :valid),
        .input-field select:is(:focus, :valid) {
            border-bottom-color: #4070f4;
        }

        .input-field i {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            font-size: 23px;
            transition: all 0.2s ease;
        }

        .input-field input:is(:focus, :valid) ~ i,
        .input-field select:is(:focus, :valid) ~ i {
            color: #4070f4;
        }

        .input-field i.icon {
            left: 0;
        }

        .input-field i.showHidePw {
            right: 0;
            cursor: pointer;
            padding: 10px;
        }

        .form .button {
            margin-top: 35px;
        }

        .form .button input {
            border: none;
            color: black;
            font-size: 17px;
            font-weight: 500;
            letter-spacing: 1px;
            border-radius: 6px;
            background-color: #a4b6c2;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .button input:hover {
            background-color: #f37a1f;
            color: white;
        }

        .alert {
            margin-top: 20px;
            color: red;
            text-align: center;
        }
    </style>

</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
        <a href="viewprofile.php">Profiles</a>
        <a href="crud.php">Create Profile</a>
        <a href="records.php">Records</a>
        <a href="calendar.php">Calendar</a>
        <a href="accounts.php">Accounts</a>
        <a href="homepage.php">Back</a>
        <a href="logout.php">Logout</a>
    </div>
    
    <div class="container">
        <div class="forms">
            <div class="form register">
                <span class="title">Registration</span>

                <form id="registration-form" method="POST" action="createacc.php" autocomplete="off">
                    <?php if (isset($_POST['submit']) && $password != $cpassword): ?>
                        <div class="alert alert-danger" role="alert">Passwords do not match.</div>
                    <?php endif; ?>
                    <div class="input-field">
                        <input type="text" name="fname" placeholder="Enter your name" required value="<?php echo htmlspecialchars($FirstName); ?>">
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" name="lname" placeholder="Enter your last name" required value="<?php echo htmlspecialchars($LastName); ?>">
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Enter your email" required value="<?php echo htmlspecialchars($email); ?>">
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Create a password" required>
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="cpassword" class="password" placeholder="Confirm a password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <div class="input-field">
                        <label for="role"></label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="" disabled selected>Select Role</option>
                            <option value="employee" <?php if (isset($_POST['role']) && $_POST['role'] == 'employee') echo 'selected'; ?>>User</option>
                            <option value="admin" <?php if (isset($_POST['role']) && $_POST['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                        <i class="uil uil-user"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (<?php echo json_encode($form_submitted); ?>) {
                document.getElementById('registration-form').reset();
            }
        });

        // Password show/hide functionality
        const pwShowHide = document.querySelectorAll('.showHidePw');
        const pwFields = document.querySelectorAll('.password');

        pwShowHide.forEach(eyeIcon => {
            eyeIcon.addEventListener('click', () => {
                pwFields.forEach(pwField => {
                    if (pwField.type === 'password') {
                        pwField.type = 'text';
                        pwShowHide.forEach(icon => {
                            icon.classList.replace('uil-eye-slash', 'uil-eye');
                        });
                    } else {
                        pwField.type = 'password';
                        pwShowHide.forEach(icon => {
                            icon.classList.replace('uil-eye', 'uil-eye-slash');
                        });
                    }
                });
            });
        });
    </script>

    <script src="script.js"></script> 
</body>
</html>