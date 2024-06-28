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
    echo "Role information not found. Please contact administrator.";
    exit();
}

// Get logged-in user's email
$current_user_email = $_SESSION['email'];

// Define excluded email (or any other criteria)
$excluded_email = 'admin@ph';

// Query to fetch accounts excluding certain criteria
$sql_fetch = "SELECT * FROM account WHERE email != '$current_user_email' AND email != '$excluded_email'";
$sql_result = mysqli_query($conn, $sql_fetch);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOMEPAGE</title>
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <link rel="stylesheet" type="text/css" href="src/css.css">
    <link rel="stylesheet" type="text/css" href="src/temp.css">

    
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
           Logged in as: <?php echo $_SESSION['email']; ?></p>
       
        <a href="viewprofile.php">Profiles</a>
        <?php
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        } elseif ($role == 'employee') {
            // For employees, you can customize what to display or leave it empty
        } else {
            echo "Unknown role.";
        }
        ?>
        <a href="crud.php">Create Profile</a>
        <a href="homepage.php">Back</a>
        
        <a href="calendar.php">Calendar</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h3>Welcome to the Homepage</h3>
        <table style="margin: auto;" border="1">
            <tr>
                <td>Email</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Role</td>
                <td colspan="2">Change</td>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($sql_result)) {
                ?>
                <tr>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['FirstName']; ?></td>
                    <td><?php echo $row['LastName']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td>
                    <a href="update_acc.php?id=<?= $row['id']; ?>" class="btn btn-primary">Update</a>
                    <a href="delete_acc.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?');">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>

</body>
</html>
