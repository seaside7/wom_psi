<?php
global $urlsite;

$localPageName = $_GET['act'];

include("controller/".$localPageName.".php");

// if(!isset($_SESSION['usersessid'])){
    // echo"<br><br><center><span class=notFound>"._PLEASELOGINUSER."</span></center><br><br>
	// <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
// }  else {
?> 
	<script>var localPageName = "<?php echo $localPageName; ?>"</script>	
	<script type="text/javascript" language="JavaScript" src="js/<?php echo $localPageName; ?>.js"></script>
	<div id="table-list"><?php adminPage(); ?></div>

<?php
// }
?>