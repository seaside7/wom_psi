<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/wom_psi/config/conn.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/wom_psi/function/sqlfunction.php');

function showChart()
{
	// $content .= '<form method="post" action="#" enctype="multipart/form-data" class="form" novalidate="novalidate">';
	$id = $_GET['id'];
	$content = '<input type="hidden" id="hdid" value="'.$id.'">';
	list($nama) = sql_fetchrow(sql_query("SELECT nama_peserta FROM user WHERE no_ktp = '".$_GET['id']."'"));
	// $content .= '</form>';
    $content .= '<style>th {text-align:center;} label {font-weight:normal !important;}</style>';
    $content .= '<div class="col-md-12" role="main">';
    $content .= '<div class="col-md-12">';
    $content .= '<div class="page-title">';
    $content .= '<div class="title_left">';
    $content .= '<h3>Report Psikotes <small>Peserta: '.$nama.'</small></h3>';
    $content .= '</div>';
                        
    $content .= '</div>';
	
	$content .= '<div class="clearfix"></div>';

	
    $content .= '<div class="x_title col-md-12">';
    $content .= '<h2>Kraepelin<small>&nbsp;</small></h2>';
    $content .= '<div class="clearfix"></div>';
    $content .= '</div>';
	
    $content .= '<div class="row">';
    $content .= '<div class="col-md-6 col-sm-6 col-xs-12">';
    $content .= '<div class="x_panel">';
    $content .= '<div class="x_content">';
    $content .= '<canvas id="canvas000" ></canvas>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
	
	$content .= '<div class="col-md-6 col-sm-6 col-xs-12">';
	$content .= '<div class="table-responsive col-md-12">';
	$content .= '<table class="table table-bordered" style="text-align:center;">';
	$content .= '<thead>';
	$content .= '<tr><th class="col-md-4">Aspek</th><th class="col-md-2">Skor</th><th class="col-md-2">PP</th><th class="col-md-4">Klasifikasi</th></tr>';
	$content .= '</thead>';
	$content .= '<tbody>';
	$content .= '<tr><td style="font-weight:bold;">Kecepatan</td><td><label id="lblPankerScore" /></td><td><label id="lblPankerPP" /></td><td><label id="lblPankerCat" /></td></tr>';
	$content .= '<tr><td style="font-weight:bold;">Ketelitian</td><td><label id="lblTinkerScore" /></td><td><label id="lblTinkerPP" /></td><td><label id="lblTinkerCat" /></td></tr>';
	$content .= '<tr><td style="font-weight:bold;">Keajekan</td><td><label id="lblJankerScore" /></td><td><label id="lblJankerPP" /></td><td><label id="lblJankerCat" /></td></tr>';
	$content .= '</tbody>';
	$content .= '</table>';
	$content .= '</div>';
	$content .= '</div>';
    $content .= '</div>';
	
    $content .= '<div class="clearfix"></div>';
	
    $content .= '<div class="x_title col-md-12">';
    $content .= '<h2>PAPI<small>&nbsp;</small></h2>';
    $content .= '<div class="clearfix"></div>';
    $content .= '</div>';
	
    $content .= '<div class="row">';
    $content .= '<div class="col-md-6 col-sm-6">';
    $content .= '<div class="x_panel">';
    $content .= '<div class="x_content canvasradar">';
    $content .= '<canvas id="canvas_radar" class=""></canvas>';
    $content .= '</div>';
    $content .= '</div>';
    $content .= '</div>';
	
	$content .= '<div class="col-md-6 col-sm-6 col-xs-12">';
	$content .= '<div class="table-responsive col-md-12">';
	$qPAPI = sql_fetchrow(sql_query("SELECT `G`,`L`,`I`,`T`,`V`,`S`,`R`,`D`,`C`,`E`,`N`,`A`,`P`,`X`,`B`,`O`,`Z`,`K`,`F`,`W`
									FROM `hasil_papi` WHERE userid = '".$id."'"));
	$content .= '<table class="table table-bordered" style="text-align:center;">';
	$content .= '<thead>';
	$content .= '<tr>';
	$content .= '<th width="10%">G</th><th width="10%">L</th><th width="10%">I</th><th width="10%">T</th><th width="10%">V</th>';
	$content .= '<th width="10%">S</th><th width="10%">R</th><th width="10%">D</th><th width="10%">C</th><th width="10%">E</th>';
	$content .= '</tr>';
	$content .= '</thead>';
	$content .= '<tbody>';
	$content .= '<tr>';
	$content .= '<td>'.$qPAPI['G'].'</td><td>'.$qPAPI['L'].'</td><td>'.$qPAPI['I'].'</td><td>'.$qPAPI['T'].'</td><td>'.$qPAPI['V'].'</td>';
	$content .= '<td>'.$qPAPI['S'].'</td><td>'.$qPAPI['R'].'</td><td>'.$qPAPI['D'].'</td><td>'.$qPAPI['C'].'</td><td>'.$qPAPI['E'].'</td>';
	$content .= '</tr>';
	$content .= '</tbody>';
	$content .= '</table>';
	$content .= '<table class="table table-bordered" style="text-align:center;">';
	$content .= '<thead>';
	$content .= '<tr>';
	$content .= '<th width="10%">N</th><th width="10%">A</th><th width="10%">P</th><th width="10%">X</th><th width="10%">B</th>';
	$content .= '<th width="10%">O</th><th width="10%">Z</th><th width="10%">K</th><th width="10%">F</th><th width="10%">W</th>';
	$content .= '</tr>';
	$content .= '</thead>';
	$content .= '<tbody>';
	$content .= '<tr>';
	$content .= '<td>'.$qPAPI['N'].'</td><td>'.$qPAPI['A'].'</td><td>'.$qPAPI['P'].'</td><td>'.$qPAPI['X'].'</td><td>'.$qPAPI['B'].'</td>';
	$content .= '<td>'.$qPAPI['O'].'</td><td>'.$qPAPI['Z'].'</td><td>'.$qPAPI['K'].'</td><td>'.$qPAPI['F'].'</td><td>'.$qPAPI['W'].'</td>';
	$content .= '</tr>';
	$content .= '</tbody>';
	$content .= '</table>';
	$content .= '</div>';
	$content .= '</div>';
    $content .= '</div>';
    
	
    $content .= '<div class="clearfix"></div>';
	
	$content .= '<div class="row">';
	$content .= '<div class="col-md-6 col-sm-6">';
    $content .= '<div class="x_panel">';
    $content .= '<div class="x_title">';
    $content .= '<h2>DISC<small>&nbsp;</small></h2>';
    $content .= '<div class="clearfix"></div>';
    $content .= '</div>';
    /* 
		 GRAFIK DISC 
						*/
    $content .= '</div>';
    $content .= '</div>';
	
	
	$content .= '<div class="col-md-6 col-sm-6">';
    $content .= '<div class="x_panel">';
    $content .= '<div class="x_title">';
    $content .= '<h2>WPT<small>&nbsp;</small></h2>';
    $content .= '<div class="clearfix"></div>';
    $content .= '</div>';
    $content .= '<table class="table table-bordered" style="text-align:center;">';
	$content .= '<thead>';
	$content .= '<tr><th class="col-md-2">WPT SKOR</th><th class="col-md-2">WPT IQ</th><th class="col-md-2">WPT CLASSIFICATION</th></tr>';
	$content .= '</thead>';
	$content .= '<tbody>';
	$content .= '<tr><td><label id="lblWptSkor" /></td><td><label id="lblWptIQ" /></td><td><label id="lblWptClass" /></td></tr>';
	$content .= '</tbody>';
	$content .= '</table>';
    $content .= '</div>';
    $content .= '</div>';
	$content .= '</div>';
	
    $content .= '</div>';
    $content .= '</div>';
	
	echo $content;
}

function getWPTClass($skor){
	if($skor>=130) {
		$cat = "Very Superior";
	}else if($skor >= 120 && $skor <= 129){
		 $cat = "Superior";
	}
	else if($skor >= 110 && $skor <= 119){
		 $cat = "High Average";
	}
	else if($skor >= 90 && $skor <= 109){
		 $cat = "Average";
	}
	else if($skor >= 80 && $skor <= 89){
		 $cat = "Low Average";
	}
	else if($skor >= 70 && $skor <= 79){
		 $cat = "Borderline";
	}
	else{
		$cat = "Extremely Low";
	}
	return $cat;
}

function getPankerCat($skor){
	if($skor<=8) {$cat['PP'] = '10'; $cat['cat'] = 'Rendah';}
	else if($skor>=9 && $skor<=10) {$cat['PP'] = '25'; $cat['cat'] = 'Rendah';}
	else if($skor>=11 && $skor<=12) {$cat['PP'] = '50'; $cat['cat'] = 'Sedang';}
	else if($skor>=13 && $skor<=14) {$cat['PP'] = '75'; $cat['cat'] = 'Sedang';}
	else if($skor==15) {$cat['PP'] = '90'; $cat['cat'] = 'Tinggi';}
	else if($skor==16) {$cat['PP'] = '95'; $cat['cat'] = 'Tinggi';}
	else {$cat['PP'] = '99'; $cat['cat'] = 'Tinggi';}
	return $cat;
}
function getJankerCat($skor){
	if($skor>=15) {$cat['PP'] = '10'; $cat['cat'] = 'Rendah';}
	else if($skor>=13 && $skor<=14) {$cat['PP'] = '25'; $cat['cat'] = 'Rendah';}
	else if($skor>=11 && $skor<=12) {$cat['PP'] = '50'; $cat['cat'] = 'Sedang';}
	else if($skor>=9 && $skor<=10) {$cat['PP'] = '75'; $cat['cat'] = 'Sedang';}
	else if($skor>=7 && $skor<=8) {$cat['PP'] = '90'; $cat['cat'] = 'Tinggi';}
	else if($skor>=5 && $skor<=6) {$cat['PP'] = '95'; $cat['cat'] = 'Tinggi';}
	else {$cat['PP'] = '99'; $cat['cat'] = 'Tinggi';}
	return $cat;
}
function getTinkerCat($skor){
	if($skor>=31) {$cat['PP'] = '10'; $cat['cat'] = 'Rendah';}
	else if($skor>=23 && $skor<=30) {$cat['PP'] = '25'; $cat['cat'] = 'Rendah';}
	else if($skor>=12 && $skor<=22) {$cat['PP'] = '50'; $cat['cat'] = 'Sedang';}
	else if($skor>=6 && $skor<=11) {$cat['PP'] = '75'; $cat['cat'] = 'Sedang';}
	else if($skor>=3 && $skor<=5) {$cat['PP'] = '90'; $cat['cat'] = 'Tinggi';}
	else if($skor>=1 && $skor<=2) {$cat['PP'] = '95'; $cat['cat'] = 'Tinggi';}
	else {$cat['PP'] = '99'; $cat['cat'] = 'Tinggi';}
	return $cat;
}

function reverseValue($val){
	switch($val){
		case '0': $rev = '9'; break;
		case '1': $rev = '8'; break;
		case '2': $rev = '7'; break;
		case '3': $rev = '6'; break;
		case '4': $rev = '5'; break;
		case '5': $rev = '4'; break;
		case '6': $rev = '3'; break;
		case '7': $rev = '2'; break;
		case '8': $rev = '1'; break;
		case '9': $rev = '0'; break;
	}
	return $rev;
}
?>