<?php
	// include('../config/conn.php');
	session_start();
require("../controller/disc.php");
	include('../function/sqlfunction.php');
$po   = $_GET['po'];
if($po=="saveHasilDISC") {
	$id = $_GET['id'];
	$qSaveDisc = "INSERT INTO `wom_psi`.`hasil_disc` 
				(`userid`, 
				`DM`,`DL`, `IM`, `IL`, 
				`SM`, `SL`, `CM`, `CL`
				)
				VALUES
				('".$id."', 
				'".$_GET['DM']."', '".$_GET['DL']."', '".$_GET['IM']."', '".$_GET['IL']."', 
				'".$_GET['SM']."', '".$_GET['SL']."', '".$_GET['CM']."', '".$_GET['CL']."'
				);";
	if(sql_query($qSaveDisc)){
		sql_query("UPDATE user SET tahapan_tes = '5' WHERE no_ktp = '".$id."'");
		echo "0";
	}
	else echo "1";
	
	
}

?>