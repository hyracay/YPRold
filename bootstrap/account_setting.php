<?php
session_start();
include("../conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
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
    <title>CREATE YOUTH PROFILE</title>

</head>

<body>
<div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
        
           <?php
        if ($role == 'admin' || $role == 'user') {
            echo '<a href="homepage.php">Back</a>';
        }else{
            echo '<a href="viewprofile.php">Profiles</a>';
        }
        ?>
           
       <?php
        
        if ($role == 'admin' || $role == 'user') {
            echo '<a href="crud.php">Create Profile</a>';
        } 
        ?>
        <?php
        if ($role == 'admin' || $role == 'superadmin') {
            echo '<a href="accounts.php">Accounts</a>';
        }
        ?>
        <?php
       
        if ($role == 'admin' || $role == 'superadmin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        } 
        ?>
        <?php
        if ( $role == 'superadmin') {
            echo '<a href="update_on.php">Change Account Information</a>';
        }
        ?>

        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
    <?php


// Initialize variables to hold user data
$FirstName = $LastName = $email = '';

// Fetch current user's information from the database
$current_email = $_SESSION['email'];
$query = "SELECT * FROM account WHERE email = '$current_email'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $FirstName = $row['FirstName'];
    $LastName = $row['LastName'];
    $email = $row['email'];
} else {
    echo "User data not found.";
    exit();
}

// Process form submission
if (isset($_POST['submit'])) {
    $new_email = $_POST['email'];
    $FirstName = $_POST['fname'];
    $LastName = $_POST['lname'];

    // Check if a new password is submitted
    if (!empty($_POST['password']) && !empty($_POST['cpassword'])) {
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if ($password != $cpassword) {
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Update query with password
            $update_query = "UPDATE account SET email = '$new_email', password = '$hashed_password', FirstName = '$FirstName', LastName = '$LastName' WHERE email = '$current_email'";
            $update_result = mysqli_query($conn, $update_query);

            if ($update_result) {
                // Update session with new email if email is updated
                $_SESSION['email'] = $new_email;

                echo "<script>alert('Account updated successfully.');</script>";
                // Optionally, redirect to a confirmation page or back to the account view
                // header("location: account_updated.php");
            } else {
                echo "<script>alert('Error updating account.');</script>";
            }
        }
    } else {
        // Update query without password change
        $update_query = "UPDATE account SET email = '$new_email', FirstName = '$FirstName', LastName = '$LastName' WHERE email = '$current_email'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            // Update session with new email if email is updated
            $_SESSION['email'] = $new_email;

            echo "<script>alert('Account updated successfully.');</script>";
            // Optionally, redirect to a confirmation page or back to the account view
            // header("location: account_updated.php");
        } else {
            echo "<script>alert('Error updating account.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>

</head>
<body>
    <h2>Update Account</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="fname">First Name:</label><br>
        <input type="text" id="fname" name="fname" value="<?php echo htmlspecialchars($FirstName); ?>" required><br><br>

        <label for="lname">Last Name:</label><br>
        <input type="text" id="lname" name="lname" value="<?php echo htmlspecialchars($LastName); ?>" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>

        <label for="password">New Password:</label><br>
        <input type="password" id="password" name="password" placeholder="Leave blank to keep current password"><br><br>

        <label for="cpassword">Confirm New Password:</label><br>
        <input type="password" id="cpassword" name="cpassword" placeholder="Leave blank to keep current password"><br><br>

        <input type="submit" name="submit" value="Update">
        <a href="temp_accounts.php">cancel</a>
    </form>
</body>
</html>

    </div>