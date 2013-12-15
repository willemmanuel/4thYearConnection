<?php
include('./db.php');
$db = new DbUtil();
$db->connect();
if($db->registered($_SERVER['PHP_AUTH_USER']) != 1) {
	header("Location: ../index.php");
 	die();
}
$db->disconnect(); 
?>