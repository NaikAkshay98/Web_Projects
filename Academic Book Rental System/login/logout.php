<?php
if (session_id() == ""){
	session_start();
}
if (isset($_SESSION['name'])) {
    unset($_SESSION['name']);
}

session_destroy();
header('location:../index.php');
?>