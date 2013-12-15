<?php
	echo("before import");
	include('./db.php');
	echo("good import"); 
	$db = new DbUtil();
	$db->connect();
	$db->insertTransaction("test", "test", "test"); 
	$db->disconnect(); 
?>
