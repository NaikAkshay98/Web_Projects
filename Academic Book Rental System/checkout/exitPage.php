<?php
if (session_id() == ""){
	session_start();
}

if($_SESSION["checkoutType"]=="new"){
	unset($_SESSION["cart_item"]);
}else{
	unset($_SESSION["Returncart_item"]);
	unset($_SESSION["pid"]);
}

header('location:../index.php');
?>