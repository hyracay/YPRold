<?php
	session_start();
	session_unset();
	session_destroy();
	header("location: temp_index.php")
?>