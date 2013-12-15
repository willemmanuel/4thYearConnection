<?php
	echo("Before include.");
	include('./db.php');
	echo("After include.");
	$db = new DbUtil();
	$db->connect();
	#$test = isset($_POST['searchRoom']);
	#echo($test);
	if($_POST['firstName'] != null and $_POST['lastName'] != null) {
		$res = $db->updateTransaction($_POST['firstName'], 
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
		if($res){
			echo("Profile updated successfully.");
			header('Location: ../protected/profile_update.php');
		}
		else{
		echo("Profile update failed."); 
		echo(isset($_POST['searchRoom']));
 }
}
  $db->disconnect();
  ?>