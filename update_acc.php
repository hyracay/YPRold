<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM account WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $account = mysqli_fetch_assoc($result);
    } else {
        echo "Account not found.";
        exit();
    }
} else {
    echo "ID parameter not specified.";
    exit();
}

$error = "";

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password !== $cpassword) {
        $error = "Passwords do not match.";
    } else {
        $check_query = "SELECT * FROM account WHERE email = '$email' AND id != '$id'";
        $check_result = mysqli_query($conn, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            $error = "Email already exists.";
        } else {
            if (!empty($password)) {
                $hashed_password = md5($password);
                $update_query = "UPDATE account SET email = '$email', password = '$hashed_password', FirstName = '$fname', LastName = '$lname', role = '$role' WHERE id = $id";
            } else {
                $update_query = "UPDATE account SET email = '$email', FirstName = '$fname', LastName = '$lname', role = '$role' WHERE id = $id";
            }

            $result = mysqli_query($conn, $update_query);

            if ($result) {
                header("location: accounts.php");
                exit();
            } else {
                $error = "Update failed.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Account</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            max-width: 800px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: auto;
            height: 500px; 
            display: table; 
        }

        table td {
            padding: 10px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button[type="submit"] {
            background-color: #1d5f85;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        p.error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
        <a href="viewprofile.php">Profiles</a>
        <a href="crud.php">Create Profile</a>
        <a href="records.php">SK Reports</a>
        <a href="calendar.php">Calendar</a>
   
        
        <a href="homepage.php">Back</a>
        <?php
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        } 
        ?>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Update Account</h3>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="update_acc.php?id=<?= $id; ?>">
            <input type="hidden" name="id" value="<?= $account['id']; ?>">
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?= $account['email']; ?>" required></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="password" placeholder="New password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="cpassword" placeholder="Confirm password"></td>
                </tr>
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="fname" value="<?= $account['FirstName']; ?>" required></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="lname" value="<?= $account['LastName']; ?>" required></td>
                </tr>
                <tr>
                    <td>Role:</td>
                    <td>
                        <select name="role">
                            <option value="admin" <?php if ($account['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="employee" <?php if ($account['role'] == 'employee') echo 'selected'; ?>>Employee</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><button type="submit" name="update">Update</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>