<?php
session_start();
include('../function/sqlfunction.php');
require("../controller/login.php");
$po=$_GET['po'];

if ($po === 'localAjLogin') {
	$pass = $_GET['pass'];
	$user = $_GET['user'];
	$sql_admin = "SELECT userid, role, regional FROM adminuser WHERE userid = '$user' AND pass = md5('$pass')";
	$rsa = sql_query($sql_admin);

	$sql_testee = "SELECT no_ktp FROM user WHERE username = '$user' AND password = md5('$pass') AND test_taken = 0";
	$rst = sql_query($sql_testee);

	if(sql_numrows($rsa)>0) {
	$ray_code = sql_fetchrow($rsa);	
		$ray_code['success'] = 'admin';
		$_SESSION['adminuser'] = $ray_code['userid'];
		$_SESSION['adminrole'] = $ray_code['role'];
		$_SESSION['adminreg'] = $ray_code['regional'];
	}else if (sql_numrows($rst)>0) {
		$ray_code = sql_fetchrow($rst);	
		sql_query("UPDATE user SET test_taken = 1, tanggal_tes = '".date("Y-m-d H:i:s")."' WHERE no_ktp = '".$ray_code['no_ktp']."'");
		$ray_code['success'] = 'testee';
		$_SESSION['userid'] = $ray_code['no_ktp'];
	}
	else $ray_code['success'] = '';
	// $ray_code['id'] = $_SESSION['adminuser'];
	echo json_encode($ray_code);
}
// $_SESSION['userid'] = 
?>