<?php
session_start();
include("conne.php");

// Function to delete a profile permanently
function deleteProfile($conn, $id) {
    $delete_sql = "DELETE FROM delete_profile WHERE id = '$id'";
    if (mysqli_query($conn, $delete_sql)) {
        return true;
    } else {
        return false;
    }
}

// Function to restore a profile back to the profiles table
function restoreProfile($conn, $profile_data) {
    $lname = mysqli_real_escape_string($conn, $profile_data['lname']);
    $fname = mysqli_real_escape_string($conn, $profile_data['fname']);
    $mname = mysqli_real_escape_string($conn, $profile_data['mname']);
    $suffix = mysqli_real_escape_string($conn, $profile_data['suffix']);
    $region = mysqli_real_escape_string($conn, $profile_data['region']);
    $province = mysqli_real_escape_string($conn, $profile_data['province']);
    $municipality = mysqli_real_escape_string($conn, $profile_data['municipality']);
    $barangay = mysqli_real_escape_string($conn, $profile_data['barangay']);
    $purok = mysqli_real_escape_string($conn, $profile_data['purok']);
    $sex = mysqli_real_escape_string($conn, $profile_data['sex']);
    $age = mysqli_real_escape_string($conn, $profile_data['age']);
    $email = mysqli_real_escape_string($conn, $profile_data['email']);
    $birth_month = mysqli_real_escape_string($conn, $profile_data['birth_month']);
    $birth_day = mysqli_real_escape_string($conn, $profile_data['birth_day']);
    $birth_year = mysqli_real_escape_string($conn, $profile_data['birth_year']);
    $contactnumber = mysqli_real_escape_string($conn, $profile_data['contactnumber']);
    $civil_status = mysqli_real_escape_string($conn, $profile_data['civil_status']);
    $youth_classification = mysqli_real_escape_string($conn, $profile_data['youth_classification']);
    $age_group = mysqli_real_escape_string($conn, $profile_data['age_group']);
    $work_status = mysqli_real_escape_string($conn, $profile_data['work_status']);
    $educational_background = mysqli_real_escape_string($conn, $profile_data['educational_background']);
    $register_sk_voter = mysqli_real_escape_string($conn, $profile_data['register_sk_voter']);
    $voted_last_election = mysqli_real_escape_string($conn, $profile_data['voted_last_election']);
    $attended_kk = mysqli_real_escape_string($conn, $profile_data['attended_kk']);
    $times_attended_kk = mysqli_real_escape_string($conn, $profile_data['times_attended_kk']);
    $date_created = mysqli_real_escape_string($conn, $profile_data['date_created']);

    $insert_sql = "INSERT INTO profiles (lname, fname, mname, suffix, region, province, municipality, barangay, purok,
        sex, age, email, birth_month, birth_day, birth_year, contactnumber, civil_status, youth_classification,
        age_group, work_status, educational_background, register_sk_voter, voted_last_election, attended_kk, times_attended_kk, date_created)
        VALUES 
        ('$lname', '$fname', '$mname', '$suffix', '$region', '$province', '$municipality', '$barangay', '$purok',
        '$sex', '$age', '$email', '$birth_month', '$birth_day', '$birth_year', '$contactnumber', '$civil_status', '$youth_classification',
        '$age_group', '$work_status', '$educational_background', '$register_sk_voter', '$voted_last_election', '$attended_kk', '$times_attended_kk', '$date_created')";

    if (mysqli_query($conn, $insert_sql)) {
        return true;
    } else {
        return false;
    }
}

// Handle actions if any
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = $_GET['id'];

    if ($action === 'delete') {
        // Delete profile permanently
        if (deleteProfile($conn, $id)) {
            header("location: recyclebin.php");
            exit;
        } else {
            echo "Error deleting profile.";
        }
    } elseif ($action === 'restore') {
        // Restore profile to profiles table
        $select_sql = "SELECT * FROM delete_profile WHERE id = '$id'";
        $result = mysqli_query($conn, $select_sql);
        $profile_data = mysqli_fetch_assoc($result);

        if ($profile_data) {
            if (restoreProfile($conn, $profile_data)) {
                // Delete from delete_profile after restoration
                if (deleteProfile($conn, $id)) {
                    header("location: recyclebin.php");
                    exit;
                } else {
                    echo "Error deleting from recycle bin after restoration.";
                }
            } else {
                echo "Error restoring profile.";
            }
        } else {
            echo "Profile not found in recycle bin.";
        }
    }
}

// Fetch all entries from delete_profile table
$select_sql = "SELECT * FROM delete_profile";
$result = mysqli_query($conn, $select_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

    <!-- Sidebar -->
    <div class="sidebar">
        <img src="src/avatar.png" alt="Avatar" style="width: 120px; height: 120px; border-radius: 50%; margin-bottom: 20px;">
        <p style="color: white;"><?php echo "Hello " . $_SESSION['fname'] . " " . $_SESSION['lname'] . "!<br>"; ?>
            Logged in as: <?php echo $_SESSION['email']; ?></p>

        <a href="homepage.php">Back</a>
        <a href="crud.php">Create Profile</a>
        <a href="records.php">SK Reports</a>
        <a href="calendar.php">Calendar</a>
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <a href="accounts.php">Accounts</a>
            <a href="createacc.php">Create Accounts</a>
        <?php endif; ?>
        <a href="logout.php">Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h1>Recycle Bin</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?></td>
                        <td><?php echo $row['age']; ?></td>
                        <td>
                            <a href="recyclebin.php?action=restore&id=<?php echo $row['id']; ?>" class="btn btn-success">Restore</a>
                            <a href="recyclebin.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>