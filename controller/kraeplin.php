<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wom_psi/function/sqlfunction.php');
function LocalKraeplinForm($UsrDef)
{	
	$max = sql_fetchrow(sql_query("SELECT DISTINCT MAX(x) as maxX, MAX(y) as maxY FROM template"));
	$maxX = $max['maxX'];
	$maxY = $max['maxY'];
	$qCell = sql_query("SELECT x,y,value,answer FROM template order by x asc, y asc ");

	$x=1;
	$y=1;
	while($tcell = sql_fetchassoc($qCell)){
		// print_r($tcell['x']." ".$tcell['y']." ".$tcell['value']."<br />");
		// print_r($x." ".$y." ".$tcell['value']."<br />");
		$cell[$x][$y]['x'] = $tcell['x'];
		$cell[$x][$y]['y'] = $tcell['y'];
		$cell[$x][$y]['val'] = $tcell['value'];
		$cell[$x][$y]['ans'] = $tcell['answer'];
		// $x++; if($x==$maxX+1) $x=1;
		$y++; if($y==$maxY+1) {$y=1; $x++;}
	}
	// echo '<pre>';
	// print_r ($cell);
	// echo '</pre>';

	// echo $_SESSION['userid'];
	$content = '<style> input[type="text"]{ width:30px; text-align:center; border: 0;}
						input[type=text]::-webkit-outer-spin-button,
						input[type=text]::-webkit-inner-spin-button {
							-webkit-appearance: none;
							margin: 0;
						}
						input[type=text] {
							-moz-appearance:textfield;
						}
				</style>';
	$content .= '<div id="title" align="center"><h3>Kraepelin</h3></div>';
	$content .= "<div class='col-md-6 col-md-offset-3' style='padding-bottom: 10px;' id='rules'><fieldset class=contentInfo style='margin-top:0 '>
				<center><h4>Ketentuan Pengerjaan Tes Kraepelin</h4></center>
				<img class='col-md-8 col-md-offset-2' src='images/kraepelin-guide.png' />
						<div class='col-md-12'><ol>
							<li>Pengerjaan dilakukan dari bawah ke atas.</li>
							<li>Tekan panah atas untuk ke field selanjutnya.</li>
							<li>Misalnya 8+1=9, maka ditulis angka 9.</li>
							<li>Bila angka yang dijumlahkan lebih dari 10, maka tuliskan angka belakangnya saja. Misalnya 17, tuliskan angka 7.</li>
							<li>Waktu pengerjaan setiap lajur dibatasi 30 detik.</li>
							<li>Klik tombol start untuk memulai tes.</li>
						</ol></div></fieldset></div>";
	$content .= '<div class="col-md-12" id="btstart" align="center"><input type=button id="btnstart" tabindex="-1" value="Start"></div>';
	// $content .= '<div class="col-md-12" id="btstart" align="center"><input type=button id="btnup" value="Up" onclick="up();"></div>';
	$content .= '<form action="" method="post" enctype="multipart/form-data" id="formKraeplin">';
	$content .= '<input type="hidden" name="hduserid" id="hduserid" value="'.$_SESSION['userid'].'">';
	$content .= '<input type="hidden" name="hdmaxX" id="hdmaxX" value="'.$maxX.'">';
	$content .= '<input type="hidden" name="hdmaxY" id="hdmaxY" value="'.$maxY.'">';
	$content .= "<table id=tbSheet style='display:none;'>";
	for($yp=$maxY;$yp>=1;$yp--){
		$content .= "<tr>";
		for($xp=1;$xp<=$maxX;$xp++){
			// echo $xp." ".$yp." ".$cell[$xp][$yp]['val']."<br />";

			$content .= "<td>".$cell[$xp][$yp]['val']."</td><td>&nbsp;";
			if($yp==1) $content .= "<input type=hidden name='hdtinggi_".$xp."' id='hdtinggi_".$xp."' >";
			$content .= "</td>";
				if($xp==$maxX && $yp>1){
				$content .= "</tr><tr>";
				for($xpp=1;$xpp<=$maxX;$xpp++){ $ypp = $yp-1;
					$content .= "<td>&nbsp;</td>";
					$content .= "<td><input tabindex='-1' type='text' maxlength = '1' data-x='".$xpp."' data-y='".$ypp."' class='txtans txtansrow".$xpp."' name='txtans_".$xpp."_".$ypp."' size=1 id='txtans_".$xpp."_".$ypp."' onkeyup='nextText($xpp, $ypp, (this).value); ' onClick='this.select(); scrollright($xpp);' onfocus='this.oldvalue = this.value;' onChange='check($xpp, $ypp, this)' this.oldvalue = this.value; >";
					$content .= "<input type=hidden name='hdinput_".$xpp."_".$ypp."' id='hdinput_".$xpp."_".$ypp."' ></td>";
					$content .= "<input type=hidden name='hdans_".$xpp."_".$ypp."' id='hdans_".$xpp."_".$ypp."' value='".$cell[$xpp][$ypp]['ans']."'></td>";
					$content .= "<input type=hidden name='hdstatus_".$xpp."_".$ypp."' id='hdstatus_".$xpp."_".$ypp."' value='1'></td>";
					$content .= "<input type=hidden name='hdcounter_".$xpp."_".$ypp."' id='hdcounter_".$xpp."_".$ypp."' value='0'></td>";
				}
				$content .= "</tr>";
			}
		}	
		// $content .= "</tr>";
		
		
	}
	$content .= "</table>";
	$content .= "</form>";
	echo $content;
};

?>