<?php
global $urlsite;

if(!empty($_GET['act'])){
	$localPageName = $_GET['act']; 
}

include("controller/mpass.php");

// if(!isset($_SESSION['usersessid'])){
    // echo"<br><br><center><span class=notFound>"._PLEASELOGINUSER."</span></center><br><br>
	// <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
// }  else {
?> 
	<script>var localPageName = "<?php echo 'mpass'; ?>"</script>	
	<script type="text/javascript" language="JavaScript" src="js/<?php echo 'mpass'; ?>.js"></script>
	<div id="table-list"><?php LoginForm(); ?></div>

<?php
// }
?>