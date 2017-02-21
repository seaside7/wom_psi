<?php
// include_once($_SERVER['DOCUMENT_ROOT'].'/wom_psi/function/sqlfunction.php');
function loadDISC($UsrDef){
	$content = '<div class="col-md-12" role="main">';
    $content .= '<div class="page-title">';
	$content .= '<div id="title-left" align="center" class="col-md-12"><h3>DISC</h3></div>';
	$content .= "</div>";
	$content .= "<div class='col-md-6 col-md-offset-3' style='padding-bottom: 10px;' id='rules'><fieldset class=contentInfo style='margin-top:0 '>
				<center><h4>Ketentuan Pengerjaan Tes DISC</h4></center>
						<div class='col-md-12'><ol>
							<li>Posisikan diri Anda dalam situasi pekerjaan Anda saat ini (dalam jabatan Anda saat ini).</li>
							<li>Kerjakan baris demi baris.</li>
							<li>Dari setiap baris, pilih satu kata / pernyataan yang PALING SESUAI dengan diri Anda dalam situasi kerja dan tulislah \"M\" pada kotak di belakang kata / pernyataan tersebut.</li>
							<li>Dari setiap baris, pilih satu kata / pernyataan yang PALING TIDAK SESUAI dengan diri Anda dalam situasi kerja dan tulislah \"L\" pada kotak di belakang kata / pernyataan tersebut.</li>
							<li>Setiap baris yang diisi harus mengandung satu M dan satu L.</li>
							<li>Bersikaplah spontan karena pemikiran pertama biasanya lebih tepat.</li>
							<li>Inventori ini sebaiknya diisi dalam jangka waktu 7-10 menit, tanpa interupsi dan sebaiknya dalam situasi tenang.</li>
							<li>Jadi dalam setiap lajur hanya ada satu M dan satu L, dua kotak lainnya kosong.</li>
							<li>Klik tombol start untuk memulai tes.</li>
						</ol></div>
						<img class='col-md-12' src='images/disc-guide-benar.png' style='padding-bottom: 10px;'/>
						<img class='col-md-12' src='images/disc-guide-salah.png' style='padding-bottom: 10px;'/>
						</fieldset></div>";
	$content .= '<div class="col-md-12" id="btstart" align="center"><input type=button id="btnstart" tabindex="-1" value="Start"></div>';
	$content .= '<form action="" method="post" enctype="multipart/form-data" id="formDISC" name="formDISC">';
	$content .= LocalDISCForm($UsrDef, '0');
	$content .= "</form>";
	$content .= "</div>";
	echo $content;
}
function LocalDISCForm($UsrDef, $limit)
{	
	
	$content = '<input type="hidden" name="hduserid" id="hduserid" value="'.$_SESSION['userid'].'">';
	$content .= '<div id="content" class="col-md-12 " >';
	$content .= '<div id="tableDISC" class="col-md-12" >';
	
	
	$qsoal = sql_query("SELECT DISTINCT no_soal FROM soal_disc ORDER BY no_soal ");
	while($soal = sql_fetchassoc($qsoal)){
		$no = $soal['no_soal'];
		$content .= '<table class="table table-bordered" id="tableDISC_'.$no.'">';
		$content .= '<tr>';
		$content .= '<td style="text-align:center; vertical-align:middle;">'.$no.'</td>';
		
		$qpernyataan = sql_query("SELECT sequence, pernyataan, komponen, tipe FROM soal_disc WHERE no_soal = '$no' ORDER BY sequence ");
		while($pernyataan = sql_fetchassoc($qpernyataan)){
			
			//#FFFFE8
			$content .= '<td class="col-md-3"><input class="textbox inputdisc" type="text" size=35 disabled value="'.$pernyataan['pernyataan'] .'">&nbsp;';
			$content .= '<input class="textbox " type="text" size=1 maxlength="1" data-komponen="'.$pernyataan['komponen'].'" data-tipe="'.$pernyataan['tipe'].'" id="txtans_'.$no.'_'.$pernyataan['sequence'].'"  name="txtans_'.$no.'_'.$pernyataan['sequence'].'" style="text-align:center; height:32px; font-size:13px !important;text-transform:uppercase;"  onkeypress="return isMorL(event)" >';
			
			
		}
		$content .= '</tr>';
		$content .= '</table>';
		/*$content .= "<input type=hidden name='hdans_".$no."' id='hdans_".$no."' value='".$soal['answer']."'>";
		$content .= "<input type=hidden name='hdmulti_".$no."' id='hdmulti_".$no."' value='".$soal['multi_ans']."'>";
		$content .= "<input type=hidden name='hdstatus_".$no."' id='hdstatus_".$no."' value='0'></td>";*/
		
		
	}
	$content .= '</div>';
	
	
	
		$content .= "<div align='center' class='col-md-4 col-md-offset-4' ><input type='button' class='button ' id='btnSave' value='Simpan'/></div>";
	
	$content .= "</div>";
	
	return $content;
};
?>