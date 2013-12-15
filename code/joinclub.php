<?php
include('./db.php');
$db = new DbUtil();
$db->connect();
$prsn = $db->getPerson($_SERVER['PHP_AUTH_USER']);
if($_GET['city'] != null and $_GET['state'] != null) {
	$res = $db->joinClub($_SERVER['PHP_AUTH_USER'], $prsn['cityName'], $prsn['state']);
	if($res){
		echo("You have now joined the alumni club for your city!");
		header( "refresh:5;url=clubs.php" );
	}
	else{
		echo("Joining of club failed or you are already a member of an alumni club. Please wait to be redirected."); 
		header( "refresh:5;url=clubs.php" );
	}
}
else {
	echo("No such club exists or you do not live in this city! Please wait to be redirected.");
	header( "refresh:5;url=clubs.php" );
}
$db->disconnect(); 

?>