<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

// Check if 'role' is set in session
if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    // Handle the case where role is not set
    $role = 'unknown'; // Set a default value or handle the error as needed
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve existing account data
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

if (isset($_POST['update'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $role = $_POST['role'];

    // Prepare SQL statement
    $update_query = "UPDATE account SET email = '$email', FirstName = '$fname', LastName = '$lname', role = '$role' WHERE id = $id";

    $result = mysqli_query($conn, $update_query);

    if ($result) {
        header("location: homepage.php"); // Redirect to homepage after successful update
        exit();
    } else {
        echo "Update failed.";
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
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>

        <a href="homepage.php">Back</a>
        <?php
        // Display links based on user's role
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
            echo '<a href="accounts.php">Accounts</a>';
        } 
        ?>
        <a href="crud.php">Create Profile</a>
        <a href="calendar.php">Calendar</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Update Account</h3>
        <form method="POST" action="update_acc.php?id=<?= $id; ?>">
            <input type="hidden" name="id" value="<?= $account['id']; ?>">
            <table>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?= $account['email']; ?>" required></td>
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
