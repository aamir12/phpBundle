<?php 
include_once('../config.php');
include_once(BASE_DIR.'/modals/AuthModal.php');

$request = json_decode(file_get_contents("php://input"),true);
if(isset($request['action'])){
	switch ($request['action']) {
        case 'login':
			login($request);
            break;
        case 'lockScreenData':
            lockScreenData($request);
            break;
        case 'unLockScreen':
            unLockScreen($request);
            break;
		default:			
		   break;
	}
}

function login($request){
  $AuthModal = new AuthModal();
  $data = escapemydata($request['data']);
  if(empty($data['email']) || empty($data['password'])){
    jsonResp(false,'Please enter all required fields');
  } 

  $check = $AuthModal->user_login($data);
  if($check == 'Active'){
    jsonResp(true,'Login successfully');
  }else
  if($check == 'Block'){
    jsonResp(false,'Your account is blocked');
  }else{
    jsonResp(false,'Invalid credentials');
  }	
}

function lockScreenData($request){
    $userid = isset($_SESSION['USERID'])? $_SESSION['USERID'] :false;
    if($userid){
        $AuthModal = new AuthModal();
        $data = $AuthModal->fetchLockScreen($userid);
        if($data){
            jsonResp(true,$data);
        }else{
            jsonResp(false,'Session Expired');
        }
    }else{
        jsonResp(false,'Session Expired');
    }
}

function unLockScreen($request){
    $userid = isset($_SESSION['USERID'])? $_SESSION['USERID'] :false;
    if($userid){
        $AuthModal = new AuthModal();
        $data = escapemydata($request['data']);
        if(empty($data['password'])){
          jsonResp(false,'Please enter password');
        } 
        $data['userid'] = $userid;
        $check = $AuthModal->unLockScreen($data);
        if($check){
            jsonResp(true,'Login successfully');
        }else{
            jsonResp(false,'Invalid Password','inCrtPass');
        }
    }else{
        jsonResp(false,'Session Expired');
    }
  	
}
  

?>