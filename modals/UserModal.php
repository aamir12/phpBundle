<?php

class UserModal{

   public function getLogs($userid){
      $db = new Database();
      $data = $db->get('user_log',['
      where'=>['ul_userid'=>$userid],
      'order_by'=>'ul_time desc']);
      $logs = [];
      if($data){
         $logs = $data;
      }
      return $logs;
   }

   public function getUser($userid){
        $db = new Database();
        $condition['where'] = array('userid'=>$userid);
        $condition['return_type']='single';
        $data = $db->get('users',$condition);
        return $data;  
   }

   public function getMyProfile($userid){
     $info  = $this->getUser($userid);
     unset($info['password']) ;
     $user = [
        'info' =>$info,
        'logs' => $this->getLogs($userid)
     ];
     return $user;
   }

   public function updateProfile($data,$userid,$action){
      $db = new Database();
      $condition = array('userid'=>$userid);
      $db->update('users',$data,$condition);
      logData($userid,$action);
   }

   
}



