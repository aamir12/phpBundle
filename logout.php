<?php 
include_once('config.php');
if(isset($_REQUEST['type'])){
	$type = $_REQUEST['type'];
	if($type == 'logout'){
		if(isset($_SESSION['USERID'])) {
			logData($_SESSION['USERID'],'Logout');
			logout();
		}
		echo '<script type="text/javascript">window.location="'.MAIN_URL.'login.php";</script>';
	}else
	if($type == 'lock'){
		if(isset($_SESSION['USERID'])) {
			logData($_SESSION['USERID'],'Lock Screen');
			unset($_SESSION['ISLOGIN']);
			echo '<script type="text/javascript">window.location="'.MAIN_URL.'lockscreen.php";</script>';
		}
		
	}
	
}



?>