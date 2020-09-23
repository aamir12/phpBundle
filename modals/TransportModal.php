<?php

class TransportModal 
{


    public function get_transport($userid,$id) 
    {
        $db = new Database();
        $condition['where'] = array('transid'=>$id,'tp_userid'=>$userid);
        $condition['return_type']='single';
        $data = $db->get(' transport',$condition);
        return $data;

    }


    public function get_alltransport($userid)
    {
        $db = new Database();
        $conditions['where'] = array('tp_userid' =>$userid);
        $data = $db->get('transport',$conditions);

        return $data;
    }

    public function add_transport($data) 
    {
        $db = new Database();
        $transid = $db->insert(' transport',$data);
        return $transid;

    }

    public function update_transport($data,$id,$userid) 
    {
        $db = new Database();
        $condition = array('transid'=>$id,'tp_userid'=>$userid);
        $db->update(' transport',$data,$condition);
    }

     public function delete_transport($userid,$ides) 
    {
        $db = new Database();
        $conn = $db->getConnection();
        $undeletedproduct = '';
        $isdelete = '';
        $deletestatus =array(
            'undeletedproduct' => '',
            'isdelete' => 'No'
        );

        foreach($ides as $id)
        {
            $sql = "select t.name from  transport t inner join sales s on t.transid = s.sl_transportid where t.transid = '$id' and s.sl_deletestatus = '1' and t.tp_userid = '$userid'";
            $salerow = $conn->query($sql);
            if($salerow->num_rows>0)
            {
                 $data = $salerow->fetch_assoc();
                 if($deletestatus['undeletedproduct']=='')
                  $deletestatus['undeletedproduct'] = $data['name'];
                   else
                  $deletestatus['undeletedproduct'] = $deletestatus['undeletedproduct'].','.$data['name']; 
                  
                  continue;

            } 

           $sql = "select t.name from  transport t inner join purchase p on t.transid = p.pu_transportid where t.transid = '$id' and p.pu_deletestatus = '1' and t.tp_userid = '$userid'";
            $purchaserow = $conn->query($sql);
            if($purchaserow->num_rows>0)
            {
                 $data = $purchaserow->fetch_assoc();
                 if($deletestatus['undeletedproduct']=='')
                  $deletestatus['undeletedproduct'] = $data['name'];
                   else
                  $deletestatus['undeletedproduct'] =$deletestatus['undeletedproduct'].','.$data['name']; 
                  continue;

            }


            $sql = "delete from  transport where tp_userid = '$userid' and transid = '$id'";
            $conn->query($sql);
            $deletestatus['isdelete'] = 'Yes';
            
        }  

        $conn->close();
        return $deletestatus;  
        
    }

   public function filter_transport($userid)
   {
            $resultArray = array(
            "records" =>"",
            "pagination" => ""
            );
            $db = new Database();
            $conn = $db->getConnection();
            $cond = "";
            $condArr = array();
            $keyword = isset($_POST['keyword'])?mysqli_real_escape_string($conn,$_POST['keyword']):'';      
            $sort = isset($_POST['sortby'])?mysqli_real_escape_string($conn,$_POST['sortby']):' t.tr_createddate desc ';
            $sortby = ' order by '.$sort;
            $page = isset($_POST['page'])?$_POST['page']:'1';
           
            
            if($keyword!="")
            {
            $condArr[] = " ( t.name like '%$keyword%' or t.transportid like '%$keyword%' or t.vehicleno like '%$keyword%'  ) ";
            }
            
           
            
            if(count($condArr)>0)
            {
            $cond = " and ( ".implode(" and ",$condArr)." )";
            }
            
            
            
             $cur_page = $page;
             $page -= 1;
             $per_page = 10;
             $start = $page * $per_page;

             $sql = "select t.transid ,t.name, t.transportid, t.vehicleno FROM   transport  t where t.tp_userid = '$userid'   ".$cond ;
             
            
            $querynumrows = $conn->query($sql);
            $totalrecords =  $querynumrows->num_rows;

             $sql = "select t.transid ,t.name, t.transportid, t.vehicleno FROM   transport t where t.tp_userid = '$userid'  ".$cond." ".$sortby."   LIMIT $start, $per_page " ;
            
            
            
            $result = $conn->query($sql);
            if($result->num_rows>0)
            {
             $records = "";
             while($row = $result->fetch_assoc())
             {
               


              $records.='<tr> 
              <td class="text-center"><input type="checkbox" class="selectall" name="customers[]" value="'.$row['transid'].'" /></td>
              <td >'.$row['name'].'</td>  
              <td >'.$row['transportid'].'</td>
              <td >'.$row['vehicleno'].'</td>
             
              <td class="text-center"><a href="'.MAIN_URL.'transport.php?action=Edit&id='.$row['transid'].'" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
              </tr>'; 
             
             }
             $resultArray['records'] = $records;
             $resultArray['pagination'] = Pagination::ajax_pagination(true,true , $per_page ,$cur_page ,$totalrecords ); 
             
            }else
            {
             $resultArray['records'] ='<tr><td colspan="5" class="text-center"> No Records Found </td></tr>';
             $resultArray['pagination'] = '';
            }
            
            
            $conn->close();
            return $resultArray;
  }


}



