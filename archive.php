<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
} else {
    echo "Role information not found. Please contact administrator.";
    exit();
}

// Archive profiles with age > 30
$archive_profiles = "INSERT INTO profiles_archive (SELECT * FROM profiles WHERE age > 30)";

if (mysqli_query($conn, $archive_profiles)) {
    $delete_archived_profiles = "DELETE FROM profiles WHERE age > 30";
    if (!mysqli_query($conn, $delete_archived_profiles)) {
        $message = "Error deleting archived profiles: " . mysqli_error($conn);
    }
} else {
    $message = "Error archiving profiles: " . mysqli_error($conn);
}

// Move profiles with age < 30 back to profiles
$move_back_profiles = "INSERT INTO profiles (SELECT * FROM profiles_archive WHERE age < 31)";
if (mysqli_query($conn, $move_back_profiles)) {
    $delete_moved_back_profiles = "DELETE FROM profiles_archive WHERE age < 31";
    if (!mysqli_query($conn, $delete_moved_back_profiles)) {
        $message = "Error deleting moved-back profiles: " . mysqli_error($conn);
    }
} else {
    $message = "Error moving back profiles: " . mysqli_error($conn);
}

// Fetch profiles to display
$fetch_profiles = "SELECT id, fname, mname, lname, suffix, email FROM profiles_archive WHERE age > 30";
$result = mysqli_query($conn, $fetch_profiles);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Archive Profiles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="src/css.css">
    <link rel="stylesheet" type="text/css" href="src/temp.css">
    <link rel="stylesheet" type="text/css" href="src/crud.css">
</head>

<body>
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar">
        <p><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!" . "<br>"; ?>
            Logged in as: <?php echo $_SESSION['email']; ?></p>
        <a href="viewprofile.php">Profiles</a>
        <a href="homepage.php">Back</a>
        <a href="records.php">SK Reports</a>
        <a href="calendar.php">Calendar</a>
        <?php
        if ($role == 'admin') {
            echo '<a href="accounts.php">Accounts</a>';
        }
        ?>
        <?php
        if ($role == 'admin') {
            echo '<a href="createacc.php">Create Accounts</a>';
        } elseif ($role == 'employee') {
        } else {
            echo "Unknown role.";
        }
        ?>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Archive Profiles</h1>
        <p><?php echo isset($message) ? $message : ''; ?></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . ' ' . $row['suffix']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <form method="POST" action="delete_archive.php">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <a href="update_archive.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
