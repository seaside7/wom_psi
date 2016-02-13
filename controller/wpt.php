<?php
// include_once($_SERVER['DOCUMENT_ROOT'].'/wom_psi/function/sqlfunction.php');
function loadWPT($UsrDef){
	$content = '<div class="col-md-12" role="main">';
    $content .= '<div class="page-title">';
	$content .= '<div id="title-left" align="center" class="col-md-12"><h3>WPT</h3></div>';
	$content .= "</div>";
	$content .= '<form action="" method="post" enctype="multipart/form-data" id="formWPT">';
	$content .= LocalWPTForm($UsrDef, '0');
	$content .= "</form>";
	$content .= "</div>";
	echo $content;
}
function LocalWPTForm($UsrDef, $limit)
{	
	
	$content = '<input type="hidden" name="hduserid" id="hduserid" value="'.$_SESSION['userid'].'">';
	$content .= '<div id="content" class="col-md-6 col-md-offset-3" >';
	$content .= '<table class="table table-bordered">';
	
	$qsoal = sql_query("SELECT no_soal, question, answer, img FROM soal_wpt ORDER BY no_soal 
							LIMIT ".$limit.",10");
	while($soal = sql_fetchassoc($qsoal)){
		$no = $soal['no_soal'];
		$content .= '<tr>';
		$content .= '<td class="col-md-1" style="vertical-align:middle; text-align:center; font-weight:bold;">'.$no.'</td>';
		$content .= '<td class="col-md-9">'.$soal['question'].'</td>';
		$content .= '<td class="col-md-2"><input class="textbox" type="text" size=5 id="txtans'.$no.'"  name="txtans'.$no.'" ></td>';
		$content .= '</tr>';
	}
	$content .= '</table>';
	
	$qnext = sql_query("SELECT no_soal, question, answer, img FROM soal_wpt ORDER BY no_soal 
							LIMIT ".$limit.",10");
	// echo "SELECT no_soal, question, answer, img FROM soal_wpt ORDER BY no_soal LIMIT ".$limit.",10";
	print (sql_numrows($qnext));
	if($limit>0){
	}
	if(sql_numrows($qnext)>0){
		$content .= "<div align='center' class='col-md-3 col-md-offset-3' ><input type='button' class='button ' id='btnPrevious' onclick='previousPage(\"formWPT\",\"".$_SESSION['userid']."\",".($limit)."); return false;' value='Sebelumnya' ";
		if($limit==0){
		$content .= "disabled";
		}
		$content .= "/></div>";
		$content .= "<div align='center' class='col-md-3' ><input type='button' class='button ' id='btnNext' onclick='nextPage(\"formWPT\",\"".$_SESSION['userid']."\",".($limit)."); return false;' ";
		if($limit==40) $content .= "value='Selesai' "; else $content .= "value='Berikutnya' ";
		$content .= "/></div>";
	}
	$content .= "</div>";
	
	return $content;
};
?>