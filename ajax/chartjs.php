<?php
	include('../config/conn.php');
	include('../function/sqlfunction.php');
	require("../controller/chartjs.php");
	$po = $_GET['po'];
	
	if($po=="getWPT"){
		$data = $_GET;
		list($wptSkor, $wptIQ) = sql_fetchrow(sql_query("SELECT wpt_skor, wpt_iq from hasil_wpt where userid = '".$data['data']."';"));
		$result['wptSkor'] = $wptSkor;
		$result['wptIQ'] = $wptIQ;
		$result['wptClass'] = getWPTClass($wptIQ);
		echo json_encode($result);
	}
	if($po=="getLineChart"){
		$data = $_GET;
		$qCell = sql_query("SELECT x,y FROM tinggi WHERE userid = '".$data['data']."' order by x;");
		list($qSpeed, $qTimbang, $qJanker) = sql_fetchrow(sql_query("SELECT ROUND(AVG(Y)) AS speed, ROUND((MAX(Y)+MIN(Y))/2) AS timbang, MAX(Y)-MIN(Y) AS janker FROM tinggi WHERE userid = '".$data['data']."'; "));
		list($qTinker) = sql_fetchrow(sql_query("SELECT COUNT(1) AS tinker FROM salah WHERE userid = '".$data['data']."'; "));

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
	if($po=="getRadarChart"){
		$data = $_GET;
		$qRadar = sql_fetchrow(sql_query("SELECT	`userid`, 
							`G`, `L`, `I`, `T`, `V`, `S`, `R`, `D`, `C`, `E`, 
							`N`, `A`, `P`, `X`, `B`, `O`, `Z`, `K`, `F`, `W`
							 FROM `wom_psi`.`hasil_papi` WHERE userid = '".$data['data']."';"));
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