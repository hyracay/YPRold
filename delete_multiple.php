<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit(); // Ensure that no further code is executed after the redirection
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['selected_profiles'])) {
        $selected_profiles = $_POST['selected_profiles'];
        foreach ($selected_profiles as $id) {
            $id = intval($id); // Ensure the ID is an integer
            $sql = "DELETE FROM profiles WHERE id = $id";
            mysqli_query($conn, $sql);
        }
    }
}

header("location: viewprofile.php");
exit();
?>
