<?php
global $urlsite;

if(!empty($_GET['act'])){
	$localPageName = $_GET['act']; 
}

include("controller/login.php");

// if(!isset($_SESSION['usersessid'])){
    // echo"<br><br><center><span class=notFound>"._PLEASELOGINUSER."</span></center><br><br>
	// <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>";
// }  else {
?> 
	<script>var localPageName = "<?php echo 'login'; ?>"</script>	
	<script type="text/javascript" language="JavaScript" src="js/<?php echo 'login'; ?>.js"></script>
	<div id="table-list"><?php LoginForm(); ?></div>

<?php
// }
?>