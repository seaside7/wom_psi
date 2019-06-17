<?php
session_start();
include('../function/sqlfunction.php');
require("../controller/testee.php");
$po=$_GET['po'];

if($po=="localAjSaveDetail"){	echo localSaveDetail(); }
if($po=="localAjEditDetail"){	echo localEditDetail(); }
if ($po === 'localAjLogin') {
	$pass = $_GET['pass'];
	$sql_code = "SELECT COUNT(1) AS row FROM admin WHERE pass = md5('$pass')";
	// echo $sql_code; 
	$rs = sql_query($sql_code);
	$ray_code = sql_fetchassoc($rs);	
	if($ray_code['row']>0) $_SESSION['adminuser'] = 'admin';
	$ray_code['id'] = $_SESSION['adminuser'];
	echo json_encode($ray_code);
}
if ($po === 'localAjGetRowDetail') { //echo $_GET['id'];
	$id = $_GET['id'];
	$uname = $_GET['uname'];
	$sql_code = "SELECT COUNT(1) AS row, test_taken, tanggal_tes FROM user WHERE no_ktp = '$id'";
	$rs = sql_query($sql_code);
	$ray_code = sql_fetchassoc($rs);
	list($unameExist) = sql_fetchrow(sql_query("SELECT COUNT(1) AS uname FROM user WHERE username = '$uname'"));
	$ray_code['unameExist'] = $unameExist;
	echo json_encode($ray_code);
}
if ($po === 'AJlogout') {
	session_destroy(); 
	$ray_code['success'] = 'success';
	echo json_encode($ray_code);
}
?>