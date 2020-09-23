<?php 
include_once('config.php');

if(isset($_POST['action'])){

	switch ($_POST['action']) {
		case '1':
			  check_emailid();
			break;
		case '2':
			  check_userid();
			break;

    case '3':
         filter_product();
         break;
    case '4' :
        filter_area();
        break;

    case '5' :
        filter_packingunit();
        break;

    case '6' :
        check_productName();
        break; 
     case '7' :
        check_areaName();
        break; 

     case '8' :
        check_packingunitName();
        break;
     case '9' :
        addProduct();
        break; 
     case '10' :
        addUnit();
        break;
    case '11' :
        addArea();
        break;
     case '12' :
        filter_delivery();
        break;
    case '13' :
        change_delivery_status();
        break;

		default:			
			break;
	}
}



function check_emailid(){
   include_once BASE_DIR . '/modals/UserModal.php';
   $UserModal= new UserModal();
   $email = escape($_POST['use_email']);
   $check = $UserModal->checkemailid($email);
   if($check)
    {
      echo json_encode(false);
    }else
    {
       echo json_encode(true);
    } 
}

function check_userid(){
   include_once BASE_DIR . '/modals/UserModal.php';
   $UserModal= new UserModal();
   $userid = escape($_POST['use_user_id']);
   $check = $UserModal->checkuserid($userid);
   if($check)
    {
      echo json_encode(false);
    }else
    {
       echo json_encode(true);
    }

}


function filter_product(){
  require_once BASE_DIR . '/modals/ProductModal.php';  
  $ProductModal = new ProductModal();
  $userid = $_SESSION['user_id'];
  $result = $ProductModal->filter_product($userid);
  echo json_encode($result);

}

function filter_area(){
  require_once BASE_DIR . '/modals/AreaModal.php';  
  $AreaModal = new AreaModal();
  $userid = $_SESSION['user_id'];
  $result = $AreaModal->filter_area($userid);
  echo json_encode($result);

}

function filter_packingunit(){
  require_once BASE_DIR . '/modals/PackingUnitModal.php';  
  $PackingUnitModal = new PackingUnitModal();
  $userid = $_SESSION['user_id'];
  $result = $PackingUnitModal->filter_packingunit($userid);
  echo json_encode($result);

}

function check_productName(){
  require_once BASE_DIR . '/modals/ProductModal.php';  
  $ProductModal = new ProductModal();
  $productName = strtolower(escape($_POST['name']));
  $preProductName = strtolower(escape($_POST['preName']));
  $userid = $_SESSION['user_id'];
  if($productName==$preProductName)
  {
    echo json_encode(true);
  }else
  {
    $check = $ProductModal->check_productName($userid,$productName);
    if($check)
    echo json_encode(false);
    else
    echo json_encode(true);
  }

}


function check_areaName(){
  require_once BASE_DIR . '/modals/AreaModal.php';  
  $AreaModal = new AreaModal();
  $productName = strtolower(escape($_POST['name']));
  $preProductName = strtolower(escape($_POST['preName']));
  $userid = $_SESSION['user_id'];
  if($productName==$preProductName)
  {
    echo json_encode(true);
  }else
  {
    $check = $AreaModal->check_areaName($userid,$productName);
    if($check)
    echo json_encode(false);
    else
    echo json_encode(true);
  }

}


function check_packingunitName(){
  require_once BASE_DIR . '/modals/PackingUnitModal.php';  
  $PackingUnitModal = new PackingUnitModal();
  $productName = strtolower(escape($_POST['name']));
  $preProductName = strtolower(escape($_POST['preName']));
  $userid = $_SESSION['user_id'];
  if($productName==$preProductName)
  {
    echo json_encode(true);
  }else
  {
    $check = $PackingUnitModal->check_packingunitName($userid,$productName);
    if($check)
    echo json_encode(false);
    else
    echo json_encode(true);
  }

}


function addProduct(){
  require_once BASE_DIR . '/modals/ProductModal.php';  
  $ProductModal = new ProductModal();
  $data = [];
  $result = [];
  $data['pro_userid'] = $_SESSION['user_id'];
  $data['name'] = escape($_POST['name']);
  $result['pid'] = $ProductModal->add_product($data);
  $result['label'] = $data['name'];
  $result['value'] = $data['name'];
  echo json_encode($result);
}


function addUnit(){
  require_once BASE_DIR . '/modals/PackingUnitModal.php';  
  $PackingUnitModal = new PackingUnitModal();
  $data = [];
  $result = [];
  $data['pku_user'] = $_SESSION['user_id'];
  $data['name'] = escape($_POST['name']);
  $result['uid'] = $PackingUnitModal->add_packingunit($data);
  $result['label'] = $data['name'];
  $result['value'] = $data['name'];
  echo json_encode($result);
}

function addArea(){
  require_once BASE_DIR . '/modals/AreaModal.php';  
  $AreaModal = new AreaModal();
  $data = [];
  $result = [];
  $data['area_user'] = $_SESSION['user_id'];
  $data['name'] = escape($_POST['name']);
  $result['id'] = $AreaModal->add_area($data);
  $result['name'] = $data['name'];  
  echo json_encode($result);
}

function filter_delivery(){
  require_once BASE_DIR . '/modals/DeliveryModal.php';  
  $DeliveryModal = new DeliveryModal();
  $userid = $_SESSION['user_id'];
  $result = $DeliveryModal->filter_delivery($userid);
  echo json_encode($result);
}

function change_delivery_status(){
  require_once BASE_DIR . '/modals/DeliveryModal.php';  
  $DeliveryModal = new DeliveryModal();
  $data['userid'] = $_SESSION['user_id'];
  $data['dId'] = $_POST['id'];
  $data['dl_mode'] = $_POST['status'];
  $result = $DeliveryModal->change_delivery_status($data);
  echo json_encode($result);
}

?>