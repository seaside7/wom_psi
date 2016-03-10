<?php
	// include('../config/conn.php');
	session_start();
require("../controller/wpt.php");
	include('../function/sqlfunction.php');
$po   = $_GET['po'];
if($po=="nextPage" || $po=="previousPage" || $po=="saveHasilWPT") {
	$limit = $_GET['limit'];
	$benar = 0;
	for($x=$limit+1;$x<=$limit+10;$x++){
		$_SESSION['ans'][$x] = $_GET['txtans'.$x];
		if($_GET['hdmulti_'.$x]){

			$ans = explode(',', $_GET['hdans_'.$x]);
			$user_ans = explode(',', $_GET['txtans'.$x]);
			// echo count(array_diff($ans, $user_ans));
			if(count(array_diff($ans, $user_ans))==0){
				$benar = $benar + 1;
			}
		}else{
			if(str_replace(' ','',strtolower($_GET['txtans'.$x])) == str_replace(' ','',strtolower($_GET['hdans_'.$x]))){
				$benar = $benar + 1;
			}
		}
		
	}
	$_SESSION['benar'][$limit]=$benar;
	// print_r($_SESSION);
	if($po=="previousPage") {
		$limit = $_GET['limit'] - 10;
		echo LocalWPTForm($_GET['id'],$limit);
	}else if($po=="nextPage") {
		$limit = $_GET['limit'] + 10;
		echo LocalWPTForm($_GET['id'],$limit);
	}else if($po=="saveHasilWPT") {
		$totalbenar = 0;
		for($y=0;$y<=40;$y+=10){
			$totalbenar = $totalbenar + $_SESSION['benar'][$y];
		}
		
		
		list($usia) = sql_fetchrow(sql_query("SELECT usia FROM user WHERE no_ktp = '".$id."'"));
		if($usia > 40) $totalbenar = $totalbenar + 2;
		else if($usia > 30) $totalbenar = $totalbenar + 1;
			
		
		list($wpt_iq) = sql_fetchrow(sql_query("SELECT wpt_iq FROM wpt_mapping WHERE wpt_skor = '".$totalbenar."'"));
		sql_query("INSERT INTO `wom_psi`.`hasil_wpt` 
					(`userid`, 
					`wpt_skor`, 
					`wpt_iq`
					)
					VALUES
					('".$_GET['id']."', 
					'".$totalbenar."', 
					'".$wpt_iq."'
					);");
		unset($_SESSION['ans']);
		unset($_SESSION['benar']);
		sql_query("UPDATE user SET tahapan_tes = '5' WHERE no_ktp = '".$id."'");
		echo $totalbenar;
	}
	
}

?>