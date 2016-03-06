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
		list($qSpeed, $qTimbang, $qJanker) = sql_fetchrow(sql_query("SELECT ROUND(AVG(Y)) AS speed, ROUND((MAX(Y)+MIN(Y))/2) AS timbang, MAX(Y)-MIN(Y) AS janker FROM tinggi WHERE userid = '".$data['userid']."'; "));
		list($qTinker) = sql_fetchrow(sql_query("SELECT COUNT(1) AS tinker FROM salah WHERE userid = '".$data['userid']."'; "));

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
		
		echo json_encode($result);
		
		
	}
	
?>