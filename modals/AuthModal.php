<?php

class AuthModal 
{

  public function user_login($data){ 
     $db = new Database();
     $status = 'Invalid';
      $sql = "select * from users where email = '".$data['email']."'";
     $userdata = $db->execute($sql,'single');
     if($userdata){
        if($userdata['password']==md5($data['password'])){
          if($userdata['status'] == 'Active'){
            $_SESSION['USERID'] = $userdata['userid'];
            $_SESSION['ISLOGIN']  = true;
            $_SESSION['LASTLOGIN'] = $userdata['lastLogin'];
            $_SESSION['USERTYPE'] = $userdata['userType'];
            $_SESSION['PHOTO'] = $userdata['photo'];
            $_SESSION['USER_FNAME'] = is_null($userdata['firstName'])?'User':$userdata['firstName'];
            $update_data  = array('lastLogin'=> currenttime());
            $update_condition =  array('userid' => $userdata['userid']);
            $db->update('users',$update_data,$update_condition );
            logData($userdata['userid'],'Login');
            $status = 'Active'; //login successfully
          }else{
             $status = 'Block';
          }
         
        }else{
           logData($userdata['userid'],'Invalid_Login');
           logout();
        }   
    } 

    return $status;
  }

   public function fetchLockScreen($userid){ 
      $db = new Database();
      $status = false;
      $sql = "select * from users where userid = '".$userid."'";
      $userdata = $db->execute($sql,'single');
      if($userdata){
         if($userdata['status'] == 'Active'){
         $status = [
            'firstName' => $userdata['firstName'],
            'lastName' => $userdata['lastName'],
            'photo' => $userdata['photo']
         ]; 
         }  
      }
      return $status;
   }

   public function unLockScreen($data){ 
      $db = new Database();
      $status = false;
      $sql = "select * from users where userid = '".$data['userid']."' and password = md5(".$data['password'].")";
      $userdata = $db->execute($sql,'single');
      if($userdata){
         if($userdata['status'] == 'Active'){
            $_SESSION['ISLOGIN']  = true;
            $status = true;
         }  
      }
      return $status;
   }


   public function checkemailid($email){ 
     $db = new Database();
     $status = 2;
     $condition = array(
      'where' => array('use_email'=>$email),
      'return_type'=>'count'
     );
     $data = $db->get('users',$condition);
     if($data)
        return 1;
     else    
        return 0;
   }


   public function checkuserid($userid){ 
     $db = new Database();
     $status = 2;
     $condition = array(
      'where' => array('use_user_id'=>$userid),
      'return_type'=>'count'
     );
     $data = $db->get('users',$condition);
     if($data)
        return 1;
     else    
        return 0;
   }
   

   public function get_userdata_by_userid($userid){
        $db = new Database();
        $condition['where'] = array('use_user_id'=>$userid);
        $condition['return_type']='single';
        $data = $db->get('users',$condition);
        return $data;  
   }


   public function get_user($userid)
   {
        $db = new Database();
        $condition['where'] = array('user_id'=>$userid);
        $condition['return_type']='single';
        $data = $db->get('users',$condition);
        return $data;  
   }


   public function general_user_registration($data){
        $db = new Database();
        $userdata = array(
          'use_email'=>$data['use_email'],
          'use_password'=>$data['use_password'],
          'use_user_id'=>$data['use_user_id'],
          'use_phone'=>$data['com_phone'],
          'use_fullname'=>$data['com_contactname']
        );
      
        $userid = $db->insert(' users',$userdata);    
        $companydata = array(
        'com_company_name'=>$data['com_company_name'],
        'com_user_id'=>$userid,
        'com_company_type'=>$data['com_company_type'],
        'com_pan'=>$data['com_pan'],
        'com_gstin'=>$data['com_gstin'],
        'com_address_line1'=>$data['com_address_line1'],
        'com_address_line2'=>$data['com_address_line2'],
        'com_state'=>$data['com_state'],
        'com_city'=>$data['com_city'],
        'com_pincode'=>$data['com_pincode'],
        'com_contactname'=>$data['com_contactname'],
        'com_email'=>$data['use_email'],
        'com_phone'=>$data['com_phone'],
        'banktc'=>'Subject to our home Jurisdiction.
        Our Responsibility Ceases as soon as goods leaves our Premises.
        Goods once sold will not taken back.
        Delivery Ex-Premises.',
        'quotationtc'=>'Subject to our home Jurisdiction.
        Our Responsibility Ceases as soon as goods leaves our Premises.
        Goods once sold will not taken back.
        Delivery Ex-Premises.'
        );
        
        $db->insert('company',$companydata);

        $module_status_data = array(
           'mod_name' => 'Inventory Option',
           'mod_uniqueid' => 'INVENTORY_OPTION',
           'mod_userid' => $userid
        );

        $db->insert('module_status',$module_status_data);
        return $userid; 
    
   }

   public function email_verify($idmd5){
        $db = new Database();
        $condition['where'] = array('md5(user_id) '=>$idmd5);
        $condition['return_type']='single';
        $data = $db->get('users',$condition);
        if($data)
        {
           $condition = array('user_id'=>$data['user_id']);
           $data=array('use_email_verified'=>'1');
           $db->update('users',$data,$condition);

           return 1;
        }else{
          return 0;
        }  
   }

    public function update_user($data,$user_id){
        $db = new Database();
        $condition = array('user_id'=>$user_id);
        $db->update('users',$data,$condition);
    }
   

    public function delete($id){
        $db = new Database();
        $condition = array('id'=>$id);
        $data = $db->delete('contacts',$condition);
        return $data;
    }

    public function checkOldPassword($userid,$password){
        $db = new Database();
        $condition['where'] = array('user_id'=>$userid,'use_password'=>md5($password));
        $condition['return_type']='single';
        $data = $db->get('users',$condition);
        return $data;  
    }
}



