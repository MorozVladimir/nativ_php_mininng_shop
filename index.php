<?php 

session_start();

$id='main';
if(isset($_GET['id'])){$id = $_GET['id'];}

$user = 'Гость';
if(isset($_SESSION['user'])){$user = $_SESSION['user'];}

require('cfg/config.php');
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

include('pgs/'.$id.'.php');
include('tpl/base.php');

