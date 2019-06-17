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
				style="border:none; margin-left:8px; vertical-align:baseline;" /></a></div></div>';
	echo $content;
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