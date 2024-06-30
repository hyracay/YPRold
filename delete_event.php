<?php
session_start();
include("conne.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql_delete = "DELETE FROM events WHERE id = '$id'";

    if(mysqli_query($conn, $sql_delete)){
        header("location: calendar.php");
        exit();
    } 
}
?>