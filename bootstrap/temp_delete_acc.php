<?php
include("../conne.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql_delete = "DELETE FROM account WHERE id = '$id'";

    if(mysqli_query($conn, $sql_delete)){
        header("location: temp_accounts.php");
        exit();
    } 
}