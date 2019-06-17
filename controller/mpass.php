<?php
function LoginForm(){
	// echo $_SESSION['adminuser'];
	if(!isset($_SESSION['adminuser'])){
   
	$content = '<div style="text-align:center;">Harap <a href="?act=login">login</a> terlebih dahulu.</div>';
	
	echo $content;
	}  else {
		if($_SESSION['adminrole']<>'1'){
			$content = '<div style="text-align:center;">Anda tidak memiliki hak untuk mengakses halaman ini.</div>';
			echo $content;
		}else {
			PasswordForm();
		}
			
	}
}
function PasswordForm()
{	// unset($_SESSION['adminuser']);
	// $content = '<div id="title" align="center">Login</div>';
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
				style="border:none; margin-left:8px; vertical-align:baseline;" /></a></div></div>';
	
	// $content .= '<table class="table table-bordered" style="text-align:center; width: 400px; margin: 0 auto;">';
	$content .= '<div style="width: 400px; margin:0 auto;">';
	
	if(isset($_GET['userid'])){
		$formName = 'formMpass';
		$content .= '<form action="#" method="post" enctype="multipart/form-data" name="'.$formName.'" id="'.$formName.'">';
		$content .= "<table id=tbLogin align='center' border='0' width='400px'>";
		$content .= "<tr>";
		$content .= "<td width='55%'>Username</td><td width='5%' style='text-align:center;'>:</td>";
		$content .= "<td width='40%'>".$_GET['userid']."<input type='hidden' id='txtUsername' name='txtUsername' value='".$_GET['userid']."'></td>";
		$content .= "</tr>";
		$content .= "<tr>";
		$content .= "<td width='55%'>Password Baru</td><td width='5%' style='text-align:center;'>:</td>";
		$content .= "<td width='40%'><input type='password' id='txtPass' name='txtPass' size='20'></td>";
		$content .= "</tr>";
		$content .= "<tr>";
		$content .= "<td width='55%'>Ulangi Password Baru</td><td width='5%' style='text-align:center;'>:</td>";
		$content .= "<td width='40%'><input type='password' id='txtPass2' name='txtPass2' size='20'></td>";
		$content .= "</tr>";
		$content .= "<tr><td colspan=3 style='text-align:center;'>&nbsp;</td><tr>";
		$content .= "<tr>";
		$content .= "<td colspan=3 style='text-align:center;'>";
		$content .= '<input style="width:80px;" type="button" id="btnLogin" value="Simpan" class="btn btnLogin" onclick=\'localJsMpass("'.$formName.'");\'>&nbsp;';
		$content .= '<input style="width:80px;" type="button" id="btnCancel" value="Batal" class="btn btnLogin" onclick=\'location.href="?act=home";\'>';
		$content .= "</td>";
		$content .= "</tr>";
		$content .= "</table>";
		$content .= "</form>";
	}
	
	
	$content .= '</div>';
	echo $content;
}

function UserAction($id)
{
	
	$content ="<a href=\"?act=mpass&userid=".$id."\" ><img src='images/edit.gif' style='cursor:pointer' title=\"Ubah Password\" '> </a>";	
	
		
	return $content;
}
function localSaveDetail()
{	
		
		$sukses='0';
		
		
		$query = "INSERT INTO user
				(`no_ktp`, `tanggal_tes`, `nama_peserta`, 
				`posisi`, `usia`, `alamat`, `no_hp`, 
				`tahapan_tes`
				)
				VALUES
				('".$_POST['txtNoKTP']."', '".$_POST['hdTanggal']."', '".$_POST['txtNama']."', 
				'".$_POST['txtPosisi']."', '".$_POST['txtUsia']."', '".$_POST['txtAlamat']."', '".$_POST['txtNoHP']."', 
				'1'
				); ";
				// echo $query;
				
				
							
			
			
			if(sql_query($query)) 
			{
				$sukses='1';
				$_SESSION['userid'] = $_POST['txtNoKTP'];
			}
		
		echo $sukses;
	
}
?>