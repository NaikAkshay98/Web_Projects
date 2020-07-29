<?php
include('connect.php');
session_start();
//$loginst = 0;
if ($_SESSION['name']){ 

$user_check = $_SESSION['name'];

$ses_sql = mysqli_query($con,"SELECT name FROM tbl_registered_users WHERE name='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_user=$row['name'];

if(!empty($login_user)) 
{
   $loginst = 1;
}

}

?>