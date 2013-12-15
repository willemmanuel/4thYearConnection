<?php
	include('./auth.php'); 
	$db = new DbUtil();
	$db->connect();
	$db->exportJson(); 
	$db->disconnect(); 
?>