<?php
	// include('../config/conn.php');
include('../function/sqlfunction.php');
require("../controller/admin.php");
session_start();
$po = $_GET['po'];

if ($po === 'AJlogout') {
	session_destroy(); 
	$ray_code['success'] = 'success';
	echo json_encode($ray_code);
}
?>