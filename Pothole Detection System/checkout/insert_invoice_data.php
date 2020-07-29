<?php
if (session_id() == ""){
	session_start();
}
include("../php/connect.php"); error_reporting(1);

$query="INSERT INTO tbl_invoice_address VALUES ('{$_SESSION['id']}','{$_SESSION['inputAddress']}','{$_SESSION['inputAddress2']}','{$_SESSION['inputCity']}','{$_SESSION['inputState']}','{$_SESSION['inputZip']}','{$_SESSION['inputNo']}')";
$data=mysqli_query($con,$query);

$query="INSERT INTO tbl_invoive_date VALUES ('{$_SESSION['id']}','{$_SESSION['checkoutType']}','{$_SESSION['invoice_no']}','{$_SESSION['date_time']}','Created')";
$data=mysqli_query($con,$query);
/*
if($_SESSION["checkoutType"]=="new"){
	$x="cart_item";
}else{
	$x="Returncart_item";	
}
*/
foreach ($_SESSION["cart_item"] as $item){
		//$item_price = $item["quantity"]*$item["price"];
		
		if($item["quantity"]==1){
			$query="INSERT INTO tbl_invoice_description VALUES ('','{$_SESSION['id']}','{$_SESSION['checkoutType']}','{$_SESSION['invoice_no']}','{$item['name']}','{$item['quantity']}','{$item['price']}')";
			$data=mysqli_query($con,$query);
		}else{
			for ($x = 1; $x <= $item["quantity"]; $x++) {
				$query="INSERT INTO tbl_invoice_description VALUES ('','{$_SESSION['id']}','{$_SESSION['checkoutType']}','{$_SESSION['invoice_no']}','{$item['name']}','1','{$item['price']}')";
				$data=mysqli_query($con,$query);
			}
		}
}
if($_SESSION["checkoutType"]=="return"){
	foreach($_SESSION["pid"] as $item){
		//echo $item['p_id'];
		$query="UPDATE tbl_invoice_description SET type='return' WHERE p_id={$item['p_id']}";
		$data=mysqli_query($con,$query);
	}
}

$query="INSERT INTO tbl_invoice_total VALUES ('{$_SESSION['invoice_no']}','{$_SESSION['checkoutType']}','{$_SESSION['shipment_taxes']}','{$_SESSION['total_price']}','{$_SESSION['discount']}','{$_SESSION['payable_amt']}')";
$data=mysqli_query($con,$query);

if($_SESSION["checkoutType"]=="new"){
	foreach ($_SESSION["cart_item"] as $item){
		$item_price = $item["quantity"]*$item["price"];
			$query="INSERT INTO tbl_neworder VALUES ('{$_SESSION['id']}','{$_SESSION['checkoutType']}','{$_SESSION['invoice_no']}','{$item['name']}','{$item['quantity']}','{$item_price}')";
			$data=mysqli_query($con,$query);
			
	}
}else{
	foreach ($_SESSION["Returncart_item"] as $item){
		$item_price = $item["quantity"]*$item["price"];
			$query="INSERT INTO tbl_returnorder VALUES ('{$_SESSION['id']}','{$_SESSION['checkoutType']}','{$_SESSION['invoice_no']}','{$item['name']}','{$item['quantity']}','{$item_price}')";
			$data=mysqli_query($con,$query);
			
	}
}

header('location:billing.php');
?>