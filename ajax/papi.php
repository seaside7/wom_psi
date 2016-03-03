<?php
	// include('../config/conn.php');
	session_start();
require("../controller/papi.php");
	include('../function/sqlfunction.php');
$po   = $_GET['po'];
if($po=="nextPage" || $po=="previousPage") {
	
	$limit = $_GET['limit'];
	for($x=$limit+1;$x<=$limit+15;$x++){
		$_SESSION['anspapi'][$x] = $_GET['rdsoal'.$x];
		
	}
	
	if($po=="nextPage") {$limit = $_GET['limit'] + 15;}
	else if($po=="previousPage") {$limit = $_GET['limit'] - 15;}
	echo LocalPAPIForm($_GET['id'],$limit);
}
if($po=="saveHasilPAPI") {
	$ans='';
	$limit = $_GET['limit'];
	for($x=$limit+1;$x<=$limit+15;$x++){
		$_SESSION['anspapi'][$x] = $_GET['rdsoal'.$x];
	}
	
	for($no=1;$no<=90;$no++){
		$ans .=  $_SESSION['anspapi'][$no];
	}
	//$ans = $_GET['ans'];
	$id = $_GET['id'];
	$G = substr_count($ans, 'G');
	$L = substr_count($ans, 'L');
	$I = substr_count($ans, 'I');
	$T = substr_count($ans, 'T');
	$V = substr_count($ans, 'V');
	$S = substr_count($ans, 'S');
	$R = substr_count($ans, 'R');
	$D = substr_count($ans, 'D');
	$C = substr_count($ans, 'C');
	$E = substr_count($ans, 'E');
	$N = substr_count($ans, 'N');
	$A = substr_count($ans, 'A');
	$P = substr_count($ans, 'P');
	$X = substr_count($ans, 'X');
	$B = substr_count($ans, 'B');
	$O = substr_count($ans, 'O');
	$Z = substr_count($ans, 'Z');
	$K = substr_count($ans, 'K');
	$F = substr_count($ans, 'F');
	$W = substr_count($ans, 'W');
	
	$qInsert = "INSERT INTO `wom_psi`.`hasil_papi` 
	(`userid`, 
	`G`, `L`, `I`, `T`, `V`, `S`, `R`, `D`, `C`, `E`, 
	`N`, `A`, `P`, `X`, `B`, `O`, `Z`, `K`, `F`, `W`
	)
	VALUES
	('$id', 
	'$G', '$L', '$I', '$T', '$V', '$S', '$R', '$D', '$C', '$E', 
	'$N', '$A', '$P', '$X', '$B', '$O', '$Z', '$K', '$F', '$W'
	);";
	echo $qInsert;
	sql_query($qInsert);
	unset($_SESSION['anspapi']);
	sql_query("UPDATE user SET tahapan_tes = '3' WHERE no_ktp = '".$id."'");
	return true;
	
}
?>