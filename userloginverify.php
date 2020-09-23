<?php 
if(!isset($_SESSION['ISLOGIN'])){
	if(isset($_SESSION['USERID'])){
		echo '<script type="text/javascript">window.location="'.MAIN_URL.'lockscreen.php";</script>';
	}else{
		echo '<script type="text/javascript">window.location="'.MAIN_URL.'login.php";</script>';
	}
}

?>