<?php

class DashboardModal{
  
     public function statusCount($status,$userid){
          $db = new Database();
          $conn = $db->getConnection();
          $sql ="select count(dId) as status FROM delivery  where dl_userid = '$userid'  and dl_delete ='0' and dl_mode = '$status'" ;
          $query = $conn->query($sql);
          $result = $query->fetch_assoc();
          $conn->close();
          return $result['status']; 
     }

     public function todayFrieght($status,$userid){
          $db = new Database();
          $conn = $db->getConnection();
          $today = date('Y-m-d');
          $sql ="SELECT sum(dl_frieght) as frieght FROM delivery WHERE dl_date = '".$today."'   and dl_mode = '$status' and dl_userid = '$userid'  and dl_delete ='0'" ;
          
          $query = $conn->query($sql);
          $result = $query->fetch_assoc();
          $conn->close();
          return $result['frieght']?$result['frieght']:0; 
     }


     public function lastWeekFright($userid){
          $db = new Database();
          $conn = $db->getConnection();
          $today = date('Y-m-d');
          $sql ="SELECT sum(dl_frieght) as frieght FROM delivery WHERE dl_date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY AND dl_date < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY and dl_mode = 'Paid' and dl_userid = '$userid'  and dl_delete ='0'" ;
          $query = $conn->query($sql);
          $result = $query->fetch_assoc();
          $conn->close();
          return $result['frieght']?$result['frieght']:0; 
     }

     public function totalArea($userid){
          $db = new Database();
          $conn = $db->getConnection();
          $today = date('Y-m-d');
          $sql ="SELECT count(*) as tarea FROM area WHERE area_user = '".$userid."'" ;
          $query = $conn->query($sql);
          $result = $query->fetch_assoc();
          $conn->close();
          return $result['tarea']?$result['tarea']:0; 
     }

}



