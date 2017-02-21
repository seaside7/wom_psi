<?php
// include_once($_SERVER['DOCUMENT_ROOT'].'/wom_psi/function/sqlfunction.php');
function loadWPT($UsrDef){
	$content = '<div class="col-md-12" role="main">';
    $content .= '<div class="page-title">';
	$content .= '<div id="title-left" align="center" class="col-md-12"><h3>WPT</h3></div>';
	$content .= "</div>";
	$content .= "<div class='col-md-6 col-md-offset-3' style='padding-bottom: 10px;' id='rules'><fieldset class=contentInfo style='margin-top:0 '>
				<center><h4>Ketentuan Pengerjaan Tes WPT</h4></center>
						<div class='col-md-12'><ol>
							<li>Tes WPT terdiri dari 50 soal.</li>
							<li>Tuliskan jawaban setiap pertanyaan pada kotak yang telah disediakan.</li>
							<li>Bila menemukan soal dengan lebih dari satu jawaban, maka setiap jawaban dipisahkan dengan tanda koma (,).</li>
							<li>Bila menemukan soal dengan jawaban pilihan huruf, cukup menjawab dengan mengetik hurufnya saja.</li>
							<li>Waktu pengerjaan tes dibatasi 12 menit.</li>
							<li>Dilarang menggunakan alat bantu hitung.</li>
							<li>Klik tombol start untuk memulai tes.</li>
						</ol></div>
						<center><h4>Contoh Pengerjaan Tes WPT</h4></center>
						<img class='col-md-8 col-md-offset-2' src='images/wpt-guide.png' style='padding-bottom: 10px;'/>
						</fieldset></div>";
	$content .= '<div class="col-md-12" id="btstart" align="center"><input type=button id="btnstart" tabindex="-1" value="Start"></div>';
	$content .= '<form action="" method="post" enctype="multipart/form-data" id="formWPT" name="formWPT">';
	$content .= LocalWPTForm($UsrDef, '0');
	$content .= "</form>";
	$content .= "</div>";
	echo $content;
}
function LocalWPTForm($UsrDef, $limit)
{	
	
	$content = '<input type="hidden" name="hduserid" id="hduserid" value="'.$_SESSION['userid'].'">';
	$content .= '<div id="content" class="col-md-6 col-md-offset-3" >';
	$content .= '<table class="table table-bordered" id="tableWPT">';
	
	$qsoal = sql_query("SELECT no_soal, question, answer, multi_ans, img FROM soal_wpt ORDER BY no_soal 
							LIMIT ".$limit.",10");
	while($soal = sql_fetchassoc($qsoal)){
		$no = $soal['no_soal'];
		$content .= '<tr>';
		$content .= '<td class="col-md-1" style="vertical-align:middle; text-align:center; font-weight:bold;">'.$no.'</td>';
		$content .= '<td class="col-md-9">'.$soal['question'];
		if($soal['img']=='1'){
			$content .= '<br /><img src="images/'.$no.'.png">';
		}
		$content .= '</td>';
		$content .= '<td class="col-md-2"><input class="textbox" type="text" size=5 id="txtans'.$no.'"  name="txtans'.$no.'" ';
		if(isset($_SESSION['ans'][$no])){
			$content .= 'value="'.$_SESSION['ans'][$no].'"';
		}
		$content .= '>';
		$content .= "<input type=hidden name='hdans_".$no."' id='hdans_".$no."' value='".$soal['answer']."'>";
		$content .= "<input type=hidden name='hdmulti_".$no."' id='hdmulti_".$no."' value='".$soal['multi_ans']."'>";
		$content .= "<input type=hidden name='hdstatus_".$no."' id='hdstatus_".$no."' value='0'></td>";
		$content .= '</tr>';
	}
	$content .= '</table>';
	
	
	$content .= "<div align='center' class='col-md-3 col-md-offset-3' ><input type='button' class='button ' id='btnPrevious' onclick='previousPage(\"formWPT\",\"".$_SESSION['userid']."\",".($limit)."); return false;' value='Sebelumnya' ";
	if($limit==0){
	$content .= "disabled";
	}
	$content .= "/></div>";
	$content .= "<div align='center' class='col-md-3' ><input type='button' class='button ' id='btnNext' onclick='nextPage(\"formWPT\",\"".$_SESSION['userid']."\",".($limit)."); return false;' ";
	if($limit==40) $content .= "value='Selesai' "; else $content .= "value='Berikutnya' ";
	$content .= "/></div>";
	
	$content .= "</div>";
	
	return $content;
};
?>