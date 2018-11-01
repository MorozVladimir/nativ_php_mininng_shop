<?php
	
	session_start();

	require('../cfg/config.php');
	date_default_timezone_set('Europe/Kiev');
	$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


	$user = $_SESSION['user'];
	$query = "SELECT id FROM users WHERE login = '$user'";
	$res = $connection->query($query);
	$uid = $res->fetch_assoc()['id'];

	$query1 = "UPDATE orders SET status='executed' WHERE user_id = $uid";
	$connection->query($query1);


	echo($uid);
?>