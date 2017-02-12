<?php
	// include('../config/conn.php');
include('../function/sqlfunction.php');
require("../controller/admin.php");
session_start();
$po = $_GET['po'];

if ($po === 'localAjLogin') {
	$pass = $_GET['pass'];
	$sql_code = "SELECT COUNT(1) AS row FROM admin WHERE pass = md5('$pass')";
	// echo $sql_code; 
	$rs = sql_query($sql_code);
	$ray_code = sql_fetchassoc($rs);	
	if($ray_code['row']>0) $_SESSION['userid'] = 'admin';
	$ray_code['id'] = $_SESSION['userid'];
	echo json_encode($ray_code);
}
if ($po === 'AJlogout') {
	session_destroy(); 
	$ray_code['success'] = 'success';
	echo json_encode($ray_code);
}
?>