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
							<li>Setiap soal berisi 2 pernyataan, pilih salah satu pernyataan yang paling menggambarkan diri anda.</li>
							<li>Klik tombol start untuk memulai tes.</li>
						</ol></div></fieldset></div>";
	$content .= '<div class="col-md-12" id="btstart" align="center"><input type=button id="btnstart" tabindex="-1" value="Start"></div>';
	$content .= '<form action="" method="post" enctype="multipart/form-data" id="formPAPI">';
	$content .= LocalPAPIForm($UsrDef, '0');
	$content .= "</form>";
	$content .= "</div>";
	echo $content;
}
function LocalPAPIForm($UsrDef, $limit)
{	
	
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
		$content .= '<td class="col-md-11 ansrowA"><input type="radio" id="rdsoalA'.$no.'" name="rdsoal'.$no.'" value="'.$soal['tipe1'].'">&nbsp;&nbsp;'.$soal['pernyataan1'].'</td></tr>';
		$content .= '<tr><td class="col-md-11 ansrowB"><input type="radio" id="rdsoalB'.$no.'" name="rdsoal'.$no.'" value="'.$soal['tipe2'].'">&nbsp;&nbsp;'.$soal['pernyataan2'].'</td></tr>';
		$content .= '</tr>';
	}
	$content .= '</table>';
	
	$qnext = sql_query("SELECT a.no_soal, b1.pernyataan AS pernyataan1, b1.tipe AS tipe1, b2.pernyataan AS pernyataan2, b2.tipe AS tipe2
							FROM soal_papi a LEFT JOIN pernyataan b1 ON a.pernyataan_A = b1.id_pernyataan
							LEFT JOIN pernyataan b2 ON a.pernyataan_B = b2.id_pernyataan
							ORDER BY a.no_soal
							LIMIT ".$limit.",15");
	if(sql_numrows($qnext)>0)
	$content .= "<div align='center' class='col-md-6 col-md-offset-3' ><input type='button' class='button col-md-6 col-md-offset-3' id='btnNext' onclick='nextPage(\"formPAPI\",\"".$_SESSION['userid']."\",".($limit)."); return false;' value='Berikutnya' /></div>";
	$content .= "</div>";
	
	return $content;
};
?>