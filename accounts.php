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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Accounts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" type="text/css" href="src/temp.css">
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <style>
        input[type="checkbox"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border: 2px solid #ccc;
            border-radius: 4px;
            vertical-align: middle;
            position: relative;
            top: 4px;
            cursor: pointer;
        }
        input[type="checkbox"]:checked {
            background-color: #FF0000;
            border-color: #FF0000;
        }
        input[type="checkbox"]:checked::before {
            content: '\2713';
            display: block;
            text-align: center;
            line-height: 20px;
            color: white;
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
        <a href="records.php">SK Reports</a>
        <a href="calendar.php">Calendar</a>
        <?php if ($role == 'admin') { ?>
            <a href="homepage.php">Back</a>
            <a href="createacc.php">Create Accounts</a>
        <?php } elseif ($role == 'employee') { ?>
            <!-- Employee specific links can go here -->
        <?php } else { ?>
            Unknown role.
        <?php } ?>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>User Accounts</h1>
        <?php
        $sql_fetch = "SELECT * FROM account WHERE email != '$current_user_email' AND email != '$excluded_email' AND role != 'admin'";
        $sql_result = mysqli_query($conn, $sql_fetch);
        if ($sql_result && mysqli_num_rows($sql_result) > 0) {
            ?>
            <div class="section">
                <form id="profilesForm" method="POST" action="delete_multiple_acc.php">
                    <table style="margin: auto; border: 1px solid black;">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                            <th>
                                <button type="submit" class="btn btn-danger btn-delete" onclick="return confirm('Are you sure you want to delete the selected profiles?');">
                                    Delete Selected
                                </button>
                            </th>
                        </tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($sql_result)) {
                            $id = $row['id'];
                            $lname = $row['LastName'];
                            $fname = $row['FirstName'];
                            $email = $row['email'];
                            $role = $row['role'];
                            $fullName = $fname . ' ' . $lname;
                            ?>
                            <tr>
                                <td><?= $fullName; ?></td>
                                <td><?= $email; ?></td>
                                <td><?= $role; ?></td>
                                <td>
                                    <a href="update_acc.php?id=<?= $id; ?>" class="btn btn-primary">Update</a>
                                    <a href="delete_acc.php?id=<?= $id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?');">Delete</a>
                                </td>
                                <td><input type="checkbox" name="selectedProfiles[]" value="<?= $id; ?>"></td>
                            </tr>
                        <?php } ?>
                    </table>
                </form>
            </div>
        <?php } else { ?>
            <p>No accounts found.</p>
        <?php } ?>
    </div>
</body>
</html>
