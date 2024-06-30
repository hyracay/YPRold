<?php
session_start();
include("conne.php");

if (!isset($_SESSION['email'])) {
    header("location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['selectedProfiles'])) {
    $selected_profiles = $_POST['selectedProfiles'];
    foreach ($selected_profiles as $id) {
        $id = intval($id);
        $sql = "DELETE FROM profiles WHERE id = $id";
        mysqli_query($conn, $sql);
    }
}

header("location: viewprofile.php");
exit();
?>