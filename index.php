<?php

$act = $_REQUEST['act'];  if(empty($act)) {$act = 'home';}
session_start();
//$_SESSION['usersessid'] = 'admin';
include('config/conn.php');
if(!empty($act)){
include_once('function/sqlfunction.php');
}
require_once('function/tmplfunction.php');
require_once('function/mainfunction.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>WOM Finance | Psikotest Online</title>
	<link href="css/custom2.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/tooltipster.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.timer.js"></script>
	<script type="text/javascript" src="js/jquery.msgbox.js"></script>
	<script type="text/javascript" src="js/jquery.tooltipster.min.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<!--<script type="text/javascript" src="js/dataTables.tableTools.js"></script>-->
	<script type="text/javascript" src="js/jquery.dataTables.columnFilter.js"></script>
	<script>
  	function maxLengthCheck(object) {
	    if (object.value.length > object.maxLength)
	      object.value = object.value.slice(0, object.maxLength)
	}
	</script>
	<?php if($act=='papi' || $act=='wpt'){?>
	<script type="text/javascript" src="js/prototype.js"></script>
	<?php } ?>
	<?php if($act=='chartjs'){?>
	
    <link href="css/custom.css" rel="stylesheet">
    <script src="js/custom.js"></script>
	<?php } ?>
	<?php if($act=='chartjs' || $act=='papi'){?>
	
	<link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/icheck/flat/green.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>
	
	<script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>

	<?php } ?>
</head>

<body>

	<div id="hheaderCont">
	<div id="hheader">
    <div class="headerLogo" >
		<a href="?"><img src="images/logo-WOM.png" width="86" height="45"></a>
	</div>
		
		</div></div>
	<div id="content">
		<?php showpage('',$act);?>
	</div>
</body>
</html>
