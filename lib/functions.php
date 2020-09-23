<?php 

function currenttime(){
   $date = date('Y-m-d H:i:s');
   return $date;
}

function userLoggedIn(){
   if(!isset($_SESSION['ISLOGIN'])){
      if(isset($_SESSION['USERID'])){
         echo '<script type="text/javascript">window.location="'.MAIN_URL.'lockscreen.php";</script>';
      }else{
         echo '<script type="text/javascript">window.location="'.MAIN_URL.'login.php";</script>';
      }
   }
}

function isLockScreen(){
   if(!isset($_SESSION['ISLOGIN'])){
      if(!isset($_SESSION['USERID'])){
         echo '<script type="text/javascript">window.location="'.MAIN_URL.'login.php";</script>';
      }
   }
}


function logData($user,$action){
    $db =  new Database();     
    $db->insert('user_log',array('ul_userid'=>$user, 'ul_time'=>currenttime(),'ul_action'=>$action));
}

function logout(){
  if(isset($_SESSION['USERID'])) {
     unset($_SESSION['USERID']);
     unset($_SESSION['ISLOGIN']); 
     unset($_SESSION['USERTYPE']);
     unset($_SESSION['LASTLOGIN']);  
     unset($_SESSION['USER_FNAME']);       
     unset($_SESSION['PHOTO']);           
  } 
}

function setInput($data,$key,$type,$match=''){
  if(!empty($data[$key])){
 
    $val = $data[$key];
    switch ($type) {
      case 'select':
       echo $val==$match?'selected="selected"':'';
      break;
      case 'checkbox':
         if(is_array($val)){
          echo  in_array($match, $val)?'checked="checked"':'';          
         }else 
         echo  $val==$match?'checked="checked"':'';
       
      break;
      case 'input':
        echo $val;
      break;    
     
    }
      
  }

}

function set_sessionarray($sessionarray){

   foreach($sessionarray as $sa)
   {
      if($sa[0]=='success')
      {
        $heading = 'Success !';
        $icon = '<i class="icon-check_circle"></i>'; 
      }

      if($sa[0]=='danger')
     {
       $heading = 'Error !';
       $icon = '<i class="icon-cross2"></i>';
     }

      $_SESSION['session_array'][] =  '<div class="alert alert-'.$sa[0].' alert-dismissable">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>'.$icon.'
   <strong>'.$heading.'</strong> '.$sa[1].'
   </div>'; 
   } 


   
}

function get_sessionarray(){

   if(isset($_SESSION['session_array']))
    {
        
      foreach($_SESSION['session_array'] as $sa) 
       { echo  $sa; }

       unset($_SESSION['session_array']);
    }

}



function setmessage($type,$msg){
   if($type=='success'){
     $icon = '<h5><i class="icon fas fa-ban"></i> Success !</h5>';
   }

   if($type=='danger'){
     $icon = '<h5><i class="icon fas fa-ban"></i> Error !</h5>';
   }
   $_SESSION['mymsg'] = '<div class="alert alert-'.$type.' alert-dismissable">
   <button type="button" class="close" data-dismiss="alert" aria-label="close">x</button>'.$icon.'</strong> '.$msg.'</div>'; 
   echo $_SESSION['mymsg'];
}

function getmessage(){
    if(isset($_SESSION['mymsg']))
    { 
     echo  $_SESSION['mymsg'];
     unset($_SESSION['mymsg']);
    }
}


function escape($str){
    $db =  new Database(); 
    $conn = $db->getConnection();    
    $str = trim(mysqli_real_escape_string($conn,$str));
    $conn->close(); 
    return $str;
}
 
function escapemydata($data = array()){
   $db =  new Database(); 
   $conn = $db->getConnection();  
   foreach($data as $key => $value)
   { if(!is_array($value))
     $data[$key] = trim(mysqli_real_escape_string($conn,$value));
   }
   $conn->close(); 
   return $data;
}

function printerror($data){
  echo '<pre>';
  print_r($data);
  echo '</pre>';
  die();
}



function dMY($date){
  $d=date_create($date);
  return date_format($d,"d F Y");
}

function DBdate($date){
   $d=date_create($date);
   return date_format($d,'Y-m-d H:i:s');
}

function pdfDate($date){
   $d=date_create($date);
   return date_format($d,'d/m/y');
}

function textboxDate($str){
   if($str=="" || $str == "0000-00-00")
   {
      return "";
   }else{
      $d=date_create($str);
      return date_format($d,"d-M-Y");
   } 
}


function stringUnique($str){
  $itemArray = explode(',',$str);
  $itar = array();
  foreach($itemArray as $ia)
  {
     $itar[] = ucfirst($ia);
  }

  $itar = array_unique($itar);
  $str = implode(',',$itar);
  return $str;
}

function jsonResp($status,$message,$code='invalid'){
   if($status){
      http_response_code(200);
   }else{
      http_response_code(400);
   }
   echo json_encode(['status'=>$status,'msg'=>$message,'code'=>$code]); 
   die();
}

?>