<?php
	include('./db.php');
	$db = new DbUtil();
	$db->connect();
	if($_POST['firstName'] != null and $_POST['lastName'] != null) {
		$res = $db->insertTransaction($_POST['firstName'], 
									  $_POST['lastName'], 
									  $_SERVER['PHP_AUTH_USER'], 
									  $_POST['major'], 
									  $_POST['minor'], 
									  $_POST['school'], 
									  $_POST['companyName'], 
									  $_POST['city'], 
									  $_POST['state'], 
									  $_POST['position'],
									  isset($_POST['searchRoom']));
		if($res)
			header("Location: ./me.php");
		else
			echo("signup failed"); 
	}
	$db->disconnect(); 
?>