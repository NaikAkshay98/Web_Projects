<?php
if (session_id() == ""){
	session_start();
}
//var_dump($_SESSION["pid"]);
foreach($_SESSION["pid"] as $item){
	echo $item['p_id'];
}

?>