<?php
	// include('../config/conn.php');
	include('../function/sqlfunction.php');

	$data = $_POST;
	$userid = $data['hduserid'];
	$dateNow = date("Y-m-d H:i:s");
	for($i=1; $i<=$data['hdmaxX'];  $i++){
		 $sql = sql_query("INSERT INTO tinggi VALUES ('".$userid."', '$i', '".$data['hdtinggi_'.$i]."')");
		for($j=1; $j<=$data['hdtinggi_'.$i];  $j++){
			if($data['hdstatus_'.$i.'_'.$j]==1 || $data['hdcounter_'.$i.'_'.$j]==1) {
				// echo "s";
				sql_query("INSERT INTO salah VALUES ('".$userid."', '$i', '$j', '".$data['hdinput_'.$i.'_'.$j]."', '".$data['hdcounter_'.$i.'_'.$j]."', '".$data['hdstatus_'.$i.'_'.$j]."')");
			}
		}
	}
	return true;
	// echo "<pre>";
	// print_r ($_POST);
	// echo "</pre>";
?>