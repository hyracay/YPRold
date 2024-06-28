<?php
session_start();
include("conne.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql_delete = "DELETE FROM account WHERE id = '$id'";

    if(mysqli_query($conn, $sql_delete)){
        header("location: accounts.php"); // Redirect to accounts.php after successful deletion
        exit(); // Exit to prevent further execution
    } 
}
?>
