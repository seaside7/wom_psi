<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wom_psi/function/sqlfunction.php');

function adminPage(){
	// echo $_SESSION['userid'];
	if(!isset($_SESSION['userid'])){
    $formName = 'formLogin';
	$content = '<form action="#" method="post" enctype="multipart/form-data" name="'.$formName.'" id="'.$formName.'">';
	$content .= "<table id=tbLogin align='center' border='0' width='450px'>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Username</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'>Admin</td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Password</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='password' id='txtPass' name='txtPass' size='30'></td>";
	$content .= "</tr>";
	$content .= "<tr><td colspan=3 style='text-align:center;'>&nbsp;</td><tr>";
	$content .= "<tr>";
	$content .= "<td colspan=3 style='text-align:center;'>";
	$content .= '<input type="button" id="btnLogin" value="Login" class="btn btnLogin" onclick=\'localJsLogin("'.$formName.'");\'>';
	$content .= "</td>";
	$content .= "</tr>";
	$content .= "</table>";
	$content .= "</form>";
	echo $content;
	}  else {
			UserList();
	}
}
function UserList() { //IF(tahapan_tes='1', 'Kraeplin', IF(tahapan_tes='2', 'PAPI', IF(tahapan_tes='3', 'DISC', IF(tahapan_tes='4', 'WPT', 'Completed')))) AS tahapan
		$UserQuery="SELECT tanggal_tes, no_ktp, nama_peserta, CONCAT(usia ,' Tahun') AS usia, posisi, tahapan_tes,
						IF(tahapan_tes='1', 'WPT', IF(tahapan_tes='2', 'PAPI', IF(tahapan_tes='3', 'DISC', IF(tahapan_tes='4', 'Kraeplin', 'Completed')))) AS tahapan
						FROM USER  ";
		$UserQuery .= " ORDER BY tanggal_tes DESC ";					
		$stmt = sql_query($UserQuery);
		
		$content = 
		'<div id="logout" align="center" style="width: 900px; margin: auto; text-align:right;"><a href="javascript:void(0)" onclick="JSlogout();"class="logout">Logout
				<img src="images/icon-logout.gif" width="9" height="9" 
				style="border:none; margin-left:8px; vertical-align:baseline;" /></a></div><br /><br /><br />
		<div id="title" align="center" style="font-weight:bold; font-size:23px;">Data Peserta</div><br /><br /><br />
		<div id="body" align="center" style="width: 900px; margin: auto;">
		<table width="900px" class="display" id="tableatendee" >
		<thead>
			<tr align="center">
				<th style="text-align:center;">Tanggal Tes</th>
				<th style="text-align:center;">No. KTP</th>
				<th style="text-align:center;">Nama Peserta</th>
				<th style="text-align:center;">Usia</th>
				<th style="text-align:center;">Posisi yang<br />Dilamar</th>
				<th style="text-align:center;">Tahapan<br />Tes</th>
				<th style="text-align:center;">Tindakan</th>
			</tr></thead>';
			$content .= '<tbody>';
		$i=0;
		while($row=sql_fetchrow($stmt))
		{ $i++; 
		$content .="<tr><td align=\"center\">".getDMYFormatDate($row['tanggal_tes'])."</td>
						<td align=\"center\">".$row['no_ktp']."</td>
						<td align=\"center\">".$row['nama_peserta']."</td>
						<td align=\"center\">".$row['usia']."</td>
						<td align=\"center\">".$row['posisi']."</td>
						<td align=\"center\">".$row['tahapan']."</td>";
		$content .= "<td style='text-align:center'>";
		$content .= UserAction($row['no_ktp'],$row['tahapan_tes']);
		$content .= "</td>";
		$content .="</tr>";
						  
		}
		// if($i=='0') $content .= '<tr><td colspan="9" class="fb12" align="center" bgcolor="#d4e8f6">Data tidak ditemukan</td></tr>';
		
		$content .= '</tbody>';
		$content .= '</table><br><br></div>';
		echo $content;
}
function UserAction($id, $tahapan)
{
	// $content='';	
	// $cekWPT = sql_numrows(sql_query("SELECT DISTINCT userid FROM hasil_wpt WHERE userid='$id'"));
	// $cekKraeplin = sql_numrows(sql_query("SELECT DISTINCT userid FROM tinggi WHERE userid='$id'"));
	// $cekPAPI = sql_numrows(sql_query("SELECT DISTINCT userid FROM hasil_papi WHERE userid='$id'"));
	// $cekDISC = sql_numrows(sql_query("SELECT DISTINCT userid FROM hasil_disc WHERE userid='$id'"));
	// if($cekWPT>0 && $cekKraeplin>0 && $cekPAPI>0 && $cekDISC>0){//$content .= $tahapan;
		$content ="<a href=\"javascript:\" onclick=\"window.open('index.php?act=chartjs&id=".$id."', '_blank')\" ><img src='images/view.gif' style='cursor:pointer' title=\"Lihat Data Peserta\" '> </a>";	
	// }
	// }
	
		
	return $content;
}

?>