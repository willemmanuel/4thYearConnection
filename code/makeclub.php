<?php
include('./db.php');
$db = new DbUtil();
$db->connect();
echo($_POST['clubName']);
echo($_POST['clubCity']);
echo($_POST['clubState']);
echo($_POST['contactNum']);
if($_POST['clubName'] != null and $_POST['contactNum'] != null) {
	$res = $db->createClub($_POST['clubName'], 
		$_POST['clubCity'], 
		$_POST['clubState'],
		$_SERVER['PHP_AUTH_USER'], 
		intval($_POST['contactNum']));

	if($res){
		header("Location: ./clubs.php");
	}
	else{
		echo("Club creation failed. Please wait to be redirected."); 
		header( "refresh:5;url=clubs.php" );
	}
}
else {
	echo("Please fill out the entire form. Please wait to be redirected.");
	header( "refresh:5;url=clubs.php" );
}
$db->disconnect(); 
?>