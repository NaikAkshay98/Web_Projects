<?php 
$con=mysqli_connect('localhost','root','','potholedataset');
if (mysqli_connect_errno()) {
	# code...
	echo "Could not connect to MYSQL database".mysqli_connect_error();
}
 ?>