<?php 
include_once('../config.php');
include_once(BASE_DIR.'/modals/UserModal.php');

$request = json_decode(file_get_contents("php://input"),true);
if(isset($request['action'])){
	switch ($request['action']) {
        case 'myProfile':
			myProfile();
            break;
        case 'updateProfile':
            updateProfile($request);
            break;
        case 'updatePassword':
            updatePassword($request);
            break;
		default:			
		   break;
	}
}



function updateProfile($request){
    $userid = isset($_SESSION['USERID'])? $_SESSION['USERID'] :false;
    if($userid){
        $UserModal = new UserModal();
        $data = escapemydata($request['data']);
        $UserModal->updateProfile($data,$userid);
        $_SESSION['USER_FNAME'] = $data['firstName'];
        jsonResp(true,'Profile Update Successfully');
        
    }else{
        jsonResp(false,'Session Expired','sessExp');
    }
}

function myProfile(){
    $userid = isset($_SESSION['USERID'])? $_SESSION['USERID'] :false;
    if($userid){
        $UserModal = new UserModal();
        $data = $UserModal->getMyProfile($userid);
        if($data){
            jsonResp(true,$data);
        }
    }else{
        jsonResp(false,'Session Expired');
    }
}

function updatePassword($request){
    $userid = isset($_SESSION['USERID'])? $_SESSION['USERID'] :false;
    if($userid){
        $UserModal = new UserModal();
        $data = escapemydata($request['data']);
        $data['password'] = md5($data['password']);
        unset($data['oldPassword']);
        $UserModal->updateProfile($data,$userid);
        jsonResp(true,'Password change Successfully');
        
    }else{
        jsonResp(false,'Session Expired','sessExp');
    }
}


  

?>