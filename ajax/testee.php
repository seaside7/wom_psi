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
	$sql_code = "SELECT COUNT(1) AS row, IFNULL(tahapan_tes,0) AS tahapan_tes, tanggal_tes FROM user WHERE no_ktp = '$id'";
	$rs = sql_query($sql_code);
	$ray_code = sql_fetchassoc($rs);	
	if($ray_code['row']>0) 
	{
		$_SESSION['userid'] = $id;
		// $tgl_tes = date('d-m-Y',$ray_code['tanggal_tes']);
		// $tgl_valid = strtotime('+2 years',$tgl_tes);
		// if(date('d-m-Y') > $tgl_valid) $ray_code['tahapan_tes'] = 6;
		// $ray_code['tanggal_valid'] = getDMYFormatDate($tgl_valid);
	}
	echo json_encode($ray_code);
}
if ($po === 'AJlogout') {
	session_destroy(); 
	$ray_code['success'] = 'success';
	echo json_encode($ray_code);
}
?>