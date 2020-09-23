<?php

class DeliveryModal 
{

    
    public function delete_deliverylist($userid,$ides){
        $db = new Database();
        $conn = $db->getConnection();
        foreach($ides as $id)
        {
            $sql = "update delivery set dl_delete = '1'  where dl_userid = '$userid' and dId = '$id'";
            $conn->query($sql);
        }

        $conn->close();
    }

   
    public function getUniqueMemoNo($userid){
        $db = new Database();
        $conn = $db->getConnection(); 
        
        $sql = "select dl_memono  FROM  delivery  where dl_userid = '".$userid."' order by dId desc limit 1";
        $maxidrow = $conn->query($sql);
        $currentYear = date('y');
        $id = $currentYear.'00000';
        if($maxidrow->num_rows>0)
        {
             $row = $maxidrow->fetch_assoc();
             $maxid = $row['dl_memono'];             
             $numid = (int)(substr($maxid, 2,(strlen($maxid)-1)));
             $numid = $numid+1;
             $len = strlen($numid);
             $numZero = '';
             switch ($len) {
               case 1:
                $id = $currentYear.'0000'.$numid;
                 break;
                 case 2:
                $id = $currentYear.'000'.$numid;
                 break;
                 case 3:
                $id = $currentYear.'00'.$numid;
                 break;
                  case 4:
                $id = $currentYear.'0'.$numid;
                 break;
                  case 5:
                $id = $currentYear.$numid;
                 break;               
               default:
                 $id = ($currentYear+1).'00000';
                 break;
             }
            
        }
        $conn->close();
        return $id;
    }

    public function checkDelId($userid,$dl_memo){
       $db = new Database();
        $conn = $db->getConnection();
        $sql = "select dl_memono  FROM  delivery  where dl_userid = '".$userid."' and dl_memono='".$dl_memo."'";
        $query = $conn->query($sql);

        if($query->num_rows>0)
        {
             $dl_memo = $this->getUniqueMemoNo($userid);            
        }
        $conn->close();
        return $dl_memo;
    }

    public function add_deleivery($data,$userid){
      $data['dl_memono'] = $this->checkDelId($userid,$data['dl_memono']);
      $data['dl_date']    =    DBdate($data['dl_date']);
      $data['dl_biltydate'] = !empty($data['dl_biltydate'])?DBdate($data['dl_biltydate']):'0000-00-00';
      $data['dl_arrivedate'] =!empty($data['dl_arrivedate'])?DBdate($data['dl_arrivedate']):'0000-00-00';

      $db = new Database();
      $conn = $db->getConnection();
      $sql = "insert into delivery( dl_memono,dl_mode,dl_date, dl_area, dl_labour, dl_consignor, dl_consignee, dl_recivedby, dl_dueto, dl_biltyno, dl_biltydate, dl_arrivedate, dl_from, dl_contains, dl_packages, dl_weight, dl_transport, dl_paymode, dl_lorryno, dl_frieght, dl_dc, dl_hammali, dl_demurrage, dl_other, dl_subtotal, dl_tax, dl_total, dl_refund, dl_nettotal, dl_remark, dl_userid ) values( '".$data['dl_memono']."', '".$data['dl_mode']."', '".$data['dl_date']."', '".$data['dl_area']."', '".$data['dl_labour']."', '".$data['dl_consignor']."', '".$data['dl_consignee']."', '".$data['dl_recivedby']."', '".$data['dl_dueto']."', '".$data['dl_biltyno']."', '".$data['dl_biltydate']."', '".$data['dl_arrivedate']."', '".$data['dl_from']."', '".$data['dl_contains']."', '".$data['dl_packages']."', '".$data['dl_weight']."', '".$data['dl_transport']."', '".$data['dl_paymode']."', '".$data['dl_lorryno']."', '".$data['dl_frieght']."', '".$data['dl_dc']."', '".$data['dl_hammali']."', '".$data['dl_demurrage']."', '".$data['dl_other']."', '".$data['dl_subtotal']."', '".$data['dl_tax']."', '".$data['dl_total']."', '".$data['dl_refund']."', '".$data['dl_nettotal']."', '".$data['dl_remark']."', '".$userid."' )";
       
       $query = $conn->query($sql);
       $di_did = $conn->insert_id;

       if(isset($data['hidden-item-product-id']))
       {
          $counter = 0;
          $itData = array();
          foreach($data['hidden-item-product-id'] as $di_pid)
           {
               if($di_pid!="")
               {
                   $itData['di_pid']   = $di_pid;
                   $itData['di_pname'] = $data['hidden-item-product-name'][$counter];              
                   $itData['di_uid']   = $data['hidden-product-unit-id'][$counter];
                   $itData['di_uname'] = $data['hidden-product-unit-name'][$counter];
                   $itData['di_qty']   = $data['hidden-product-qty'][$counter];
                   $itData = escapemydata($itData);
                   extract($itData);             
                   $sql = "INSERT INTO delivery_items (di_pid,di_pname,di_uid,di_uname,di_qty,di_did) VALUES
                       ('$di_pid','$di_pname','$di_uid','$di_uname','$di_qty','$di_did')";
                   $conn->query($sql);
               } 
               
               $counter++;
           }
       }


       $conn->close();
       return $di_did;


    }


    public function get_delivery($userid,$id){
        $db = new Database();
        $condition['where'] = array('dId'=>$id,'dl_userid'=>$userid,'dl_delete'=>0);
        $condition['return_type']='single';
        $data = $db->get('delivery',$condition);
        return $data;
    }

    public function get_delivery_items($did){
        $db = new Database();
        $conn = $db->getConnection(); 
        $allunits = array();
        $sql = "select * FROM  delivery_items  where di_did = '".$did."'";
        $pks = $conn->query($sql);
        if($pks->num_rows>0)
        {
             while ($pk = $pks->fetch_assoc()) {
                  $allunits[] = $pk;
             }
        }
        $conn->close();
        return $allunits;
    }


    public function edit_deleivery($data,$di_did){
      
      $data['dl_date']    =    DBdate($data['dl_date']);
      $data['dl_biltydate'] = !empty($data['dl_biltydate'])?DBdate($data['dl_biltydate']):'0000-00-00';
      $data['dl_arrivedate'] =!empty($data['dl_arrivedate'])?DBdate($data['dl_arrivedate']):'0000-00-00';

     // printerror($data);

      $db = new Database();
      $conn = $db->getConnection();
      $sql = "update delivery set
        dl_mode = '".$data['dl_mode']."',
        dl_date = '".$data['dl_date']."',
        dl_area = '".$data['dl_area']."',
        dl_labour =  '".$data['dl_labour']."',
        dl_consignor = '".$data['dl_consignor']."',
        dl_consignee ='".$data['dl_consignee']."' ,
        dl_recivedby = '".$data['dl_recivedby']."',
        dl_dueto = '".$data['dl_dueto']."',
        dl_biltyno= '".$data['dl_biltyno']."',
        dl_biltydate = '".$data['dl_biltydate']."',
        dl_arrivedate = '".$data['dl_arrivedate']."',
        dl_from = '".$data['dl_from']."',
        dl_contains = '".$data['dl_contains']."',
        dl_packages = '".$data['dl_packages']."',
        dl_weight = '".$data['dl_weight']."',
        dl_transport = '".$data['dl_transport']."',
        dl_paymode = '".$data['dl_paymode']."',
        dl_lorryno = '".$data['dl_lorryno']."',
        dl_frieght = '".$data['dl_frieght']."',
        dl_dc = '".$data['dl_dc']."',
        dl_hammali = '".$data['dl_hammali']."',
        dl_demurrage = '".$data['dl_demurrage']."',
        dl_other = '".$data['dl_other']."',
        dl_subtotal ='".$data['dl_subtotal']."' ,
        dl_tax = '".$data['dl_tax']."',
        dl_total = '".$data['dl_total']."',
        dl_refund = '".$data['dl_refund']."',
        dl_nettotal = '".$data['dl_nettotal']."',
        dl_remark = '".$data['dl_remark']."',
        dl_updateAt = '".currenttime()."'
         where did = '".$di_did."'";
       
      
        $query = $conn->query($sql);
        $sql = "delete from delivery_items where di_did = '".$di_did."'";
        $conn->query($sql);

         if(isset($data['hidden-item-product-id']))
         {
            $counter = 0;
            $itData = array();
            foreach($data['hidden-item-product-id'] as $di_pid)
             {
                 if($di_pid!="")
                 {
                     $itData['di_pid']   = $di_pid;
                     $itData['di_pname'] = $data['hidden-item-product-name'][$counter];              
                     $itData['di_uid']   = $data['hidden-product-unit-id'][$counter];
                     $itData['di_uname'] = $data['hidden-product-unit-name'][$counter];
                     $itData['di_qty']   = $data['hidden-product-qty'][$counter];
                     $itData = escapemydata($itData);
                     extract($itData);             
                     $sql = "INSERT INTO delivery_items (di_pid,di_pname,di_uid,di_uname,di_qty,di_did) VALUES
                         ('$di_pid','$di_pname','$di_uid','$di_uname','$di_qty','$di_did')";
                     $conn->query($sql);
                 } 
                 
                 $counter++;
             }
         }


       $conn->close();
       return $di_did;


    }


    public function filter_delivery($userid){
            $resultArray = array(
            "records" =>"",
            "pagination" => "",
            "totalcommission"=>0,
            "totalhammali"=>0,
            "totalfrieght"=>0
            );
            $db = new Database();
            $conn = $db->getConnection();
            $cond = "";
            $condArr = array();
            $keyword = isset($_POST['keyword'])?mysqli_real_escape_string($conn,$_POST['keyword']):'';
            $status = isset($_POST['status'])?mysqli_real_escape_string($conn,$_POST['status']):'';
            $area = isset($_POST['area'])?mysqli_real_escape_string($conn,$_POST['area']):'';

            $from = !empty($_POST['searchfromdate'])?DBdate($_POST['searchfromdate']):'';

            $to = !empty($_POST['searchtodate'])?DBdate($_POST['searchtodate']):'';

            $sort = isset($_POST['sortby'])?mysqli_real_escape_string($conn,$_POST['sortby']):' dl_createAt desc ';
            $sortby = ' order by '.$sort;
            $page = isset($_POST['page'])?$_POST['page']:'1';


            if($area!="")
            {
              $condArr[] = "  d.dl_area = '$area' ";
            }

            if($status!="")
            {
              $condArr[] = "  d.dl_mode = '$status' ";
            }
           
            
            if($keyword!="")
            {
               $condArr[] = " ( d.dl_biltyno like '%$keyword%' or d.dl_memono like '%$keyword%' ) ";
            }

            if($from!="" && $to=="")
            {
               $condArr[] = " d.dl_date like '%$from%' ";
            }

            if($from=="" && $to!="")
            {
                $condArr[] = " d.dl_date like '%$to%' ";
            }


            if($from!="" && $to!="")
            {
                $condArr[] = " d.dl_date between '$from'  and '$to' ";
            }  


            
           
            
            if(count($condArr)>0)
            {
            $cond = " and ( ".implode(" and ",$condArr)." )";
            }
            
            
            
             $cur_page = $page;
             $page -= 1;
             $per_page = 10;
             $start = $page * $per_page;

              $sql = "select d.dId, d.dl_biltyno, d.dl_memono,d.dl_frieght, d.dl_dc,d.dl_hammali,d.dl_nettotal,a.name as area,d.dl_mode  FROM  delivery d left join area a on d.dl_area = a.aId   where d.dl_userid = '$userid' and d.dl_delete ='0'  ".$cond ;
             
            
            $querynumrows = $conn->query($sql);
            $totalrecords =  $querynumrows->num_rows;

            $sql =  "select d.dId, d.dl_biltyno, d.dl_memono,d.dl_frieght, d.dl_dc,d.dl_hammali,d.dl_nettotal,a.name as area,d.dl_mode  FROM  delivery d left join area a on d.dl_area = a.aId   where d.dl_userid = '$userid'  and d.dl_delete ='0'   ".$cond." ".$sortby."   LIMIT $start, $per_page " ;
            
            
           
            $result = $conn->query($sql);
            if($result->num_rows>0)
            {
             $records = "";
             while($row = $result->fetch_assoc())
             {
               
               $paid='';
               $due='';
                if($row['dl_mode']=="Due"){
                   $cls = 'badge-danger';
                   $due='selected = "selected"';
                }else{
                   $cls = 'badge-success';                
                   $paid='selected = "selected"';
                }

              $mode = '<span id="spanst-'.$row['dId'].'" class="badge '.$cls.' cur_pointer" onclick="showSelectSt('.$row['dId'].')">'.$row['dl_mode'].'</span>';
              $mode.='<select id="stat-'.$row['dId'].'" style="display:none;padding: 2px 0px;">';
              $mode.='<option value="Due" '.$due.'>Due</option><option value="Paid" '.$paid.'>Paid</option>';
              $mode.='</select>';
              $mode.='<div style="margin-top:10px;"><input type="hidden" id="default-state-'.$row['dId'].'" value="'.$row['dl_mode'].'"><button type="button" style="display:none;" id="btnst-'.$row['dId'].'" class="btn btn-xs btn-info save-xs-btn" onclick="savestatus('.$row['dId'].')">save</button><button type="button" style="display:none;margin-left:3px !important;" id="btncancel-'.$row['dId'].'" class="btn btn-xs btn-danger save-xs-btn"  onclick="cancelStat('.$row['dId'].')">cancel</button></div>';

              $records.='<tr> 
              <td class="text-center"><input type="checkbox" class="selectall" name="delIds[]" value="'.$row['dId'].'" /></td>
              <td >'.$row['dl_biltyno'].'</td>
              <td >'.$row['dl_memono'].'</td>
               <td >'.$row['dl_frieght'].'</td>
                <td >'.$row['dl_dc'].'</td>
                 <td >'.$row['dl_hammali'].'</td>
                  <td >'.$row['dl_nettotal'].'</td> 
                  <td >'.$mode.'</td> 
                  <td >'.$row['area'].'</td>                  
              <td class="text-center"><a href="'.MAIN_URL.'editdelivery.php?id='.$row['dId'].'" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a>
               <br> 
              <button style="margin-top:5px;" onclick="openPDF(\''.$row['dId'].'\')" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Print</a></td>

              
              </tr>'; 
             
             }

            $sql ="select sum(d.dl_frieght) as fr, sum(d.dl_dc) as dc, sum(d.dl_hammali) as hm,sum(d.dl_nettotal) as nt FROM delivery d where d.dl_userid = '$userid'  and d.dl_delete ='0' ".$cond ;
            $query = $conn->query($sql);
            if($query){
              $res = $query->fetch_assoc();
              $records.='<tr> 
              <td></td>
              <td ></td>
              <td ><strong>Total</strong></td>
              <td ><strong>'.$res['fr'].'</strong></td>
              <td ><strong>'.$res['dc'].'</strong></td>
              <td ><strong>'.$res['hm'].'</strong></td>
              <td ><strong>'.$res['nt'].'</strong></td>  
              <td></td>
              <td ></td>    
              <td></td>
              </tr>';
            } 


             $resultArray['records'] = $records;
             $resultArray['pagination'] = Pagination::ajax_pagination(true,true , $per_page ,$cur_page ,$totalrecords ); 
             
            }else
            {
             $resultArray['records'] ='<tr><td colspan="10" class="text-center"> No Records Found </td></tr>';
             $resultArray['pagination'] = '';
            }
            
            
            $conn->close();
            return $resultArray;
    }

   
     public function filter_Pdf($userid,$data){
            
            $db = new Database();
            $conn = $db->getConnection();
            $cond = "";
            $condArr = array();
           
            $status = isset($data['status'])?mysqli_real_escape_string($conn,$data['status']):'';
            $area = isset($data['area'])?mysqli_real_escape_string($conn,$data['area']):'';

            $from = !empty($data['searchfromdate'])?DBdate($data['searchfromdate']):'';

            $to = !empty($data['searchtodate'])?DBdate($data['searchtodate']):'';

            $sort = ' dl_createAt asc ';
            $sortby = ' order by '.$sort;
           


            if($area!="")
            {
              $condArr[] = "  d.dl_area = '$area' ";
            }

            if($status!="")
            {
              $condArr[] = "  d.dl_mode = '$status' ";
            }
           
            
          

            if($from!="" && $to=="")
            {
               $condArr[] = " d.dl_date like '%$from%' ";
            }

            if($from=="" && $to!="")
            {
                $condArr[] = " d.dl_date like '%$to%' ";
            }


            if($from!="" && $to!="")
            {
                $condArr[] = " d.dl_date between '$from'  and '$to' ";
            }  


            
           
            
            if(count($condArr)>0)
            {
            $cond = " and ( ".implode(" and ",$condArr)." )";
            }
            
            $sql = "select d.dId, d.dl_biltyno, d.dl_memono,d.dl_frieght, d.dl_dc,d.dl_hammali,d.dl_nettotal,d.dl_mode , d.dl_packages, di.di_pname ,di.di_uname,d.dl_consignee,di.di_qty  FROM  delivery d left join area a on d.dl_area = a.aId  right join delivery_items di on di.di_did = d.dId  where d.dl_userid = '9' and d.dl_delete ='0'    ".$cond." ".$sortby ;
             
            $response = array();
            $allresult = array();
            $result = $conn->query($sql);                        
            if($result->num_rows>0)
            {
             $did = "";
             while($row = $result->fetch_assoc())
             {  
                if($did!=$row['dId']){
                  $did = $row['dId'];
                  $response['frno'] = $row['dl_memono'];
                  $response['lrno'] = $row['dl_biltyno'];
                  $response['pkges'] = $row['di_qty'];
                  $response['pkgs'] = $row['dl_packages'];
                  $response['Packing'] = $row['di_uname'];
                  $response['biltyItem'] = $row['di_pname'];
                  $response['consignee'] = $row['dl_consignee'];
                  $response['frieght'] = $row['dl_frieght'];
                  $response['dc'] = $row['dl_dc'];
                  $response['hamm'] = $row['dl_hammali'];
                  $response['total'] = $row['dl_nettotal'];                  
                }else{
                  $response['frno'] = '';
                  $response['lrno'] = '';
                  $response['pkges'] = $row['di_qty'];
                  $response['pkgs'] = '';
                  $response['Packing'] = $row['di_uname'];
                  $response['biltyItem'] = $row['di_pname'];
                  $response['consignee'] = $row['dl_consignee'];
                  $response['frieght'] = '';
                  $response['dc'] = '';
                  $response['hamm'] = '';
                  $response['total'] = '';
                }
                $allresult[] = $response;
             
             }

            }            
            $conn->close();
            return $allresult;
    }


    public function change_delivery_status($data){
        $db = new Database();
        $conn = $db->getConnection();

         $prodata = array(
             'dl_mode'=> $data['dl_mode'],            
             'dl_updateAt'=> currenttime()
        );
        $condition = array('dId'=>$data['dId'],'dl_userid'=>$data['userid']);
        $db->update('delivery',$prodata,$condition);
        $conn->close();
        return true;  
    }





}



