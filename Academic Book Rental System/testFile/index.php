<?php
session_start();
$_SESSION['cart']=array();

$_SESSION['cart']=array(array("product"=>"apple","quantity"=>2),
array("product"=>"Orange","quantity"=>4),
array("product"=>"Banana","quantity"=>5),
array("product"=>"Mango","quantity"=>7),
);

foreach ($_SESSION['cart'] as $item){
	echo $item['product'].$item['quantity'];
}
?>
