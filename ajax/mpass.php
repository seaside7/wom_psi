<?php
session_start();
include('../function/sqlfunction.php');
require("../controller/mpass.php");
$po=$_GET['po'];


if ($po === 'localAjMpass') {
	$user = $_GET['user'];
	$pass = $_GET['pass'];
	$qMpass = "UPDATE adminuser SET pass=md5('$pass') WHERE userid='$user'";
	if(sql_query($qMpass)) $ray_code['success'] = 'success';
	echo json_encode($ray_code);
}
if ($po === 'AJlogout') {
	session_destroy(); 
	$ray_code['success'] = 'success';
	echo json_encode($ray_code);
}
?>