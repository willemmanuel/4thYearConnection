<?php
	include('./auth.php'); 
	$db = new DbUtil();
	$db->connect();
	if($_POST['to'] != null and $_POST['message'] != null) {
		$res = $db->sendMessage($_POST['to'], $_SERVER['PHP_AUTH_USER'], $_POST['subject'], $_POST['message']);
		if($res == true)
			header("Location: ./me.php");
		else
			echo("message failed"); 
	}
	$db->disconnect(); 
?>