<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: login.php");
    exit(); // Ensure that no further code is executed after the redirection
}

// Check if 'role' is set in session
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    // Handle case where role is not set (e.g., redirect or error message)
    echo "Role information not found. Please contact administrator.";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOMEPAGE</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
       
         <a href = "search.php">Search</a>
        <?php
        // Display links based on user's role
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        } elseif ($role == 'employee') {
            // For employees, you can customize what to display or leave it empty
            // Here, we do nothing to omit displaying "Create Accounts"

        } else {
            // Handle unexpected roles (optional)
            echo "Unknown role.";
        }
        ?>
        <a href="crud.php">Create Profile</a>
        <a href="#accounts.php">Accounts</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Welcome to the Homepage</h3>
        <!-- Other content specific to the homepage -->
    </div>
</body>
</html>