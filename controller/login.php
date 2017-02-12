<?php
function LoginForm(){
    $formName = 'formLogin';
	$content = '<form action="#" method="post" enctype="multipart/form-data" name="'.$formName.'" id="'.$formName.'">';
	$content .= "<table id=tbLogin align='center' border='0' width='450px'>";
	$content .= "<tr>";
	$content .= "<td width='35%'>Username</td><td width='5%' style='text-align:center;'>:</td>";
	$content .= "<td width='60%'><input type='text' id='txtUsername' name='txtUsername' size='30'></td>";
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
}
?>