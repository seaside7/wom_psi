<?php
	include('../config/conn.php');
	include('../function/sqlfunction.php');
	require("../controller/chartjs.php");
	$po = $_GET['po'];
	
	if($po=="getWPT"){
		$data = $_GET;
		list($wptSkor, $wptIQ) = sql_fetchrow(sql_query("SELECT wpt_skor, wpt_iq from hasil_wpt where userid = '".$data['userid']."';"));
		$result['wptSkor'] = $wptSkor;
		$result['wptIQ'] = $wptIQ;
		$result['wptClass'] = getWPTClass($wptIQ);
		echo json_encode($result);
	}
	if($po=="getLineChart"){
		$data = $_GET;
		$qCell = sql_query("SELECT x,y FROM tinggi WHERE userid = '".$data['userid']."' order by x;");
		list($qSpeed, $qTimbang, $qJanker, $qTotal) = sql_fetchrow(sql_query("SELECT ROUND(AVG(Y)) AS speed, ROUND((MAX(Y)+MIN(Y))/2) AS timbang, MAX(Y)-MIN(Y) AS janker, MAX(Y)+MIN(Y) AS total FROM tinggi WHERE userid = '".$data['userid']."'; "));
		list($qSpeed) = sql_fetchrow(sql_query("SELECT ROUND(AVG(Y)) AS speed FROM tinggi WHERE userid = '".$data['userid']."' AND x BETWEEN 6 AND 40; "));
		list($qTinker) = sql_fetchrow(sql_query("SELECT COUNT(1) AS tinker FROM salah WHERE userid = '".$data['userid']."' and x BETWEEN 6 AND 40; "));
		list($salah) = sql_fetchrow(sql_query("select (A.sums+B.sums+C.sums) as jumlahsalah
						from 
						(SELECT COUNT(1) as sums FROM `salah` WHERE userid='".$data['userid']."' and x BETWEEN 6 and 10) A,
						(SELECT COUNT(1) as sums FROM `salah` WHERE userid='".$data['userid']."' and x BETWEEN 21 and 25) B,
						(SELECT COUNT(1) as sums FROM `salah` WHERE userid='".$data['userid']."' and x BETWEEN 36 and 40) C;"));

		$result = array();
		$i = 1;
		while($tcell = sql_fetchassoc($qCell)){
			$result['cell'][] = $tcell['y'];
			$i++;
		}
		$result['speed'] = $qSpeed;
		$speed = getPankerCat($qSpeed);
		$result['speedPP'] = $speed['PP'];
		$result['speedCat'] = $speed['cat'];
		
		$result['janker'] = $qJanker;
		$janker = getJankerCat($qJanker);
		$result['jankerPP'] = $janker['PP'];
		$result['jankerCat'] = $janker['cat'];
		
		$result['tinker'] = $qTinker;
		$tinker = getTinkerCat($qTinker);
		$result['tinkerPP'] = $tinker['PP'];
		$result['tinkerCat'] = $tinker['cat'];
		
		$result['timbang'] = $qTimbang;

		$result['total'] = $qTotal;
		$result['salah'] = $salah;
		
		echo json_encode($result);
	}
	if($po=="getLineDISC"){
		$data = $_GET;
		list($d1, $i1, $s1, $c1, $d1a, $i1a, $s1a, $c1a) = sql_fetchrow(sql_query("SELECT b.value AS val_d1, c.value AS val_i1, d.value AS val_s1, e.value AS val_c1, a.dm, a.im, a.sm, a.cm  
							FROM hasil_disc a 
							LEFT JOIN (SELECT NO, VALUE FROM disc_mapping WHERE graph = 1 AND TYPE = 'D') b ON a.dm = b.no
							LEFT JOIN (SELECT NO, VALUE FROM disc_mapping WHERE graph = 1 AND TYPE = 'I') c ON a.im = c.no
							LEFT JOIN (SELECT NO, VALUE FROM disc_mapping WHERE graph = 1 AND TYPE = 'S') d ON a.sm = d.no
							LEFT JOIN (SELECT NO, VALUE FROM disc_mapping WHERE graph = 1 AND TYPE = 'C') e ON a.cm = e.no
							WHERE a.userid = '".$data['userid']."';"));

		list($d2, $i2, $s2, $c2,$d2a, $i2a, $s2a, $c2a) = sql_fetchrow(sql_query("SELECT b.value AS val_d2, c.value AS val_i2, d.value AS val_s2, e.value AS val_c2, a.dl, a.il, a.sl, a.cl 
							FROM hasil_disc a 
							LEFT JOIN (SELECT NO, VALUE FROM disc_mapping WHERE graph = 2 AND TYPE = 'D') b ON a.dl = b.no
							LEFT JOIN (SELECT NO, VALUE FROM disc_mapping WHERE graph = 2 AND TYPE = 'I') c ON a.il = c.no
							LEFT JOIN (SELECT NO, VALUE FROM disc_mapping WHERE graph = 2 AND TYPE = 'S') d ON a.sl = d.no
							LEFT JOIN (SELECT NO, VALUE FROM disc_mapping WHERE graph = 2 AND TYPE = 'C') e ON a.cl = e.no
							WHERE a.userid = '".$data['userid']."';"));

		$d3 = $d1a - $d2a;
		$i3 = $i1a - $i2a;
		$s3 = $s1a - $s2a;
		$c3 = $c1a - $c2a;
		
		$q3 = sql_query("SELECT 'D', VALUE FROM disc_mapping WHERE NO='$d3' AND graph=3 AND TYPE ='D'
						UNION
						SELECT 'I', VALUE FROM disc_mapping WHERE NO='$i3' AND graph=3 AND TYPE ='I'
						UNION
						SELECT 'S', VALUE FROM disc_mapping WHERE NO='$s3' AND graph=3 AND TYPE ='S'
						UNION
						SELECT 'C', VALUE FROM disc_mapping WHERE NO='$c3' AND graph=3 AND TYPE ='C';");
		

		$result = array();
		
		$result['graph1'][] = $d1;
		$result['graph1'][] = $i1;
		$result['graph1'][] = $s1;
		$result['graph1'][] = $c1;
		
		$result['graph2'][] = $d2;
		$result['graph2'][] = $i2;
		$result['graph2'][] = $s2;
		$result['graph2'][] = $c2;
		
		while($g3 = sql_fetchrow($q3)){
			
			$result['graph3'][] = $g3['VALUE'];
		}
		
		
		echo json_encode($result);
	}
	if($po=="getRadarChart"){
		$data = $_GET;
		$qRadar = sql_fetchrow(sql_query("SELECT	`userid`, 
							`G`, `L`, `I`, `T`, `V`, `S`, `R`, `D`, `C`, `E`, 
							`N`, `A`, `P`, `X`, `B`, `O`, `Z`, `K`, `F`, `W`
							 FROM `wom_psi`.`hasil_papi` WHERE userid = '".$data['userid']."';"));
		if($qRadar){
			$result['cell'][] = $qRadar['N'];
			$result['cell'][] = $qRadar['G'];
			$result['cell'][] = $qRadar['A'];
			$result['cell'][] = $qRadar['L'];
			$result['cell'][] = $qRadar['P'];
			$result['cell'][] = $qRadar['I'];
			$result['cell'][] = $qRadar['T'];
			$result['cell'][] = $qRadar['V'];
			$result['cell'][] = $qRadar['X'];
			$result['cell'][] = $qRadar['S'];
			$result['cell'][] = $qRadar['B'];
			$result['cell'][] = $qRadar['O'];
			$result['cell'][] = $qRadar['R'];
			$result['cell'][] = $qRadar['D'];
			$result['cell'][] = $qRadar['C'];
			$result['cell'][] = reverseValue($qRadar['Z']);
			$result['cell'][] = $qRadar['E'];
			$result['cell'][] = reverseValue($qRadar['K']);
			$result['cell'][] = $qRadar['F'];
			$result['cell'][] = $qRadar['W'];
		}else{
			$result['cell'][]="";
		}
		
		echo json_encode($result);
		
		
	}

if($po=="localAjPrintReport") 
{	
	$img = json_decode(str_replace ('\"','"', $_POST['img']), true);
	$id = $_GET['id'];
		// print_r ($img['imgrd']); die();
	
	$printpage = "<page>";
	$printpage .= "<html>";
	$printpage .= "<head>";
	$printpage .= '<link href="css/custom.css" rel="stylesheet" type="text/css" />';
	$printpage .= '<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">';
	$printpage .= '<script src="js/bootstrap.min.js"></script>';
	$printpage .= "</head>";
	$printpage .= "<body>";
	
	$qNama = "SELECT nama_peserta, posisi, usia FROM user WHERE no_ktp = '".$id."'";
	// echo $qNama;
	list($nama, $posisi, $usia) = sql_fetchrow(sql_query($qNama));
	// $printpage .= '</form>';
    $printpage .= '<style>th {text-align:center;} label {font-weight:normal !important;}</style>';
    $printpage .= '<div class="col-md-12" role="main">';
    $printpage .= '<div style="width:100%">';
    $printpage .= '<table border=0 style="width:100%" cellspacing="0">';
    $printpage .= '<tr>';
    $printpage .= '<td style="width:70%;text-align:left; vertical-align:top; "colspan="3"><h4>Report Psikotes</h4></td>';
    $printpage .= '<td style="width:30%;text-align:right; vertical-align:top;" rowspan="4"><img src="../images/Logo-WOM.png" width="182" height="35"></td>';
    $printpage .= '</tr>';
    $printpage .= '<tr>';
    $printpage .= '<td style="width:15%;">Nama Peserta</td>';
    $printpage .= '<td style="width:2%;">:</td>';
    $printpage .= '<td style="width:53%;">'.$nama.'</td>';
    $printpage .= '</tr>';
    $printpage .= '<tr>';
    $printpage .= '<td style="width:15%;">Posisi yang Dituju</td>';
    $printpage .= '<td style="width:2%;">:</td>';
    $printpage .= '<td style="width:53%;">'.$posisi.'</td>';
    $printpage .= '</tr>';
    $printpage .= '<tr>';
    $printpage .= '<td style="width:15%;">Usia</td>';
    $printpage .= '<td style="width:2%;">:</td>';
    $printpage .= '<td style="width:53%;">'.$usia.' Tahun</td>';
    $printpage .= '</tr>';
    $printpage .= '</table>';
	
	$printpage .= '<div class="clearfix"></div>';

	
    $printpage .= '<div class="x_title col-md-12">';
    $printpage .= '<h4>Kraepelin<small>&nbsp;</small></h4>';
    $printpage .= '</div>';
	
    $printpage .= '<table border=0 style="width:100%" cellspacing="0">';
    $printpage .= '<tr>';
    $printpage .= '<td style="width:60%">';
    $printpage .= '<img src="'.$img['imgkr'].'" width="350"/>';
    $printpage .= '&nbsp;';
    $printpage .= '</td>';
	
	list($qSpeed, $qTimbang, $qJanker, $qTotal) = sql_fetchrow(sql_query("SELECT ROUND(AVG(Y)) AS speed, ROUND((MAX(Y)+MIN(Y))/2) AS timbang, MAX(Y)-MIN(Y) AS janker, MAX(Y)+MIN(Y) AS total FROM tinggi WHERE userid = '".$id."'; "));
	list($qSpeed) = sql_fetchrow(sql_query("SELECT ROUND(AVG(Y)) AS speed FROM tinggi WHERE userid = '".$id."' AND x BETWEEN 6 AND 40; "));
	list($qTinker) = sql_fetchrow(sql_query("SELECT COUNT(1) AS tinker FROM salah WHERE userid = '".$id."' and x BETWEEN 6 AND 40; "));
	list($salah) = sql_fetchrow(sql_query("select (A.sums+B.sums+C.sums) as jumlahsalah
					from 
					(SELECT COUNT(1) as sums FROM `salah` WHERE userid='".$id."' and x BETWEEN 6 and 10) A,
					(SELECT COUNT(1) as sums FROM `salah` WHERE userid='".$id."' and x BETWEEN 21 and 25) B,
					(SELECT COUNT(1) as sums FROM `salah` WHERE userid='".$id."' and x BETWEEN 36 and 40) C;"));
	
	$speed = getPankerCat($qSpeed);
	$janker = getJankerCat($qJanker);
	$tinker = getTinkerCat($qTinker);
	
	$printpage .= '<td style="width:40%">';
	$printpage .= '<table style="text-align:center;  border:1px solid #CCC; width:275px;"  cellspacing=0 cellpadding="15">';
	$printpage .= '<thead>';
	$printpage .= '<tr><th style="border:1px solid #CCC;  width:100px; ">Aspek</th><th style="border:1px solid #CCC;  width:50px;">Skor</th><th style="border:1px solid #CCC;  width:50px;">PP</th><th style="border:1px solid #CCC;  width:75px;">Klasifikasi</th></tr>';
	$printpage .= '</thead>';
	$printpage .= '<tbody>';
	$printpage .= '<tr><td style="border:1px solid #CCC; font-weight:bold;">Kecepatan</td><td style="border:1px solid #CCC; ">'.$qSpeed.'</td><td style="border:1px solid #CCC; ">'.$speed['PP'].'</td><td style="border:1px solid #CCC; ">'.$speed['cat'].'</td></tr>';
	$printpage .= '<tr><td style="border:1px solid #CCC; font-weight:bold;">Ketelitian</td><td style="border:1px solid #CCC; ">'.$qTinker.'</td><td style="border:1px solid #CCC; ">'.$tinker['PP'].'</td><td style="border:1px solid #CCC; ">'.$tinker['cat'].'</td></tr>';
	$printpage .= '<tr><td style="border:1px solid #CCC; font-weight:bold;">Keajekan</td><td style="border:1px solid #CCC; ">'.$qJanker.'</td><td style="border:1px solid #CCC; ">'.$janker['PP'].'</td><td style="border:1px solid #CCC; ">'.$janker['cat'].'</td></tr>';
	$printpage .= '<tr><td style="border:1px solid #CCC; font-weight:bold;">Total&nbsp;&nbsp;<img src="../images/help.png" title="Nilai tertinggi + Nilai terendah" style="cursor:pointer;"></td><td style="border:1px solid #CCC; ">'.$qTotal.'</td><td style="border:1px solid #CCC; background:#CCC;">&nbsp;</td><td style="border:1px solid #CCC; background:#CCC;">&nbsp;</td></tr>';
	$printpage .= '<tr><td style="border:1px solid #CCC; font-weight:bold;">Kesalahan&nbsp;&nbsp;<img src="../images/help.png" title="Lajur 6-10, 21-25, 36-40" style="cursor:pointer;"></td><td style="border:1px solid #CCC; ">'.$salah.'</td><td style="border:1px solid #CCC; background:#CCC;">&nbsp;</td><td style="border:1px solid #CCC; background:#CCC;">&nbsp;</td></tr>';
	$printpage .= '</tbody>';
	$printpage .= '</table>';
	$printpage .= '</td>';
	$printpage .= '</tr>';
    $printpage .= '</table>';
	
    $printpage .= '<div class="clearfix"></div>';
	
    $printpage .= '<div class="x_title col-md-12">';
    $printpage .= '<h4>PAPI<small>&nbsp;</small></h4>';
    $printpage .= '<div class="clearfix"></div>';
    $printpage .= '</div>';
	
    $printpage .= '<table border=0 style="width:100%" cellspacing="0">';
    $printpage .= '<tr>';
    $printpage .= '<td style="width:60%; padding-left:100;">';
	$printpage .= '<img src="'.$img['imgrd'].'" width="220"/>';
    $printpage .= '&nbsp;';
    $printpage .= '</td>';
	
	$printpage .= '<td style="width:40%">';
	$qPAPI = sql_fetchrow(sql_query("SELECT `G`,`L`,`I`,`T`,`V`,`S`,`R`,`D`,`C`,`E`,`N`,`A`,`P`,`X`,`B`,`O`,`Z`,`K`,`F`,`W`
									FROM `hasil_papi` WHERE userid = '".$id."'"));
	$printpage .= '<table style="text-align:center; width:275px; " border="1px solid #CCC;" cellspacing=0>';
	$printpage .= '<thead>';
	$printpage .= '<tr>';
	$printpage .= '<th style="width:55px;">G</th><th style="width:55px;">L</th><th style="width:55px;">I</th><th style="width:55px;">T</th><th style="width:55px;">V</th>';
	$printpage .= '</tr>';
	$printpage .= '</thead>';
	$printpage .= '<tbody>';
	$printpage .= '<tr>';
	$printpage .= '<td>'.$qPAPI['G'].'</td><td>'.$qPAPI['L'].'</td><td>'.$qPAPI['I'].'</td><td>'.$qPAPI['T'].'</td><td>'.$qPAPI['V'].'</td>';
	$printpage .= '</tr>';
	$printpage .= '</tbody>';
	$printpage .= '</table><br />';
	$printpage .= '<table style="text-align:center; width:275px; " border="1px solid #CCC;" cellspacing=0>';
	$printpage .= '<thead>';
	$printpage .= '<tr>';
	$printpage .= '<th style="width:55px;">S</th><th style="width:55px;">R</th><th style="width:55px;">D</th><th style="width:55px;">C</th><th  style="width:55px;">E</th>';
	$printpage .= '</tr>';
	$printpage .= '</thead>';
	$printpage .= '<tbody>';
	$printpage .= '<tr>';
	$printpage .= '<td>'.$qPAPI['S'].'</td><td>'.$qPAPI['R'].'</td><td>'.$qPAPI['D'].'</td><td>'.$qPAPI['C'].'</td><td>'.$qPAPI['E'].'</td>';
	$printpage .= '</tr>';
	$printpage .= '</tbody>';
	$printpage .= '</table><br />';
	$printpage .= '<table style="text-align:center; width:275px; " border="1px solid #CCC;" cellspacing=0>';
	$printpage .= '<thead>';
	$printpage .= '<tr>';
	$printpage .= '<th style="width:55px;">N</th><th style="width:55px;">A</th><th style="width:55px;">P</th><th style="width:55px;">X</th><th style="width:55px;">B</th>';
	$printpage .= '</tr>';
	$printpage .= '</thead>';
	$printpage .= '<tbody>';
	$printpage .= '<tr>';
	$printpage .= '<td>'.$qPAPI['N'].'</td><td>'.$qPAPI['A'].'</td><td>'.$qPAPI['P'].'</td><td>'.$qPAPI['X'].'</td><td>'.$qPAPI['B'].'</td>';
	$printpage .= '</tr>';
	$printpage .= '</tbody>';
	$printpage .= '</table><br />';
	$printpage .= '<table style="text-align:center; width:275px; " border="1px solid #CCC;" cellspacing=0>';
	$printpage .= '<thead>';
	$printpage .= '<tr>';
	$printpage .= '<th style="width:55px;">O</th><th style="width:55px;">Z</th><th style="width:55px;">K</th><th style="width:55px;">F</th><th style="width:55px;">W</th>';
	$printpage .= '</tr>';
	$printpage .= '</thead>';
	$printpage .= '<tbody>';
	$printpage .= '<tr>';
	$printpage .= '<td>'.$qPAPI['O'].'</td><td>'.$qPAPI['Z'].'</td><td>'.$qPAPI['K'].'</td><td>'.$qPAPI['F'].'</td><td>'.$qPAPI['W'].'</td>';
	$printpage .= '</tr>';
	$printpage .= '</tbody>';
	$printpage .= '</table>';
	$printpage .= '</td>';
	$printpage .= '</tr>';
    $printpage .= '</table>';
    
	
    $printpage .= '<div class="clearfix"></div>';
	
	$printpage .= '<div class="x_title col-md-12">';
    $printpage .= '<h4>DISC<small>&nbsp;</small></h4>';
    $printpage .= '<div class="clearfix"></div>';
    $printpage .= '</div>';
	
	$printpage .= '<table border=0 style="width:100%" cellspacing="0">';
    $printpage .= '<tr>';
    $printpage .= '<td style="width:24%">';
    $printpage .= '<img width="163" height="265" src="'.$img['imgd1'].'"/>';
    $printpage .= '&nbsp;';
    $printpage .= '</td>';
	
    $printpage .= '<td style="width:24%">';
    $printpage .= '<img width="163" height="265" src="'.$img['imgd2'].'"/>';
    $printpage .= '&nbsp;';
    $printpage .= '</td>';
	
    $printpage .= '<td style="width:24%">';
    $printpage .= '<img width="163" height="265" src="'.$img['imgd3'].'"/>';
    $printpage .= '&nbsp;';
    $printpage .= '</td>';
	
    $printpage .= '<td style="width:28%; padding-top:15px;">';
    $printpage .= '<table style="text-align:center; width:175px; " border="1px solid #CCC;" cellspacing=0>';
	$rDISC = sql_fetchrow(sql_query("SELECT DM, DL, DM-DL AS D3, IM, IL, IM-IL AS I3, SM, SL, SM-SL AS S3, CM, CL, CM-CL AS C3 FROM hasil_disc WHERE userid='".$id."'"));
    $printpage .= '<thead><tr><th style="width:25px">&nbsp;</th><th style="width:50px">Graph<br />I</th><th style="width:50px">Graph<br />II</th><th style="width:50px">Graph<br />III</th></tr></thead>';
	$printpage .= '<tbody>';
	$printpage .= '<tr style="color:purple; font-weight:bold;"><td>D</td><td>'.$rDISC['DM'].'</td><td>'.$rDISC['DL'].'</td><td>'.$rDISC['D3'].'</td></tr>';
	$printpage .= '<tr style="color:red; font-weight:bold;"><td>I</td><td>'.$rDISC['IM'].'</td><td>'.$rDISC['IL'].'</td><td>'.$rDISC['I3'].'</td></tr>';
	$printpage .= '<tr style="color:blue; font-weight:bold;"><td>S</td><td>'.$rDISC['SM'].'</td><td>'.$rDISC['SL'].'</td><td>'.$rDISC['S3'].'</td></tr>';
	$printpage .= '<tr style="color:green; font-weight:bold;"><td>C</td><td>'.$rDISC['CM'].'</td><td>'.$rDISC['CL'].'</td><td>'.$rDISC['C3'].'</td></tr>';
	$printpage .= '</tbody>';
	$printpage .= '</table>';
    $printpage .= '</td>';
    $printpage .= '</tr>';
	$printpage .= '</table>';
	
    $printpage .= '<div class="clearfix"></div>';
	
    $printpage .= '<div class="x_title col-md-12">';
    $printpage .= '<h4>WPT<small>&nbsp;</small></h4>';
    $printpage .= '<div class="clearfix"></div>';
    $printpage .= '</div>';
	
	list($wptSkor, $wptIQ) = sql_fetchrow(sql_query("SELECT wpt_skor, wpt_iq from hasil_wpt where userid = '".$id."';"));
		$wptClass = getWPTClass($wptIQ);
    $printpage .= '<table border="1px solid #CCC" style="width:50%" cellspacing="0">';
	$printpage .= '<thead>';
	$printpage .= '<tr><th style="width:90px">WPT SKOR</th><th style="width:90px">WPT IQ</th><th style="width:150px">CLASSIFICATION</th></tr>';
	$printpage .= '</thead>';
	$printpage .= '<tbody>';
	$printpage .= '<tr><td style="text-align:center;">'.$wptSkor.'</td><td style="text-align:center;">'.$wptIQ.'</td><td style="text-align:center;">'.$wptClass.'</td></tr>';
	$printpage .= '</tbody>';
	$printpage .= '</table>';
	
    $printpage .= '</div>';
    $printpage .= '</div>';
	
	$printpage .= "</body>";
	$printpage .= "</html>";
	$printpage .= "</page>";
	require_once('../function/html2pdf/html2pdf.class.php');
			$html2pdf = new HTML2PDF('P','A4','en');
			//$html2pdf->pdf->SetProtection(array('print'),'', 'Orangesystem');
			// $html2pdf->pdf->SetFont('times', 'BI', 20, '', 'false');;
			// $html2pdf->WriteHTML(htmlspecialchars ($printpage));
			$html2pdf->WriteHTML($printpage);
			$html2pdf->Output($id.'.pdf');
			
}
?>