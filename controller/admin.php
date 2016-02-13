<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/wom_psi/function/sqlfunction.php');
function UserList() { //IF(tahapan_tes='1', 'Kraeplin', IF(tahapan_tes='2', 'PAPI', IF(tahapan_tes='3', 'DISC', IF(tahapan_tes='4', 'WPT', 'Completed')))) AS tahapan
		$UserQuery="SELECT tanggal_tes, no_ktp, nama_peserta, posisi, tahapan_tes,
						IF(tahapan_tes='1', 'Kraeplin', IF(tahapan_tes='2', 'PAPI', IF(tahapan_tes='3', 'DISC', IF(tahapan_tes='4', 'WPT', 'Completed')))) AS tahapan
						FROM USER  ";
		$UserQuery .= " ORDER BY tanggal_tes DESC ";					
		$stmt = sql_query($UserQuery);
		
		$content = 
		'<div id="title" align="center" style="font-weight:bold; font-size:23px;">Data Peserta</div><br /><br /><br />
		<div id="body" align="center" style="width: 1000px; margin: auto;">
		<table width="1000px" class="display" id="tableatendee" >
		<thead>
			<tr align="center">
				<th>Tanggal Tes</th>
				<th>Kondisi</th>
				<th>No. KTP</th>
				<th>Posisi yang<br />Dilamar</th>
				<th>Tahapan<br />Tes</th>
				<th>Tindakan</th>
			</tr></thead>';
			$content .= '<tbody>';
		$i=0;
		while($row=sql_fetchrow($stmt))
		{ $i++; 
		$content .="<tr><td align=\"center\">".getDMYFormatDate($row['tanggal_tes'])."</td>
						<td align=\"center\">".$row['no_ktp']."</td>
						<td align=\"center\">".$row['nama_peserta']."</td>
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
	$content='';	
	if($tahapan=='5'){
		$content.="<a href=\"javascript:\" onclick=\"window.open('index.php?act=chartjs&id=".$id."', '_blank')\" ><img src='images/view.gif' style='cursor:pointer' class='tooltip' title=\"Lihat Data Peserta\" '> </a>";	
	}
	
		
	return $content;
}

?>