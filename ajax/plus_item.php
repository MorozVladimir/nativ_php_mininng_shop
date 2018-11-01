<?php
	
	session_start();
	$gid = $_GET['gid'];

	require('../cfg/config.php');
	date_default_timezone_set('Europe/Kiev');
	$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


	$user = $_SESSION['user'];
	$query = "SELECT id FROM users WHERE login = '$user'";
	$res = $connection->query($query);
	$uid = $res->fetch_assoc()['id'];

	//
	$query1 = "SELECT id FROM orders WHERE user_id = $uid AND goods_id = $gid";
	$res1 = $connection->query($query1);
	$oid = $res1->fetch_assoc()['id'];

	$num = 1;
	$status = 'norm';
	$order_date = date('Y-m-d H:i:s');

	$query2 = "INSERT INTO orders (user_id, goods_id, num, order_date, status) VALUES($uid, $gid, $num, '$order_date', '$status')";
	$connection->query($query2);

	echo('ok');
?>