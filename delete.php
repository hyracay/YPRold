<?php
session_start();
include("conne.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM profiles WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        header("location: viewprofile.php");
    } 
}
?>