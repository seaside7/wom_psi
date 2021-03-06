<?php
// include_once($_SERVER['DOCUMENT_ROOT'].'/wom_psi/function/sqlfunction.php');
function loadPAPI($UsrDef){
	$content = '<div class="col-md-12" role="main">';
    $content .= '<div class="page-title">';
	$content .= '<div id="title-left" align="center" class="col-md-12"><h3>PAPI</h3></div>';
	$content .= "</div>";
	$content .= "<div class='col-md-6 col-md-offset-3' style='padding-bottom: 10px;' id='rules'><fieldset class=contentInfo style='margin-top:0 '>
				<center><h4>Ketentuan Pengerjaan Tes PAPI</h4></center>
						<div class='col-md-12'><ol>
							<li>Tes PAPI terdiri dari 90 soal.</li>
							<li>Setiap soal berisi 2 pernyataan, pilih salah satu pernyataan yang paling menggambarkan diri anda. Klik pada pernyataan atau lingkaran yang ingin dipilih.</li>
							<li>Jika saudara menghadapi pernyataan yang kedua-duanya tidak sesuai dengan diri pribadi saudara tetap harus dipilih salah satunya yang paling mendekati. Sebaliknya jika menemukan pernyataan yang kedua-duanya sangat menggambarkan diri anda tetap harus dipilih salah satunya.</li>
							<li>Klik tombol start untuk memulai tes.</li>
						</ol></div>
						<center><h4>Contoh Pengerjaan Tes PAPI</h4></center>
						<img class='col-md-8 col-md-offset-2' src='images/papi-guide.png' style='padding-bottom: 10px;'/>
						</fieldset></div>";
	$content .= '<div class="col-md-12" id="btstart" align="center"><input type=button id="btnstart" tabindex="-1" value="Start"></div>';
	$content .= '<form action="" method="post" enctype="multipart/form-data" id="formPAPI">';
	$content .= LocalPAPIForm($UsrDef, '0');
	$content .= "</form>";
	$content .= "</div>";
	echo $content;
}
function LocalPAPIForm($UsrDef, $limit)
{	
	// print_r($_SESSION);
	$content = '<input type="hidden" name="hduserid" id="hduserid" value="'.$_SESSION['userid'].'">';
	$content .= '<div id="content" class="col-md-6 col-md-offset-3" role="main">';
	$content .= '<table class="table table-bordered" id="tablePAPI">';
	
	$qsoal = sql_query("SELECT a.no_soal, b1.pernyataan AS pernyataan1, b1.tipe AS tipe1, b2.pernyataan AS pernyataan2, b2.tipe AS tipe2
							FROM soal_papi a LEFT JOIN pernyataan b1 ON a.pernyataan_A = b1.id_pernyataan
							LEFT JOIN pernyataan b2 ON a.pernyataan_B = b2.id_pernyataan
							ORDER BY a.no_soal
							LIMIT ".$limit.",15");
	while($soal = sql_fetchassoc($qsoal)){
		$no = $soal['no_soal'];
		$content .= '<tr>';
		$content .= '<td rowspan="2" class="col-md-1" style="vertical-align:middle; text-align:center; font-weight:bold;">'.$no.'</td>';
		$content .= '<td class="col-md-11 ansrowA"><input type="radio" id="rdsoalA'.$no.'" name="rdsoal'.$no.'" value="'.$soal['tipe1'].'" ';
		if(isset($_SESSION['anspapi'][$no])){
			$content .= chsel($soal['tipe1'], $_SESSION['anspapi'][$no]);
		}
		$content .= '>&nbsp;&nbsp;'.$soal['pernyataan1'].'</td></tr>';
		$content .= '<tr><td class="col-md-11 ansrowB"><input type="radio" id="rdsoalB'.$no.'" name="rdsoal'.$no.'" value="'.$soal['tipe2'].'" ';
		if(isset($_SESSION['anspapi'][$no])){
			$content .= chsel($soal['tipe2'], $_SESSION['anspapi'][$no]);
		}
		$content .= '>&nbsp;&nbsp;'.$soal['pernyataan2'].'</td></tr>';
		$content .= '</tr>';
	}
	$content .= '</table>';
	
	// $content .= "<div align='center' class='col-md-6 col-md-offset-3' ><input type='button' class='button col-md-6 col-md-offset-3' id='btnNext' onclick='nextPage(\"formPAPI\",\"".$_SESSION['userid']."\",".($limit)."); return false;' value='Berikutnya' /></div>";
	
	$content .= "<div align='center' class='col-md-3 col-md-offset-3' ><input type='button' class='button ' id='btnPrevious' onclick='previousPage(\"formPAPI\",\"".$_SESSION['userid']."\",".($limit)."); return false;' value='Sebelumnya' ";
	if($limit==0){
	$content .= "disabled";
	}
	$content .= "/></div>";
	$content .= "<div align='center' class='col-md-3' ><input type='button' class='button ' id='btnNext' onclick='nextPage(\"formPAPI\",\"".$_SESSION['userid']."\",".($limit)."); return false;' ";
	if($limit==75) $content .= "value='Selesai' "; else $content .= "value='Berikutnya' ";
	$content .= "/></div>";
	
	$content .= "</div>";
	
	return $content;
}
function chsel($val,$inp)
  {	$ya='';
	if($val==$inp) {  $ya='checked'; }
  	else $ya=='';
	return $ya;
  }
?>