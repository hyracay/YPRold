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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['selectedProfiles']) && is_array($_POST['selectedProfiles'])) {
        foreach ($_POST['selectedProfiles'] as $profile_id) {
            // Sanitize the ID to prevent SQL injection (though not strictly needed here since it's IDs from your own database)
            $safe_profile_id = mysqli_real_escape_string($conn, $profile_id);

            // Perform deletion query
            $delete_query = "DELETE FROM account WHERE id = '$safe_profile_id'";
            $delete_result = mysqli_query($conn, $delete_query);

            if (!$delete_result) {
                echo "Error deleting profile with ID: " . $profile_id;
                // Handle error as per your requirement (logging, displaying error message, etc.)
            }
        }

        // Redirect back to the page after deletion
        header("Location: accounts.php");
        exit();
    } else {
        echo "No profiles selected for deletion.";
        // Handle case where no profiles were selected
    }
} else {
    echo "Invalid request method.";
    // Handle cases other than POST request (if any)
}
?>
