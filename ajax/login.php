<?php
session_start();
include('../function/sqlfunction.php');
require("../controller/login.php");
$po=$_GET['po'];

if ($po === 'localAjLogin') {
	$pass = $_GET['pass'];
	$user = $_GET['user'];
	$sql_code = "SELECT userid, role, regional FROM adminuser WHERE userid = '$user' AND pass = md5('$pass')";
	 // echo $sql_code; 
	$rs = sql_query($sql_code);
	$ray_code = sql_fetchrow($rs);	
	if(sql_numrows($rs)>0) {
		$ray_code['success'] = 'success';
		$_SESSION['adminuser'] = $ray_code['userid'];
		$_SESSION['adminrole'] = $ray_code['role'];
		$_SESSION['adminreg'] = $ray_code['regional'];
	}else $ray_code['success'] = '';
	// $ray_code['id'] = $_SESSION['adminuser'];
	echo json_encode($ray_code);
}

?>