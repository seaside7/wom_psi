<?php
function LoginForm(){
	// echo $_SESSION['adminuser'];
	if(!isset($_SESSION['adminuser'])){
   
	$content = '<div style="text-align:center;">Harap <a href="?act=login">login</a> terlebih dahulu.</div>';
	
	echo $content;
	}  else {
			TesteeForm();
	}
}
function TesteeForm()
{	// unset($_SESSION['adminuser']);
	// $content = '<div id="title" align="center">Login</div>';
	
	$formName = 'formRegister';
	$content = '<div id="navigation" class="navigation">';
	$content .= '<nav><ul>';
	if($_SESSION['adminrole'] == 1) 
		{
			$content .= '<li><a href="?act=admin">Testee List</a></li>';
			$content .= '<li><a href="?act=testee">Add Testee</a></li>';
			$content .= '<li><a href="?act=mpass&userid=admin">Change Password</a></li>';
		}
	$content .= '</ul></nav>';
	$content .= '<div id="logout" align="center" style="width: 900px; margin: auto; text-align:right;"><a href="javascript:void(0)" onclick="JSlogout();"class="logout">Logout
				<img src="images/icon-logout.gif" width="9" height="9" 
				style="border:none; margin-left:8px; vertical-align:baseline;" /></a></div><br /><br /><br />';
	$content .= '<form action="" method="post" enctype="multipart/form-data" name="'.$formName.'" id="'.$formName.'">';
	$content .= "<table id=tbLogin align='center' border='0' width='450px'>";
	/*$content .= "<tr>";
	$content .= "<td width='35%'>Tanggal Tes</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'>".getDMYFormatDate(date("Y-m-d H:i:s"))."<input type='hidden' id='hdTanggal' name='hdTanggal' value='".date("Y-m-d H:i:s")."' ></td>";
	$content .= "</tr>";*/
	$content .= "<tr>";
	$content .= "<td width='35%'>NIK / Nomor KTP</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtNoKTP' name='txtNoKTP' size='30' maxlength='16' onkeypress='return isNumberNoAlert(event);'></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Nama Lengkap</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtNama' name='txtNama' size='30' maxlength='30'></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Posisi yang Dituju</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtPosisi' name='txtPosisi' size='30' maxlength='30'></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Usia</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtUsia' name='txtUsia' size='23' maxlength='2' onkeypress='return isNumberNoAlert(event);'>&nbsp;Tahun</td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Alamat</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><textarea rows=3 cols=31 name='txtAlamat' id='txtAlamat' ></textarea></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Nomor HP</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtNoHP' name='txtNoHP' size='30' maxlength='12' onkeypress='return isNumberNoAlert(event);'></td>";
	$content .= "</tr>";
	$content .= "<tr style='height: 35px; vertical-align: bottom;'>";
	$content .= "<td width='35%'>Username</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtUsername' name='txtUsername' size='30' maxlength='30'></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Password</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtPass' name='txtPass' size='30' maxlength='30'></td>";
	$content .= "</tr>";
	$content .= "<tr>";
	$content .= "<td colspan=3 style='text-align:center;'>";
	$content .= '<input type="button" id="btnSaveDetail" value="Simpan" class="btn btnSave" onclick=\'localJsSaveDetail("'.$formName.'");\'>';
	$content .= "</td>";
	$content .= "</tr>";
	$content .= "</table>";
	$content .= "</form>";
	echo $content;
}
function localSaveDetail()
{	
		
		$sukses='0';
		
		
		$query = "INSERT INTO user
				(`no_ktp`, `nama_peserta`, 
				`posisi`, `usia`, `alamat`, `no_hp`, 
				`tahapan_tes`, `regional`, 
				`username`, `password`, `test_taken`
				)
				VALUES
				('".$_POST['txtNoKTP']."', '".$_POST['txtNama']."', 
				'".$_POST['txtPosisi']."', '".$_POST['txtUsia']."', '".$_POST['txtAlamat']."', '".$_POST['txtNoHP']."', 
				'1', '',
				'".$_POST['txtUsername']."', md5('".$_POST['txtPass']."'), 0
				); ";
				// echo $query;
				
				
							
			
			
			if(sql_query($query)) 
			{
				$sukses='1';
				// $_SESSION['userid'] = $_POST['txtNoKTP'];
			}
		
		echo $sukses;
	
}
function localEditDetail()
{	
		
		$sukses='0';
		
		
		$query[] = "UPDATE user
				SET `nama_peserta` = '".$_POST['txtNama']."', 
				`posisi` = '".$_POST['txtPosisi']."', 
				`usia` = '".$_POST['txtUsia']."', 
				`alamat` = '".$_POST['txtAlamat']."', 
				`no_hp` = '".$_POST['txtNoHP']."', 
				`username` = '".$_POST['txtUsername']."', 
				`password` = md5('".$_POST['txtPass']."'), 
				`test_taken` = '0'
				WHERE `no_ktp` = '".$_POST['txtNoKTP']."';";
		
		$query[] = "DELETE FROM hasil_wpt WHERE userid = '".$_POST['txtNoKTP']."'";
		$query[] = "DELETE FROM hasil_papi WHERE userid = '".$_POST['txtNoKTP']."'";
		$query[] = "DELETE FROM hasil_disc WHERE userid = '".$_POST['txtNoKTP']."'";
		$query[] = "DELETE FROM salah WHERE userid = '".$_POST['txtNoKTP']."'";
		$query[] = "DELETE FROM tinggi WHERE userid = '".$_POST['txtNoKTP']."'";
				// echo $query;
		for($x=0;$x<count($query);$x++){
			if(sql_query($query[$x])) 
			{
				$sukses='1';
				// $_SESSION['userid'] = $_POST['txtNoKTP'];
			}
			else $sukses='0';
		}		
			
		
		echo $sukses;
	
}
?>