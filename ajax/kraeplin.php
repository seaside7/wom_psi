<?php
	// include('../config/conn.php');
	include('../function/sqlfunction.php');

	$data = $_POST;
	$userid = $data['hduserid'];
	$dateNow = date("Y-m-d H:i:s");
	// $tinggi = [];
	// echo "AAAAAAAAAAAAAAAAAAAAA";
	// echo json_encode($data);
	for($i=1; $i<=$data['hdmaxX'];  $i++){
		// $tinggi[] = $data['hdtinggi_'.$i];
		// echo "INSERT INTO tinggi VALUES ('".$userid."', $i, ".$data['hdtinggi_'.$i].")";
		sql_query("INSERT INTO tinggi VALUES ('".$userid."', $i, ".$data['hdtinggi_'.$i].")");
		for($j=1; $j<=$data['hdtinggi_'.$i];  $j++){
			if($data['hdstatus_'.$i.'_'.$j]==1 || $data['hdcounter_'.$i.'_'.$j]==1) {
				// echo "s";
				sql_query("INSERT INTO salah VALUES ('".$userid."', '$i', '$j', '".$data['hdinput_'.$i.'_'.$j]."', '".$data['hdcounter_'.$i.'_'.$j]."', '".$data['hdstatus_'.$i.'_'.$j]."')");
			}
		}
	}
	sql_query("UPDATE user SET tahapan_tes = '5' WHERE no_ktp = '".$userid."'");
	// echo "<pre>";
	// print_r ($tinggi);
	// echo "</pre>";
	return true;
?>