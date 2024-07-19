<?php
include("../connection/conne.php");
if (!isset($_SESSION['SUPERADMIN'])) {
    header("location:../index.php");
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql_delete = "DELETE FROM account WHERE id = '$id'";

    if(mysqli_query($conn, $sql_delete)){
        header("location: accounts.php");
        exit();
    } 
}