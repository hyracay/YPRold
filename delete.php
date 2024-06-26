<?php
session_start();
include("conne.php");

// Check if ID is provided in URL parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare DELETE statement
    $sql = "DELETE FROM profiles WHERE id = '$id'";

    // Execute DELETE query
    if (mysqli_query($conn, $sql)) {
        // Redirect to CRUD page after successful deletion
        header("location: viewprofile.php");
    } 
}
?>