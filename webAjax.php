<?php 

include_once('config.php');

$data = json_decode(file_get_contents("php://input"),true);
//echo $data['action'];
//echo json_encode($data);


if(isset($data['action'])){
	switch ($data['action']) {
        case 'login':
			login($data);
			break;
	

		default:			
			break;
	}
}

function login($data){
  unset($data['action']);
  //http_response_code(400);
  $result = $data;
  echo json_encode($result);
  
}

?>