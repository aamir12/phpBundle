<?php

class PackingUnitModal 
{

    public function get_packingunit($userid,$id){
        $db = new Database();
        $condition['where'] = array('pkuId'=>$id,'pku_user'=>$userid);
        $condition['return_type']='single';
        $data = $db->get('packingunit',$condition);
        return $data;

    }

    public function check_packingunitName($userid,$pname){
        $db = new Database();
        $condition['where'] = array('name'=>$pname,'pku_user'=>$userid);
        $condition['return_type']='single';
        $data = $db->get('packingunit',$condition);
        return $data;
    }

    public function add_packingunit($data){
        //printerror($data);
        $db = new Database();
        $prodata = array(
             'pku_user'=> $data['pku_user'],
             'name'=> $data['name']             
        );
        $pkuId = $db->insert('packingunit',$prodata);
        return $pkuId;
    }

    public function update_packingunit($data,$id,$userid){
        $db = new Database();
         $prodata = array(
             'name'=> $data['name'],            
             'updateAt'=> currenttime()
        );
        $condition = array('pkuId'=>$id,'pku_user'=>$userid);
        $db->update('packingunit',$prodata,$condition);
    }

  
    public function delete_packingunit($userid,$ides){
       $db = new Database();
        $conn = $db->getConnection();
        $status = '';

       foreach($ides as $id)
        {
            $sql = "select di_uid from  delivery inner join delivery_items on dId = di_did  where di_uid = '$id' and dl_delete = '0' and dl_userid = '$userid'";
            $salerow = $conn->query($sql);
            if($salerow->num_rows>0)
            {  
               continue;
            }
           
            $sql = "delete from packingunit where pku_user = '$userid' and pkuId = '$id'";
            $conn->query($sql);
            $status = 'Yes';
            
        }  

        $conn->close();
        return $status;
        
    }

   

    public function filter_packingunit($userid){
            $resultArray = array(
            "records" =>"",
            "pagination" => ""
            );
            $db = new Database();
            $conn = $db->getConnection();
            $cond = "";
            $condArr = array();
            $keyword = isset($_POST['keyword'])?mysqli_real_escape_string($conn,$_POST['keyword']):'';      
            $sort = isset($_POST['sortby'])?mysqli_real_escape_string($conn,$_POST['sortby']):' createAt desc ';
            $sortby = ' order by '.$sort;
            $page = isset($_POST['page'])?$_POST['page']:'1';
           
            
            if($keyword!="")
            {
            $condArr[] = " ( a.name like '%$keyword%'  ) ";
            }
            
           
            
            if(count($condArr)>0)
            {
            $cond = " and ( ".implode(" and ",$condArr)." )";
            }
            
            
            
             $cur_page = $page;
             $page -= 1;
             $per_page = 10;
             $start = $page * $per_page;

              $sql = "select a.pkuId, a.name,a.updateAt  FROM  packingunit a    where a.pku_user = '$userid'    ".$cond ;
             
            
            $querynumrows = $conn->query($sql);
            $totalrecords =  $querynumrows->num_rows;

            $sql = "select a.pkuId, a.name,a.updateAt  FROM  packingunit a    where a.pku_user = '$userid' ".$cond." ".$sortby."   LIMIT $start, $per_page " ;
            
            
           
            $result = $conn->query($sql);
            if($result->num_rows>0)
            {
             $records = "";
             while($row = $result->fetch_assoc())
             {
               
              $updatedate = ($row['updateAt']=='0000-00-00 00:00:00')?'---':dMY($row['updateAt']);

              $records.='<tr> 
              <td class="text-center"><input type="checkbox" class="selectall" name="packingunit[]" value="'.$row['pkuId'].'" /></td>
              <td >'.$row['name'].'</td>
              <td >'.$updatedate.'</td>
              <td class="text-center"><a href="'.MAIN_URL.'packingunit.php?action=Edit&id='.$row['pkuId'].'" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
              </tr>'; 
             
             }
             $resultArray['records'] = $records;
             $resultArray['pagination'] = Pagination::ajax_pagination(true,true , $per_page ,$cur_page ,$totalrecords ); 
             
            }else
            {
             $resultArray['records'] ='<tr><td colspan="4" class="text-center"> No Records Found </td></tr>';
             $resultArray['pagination'] = '';
            }
            
            
            $conn->close();
            return $resultArray;
    }

    public function allpackingunits($userid){
        $db = new Database();
        $conn = $db->getConnection(); 
        $allunits = array();
        $sql = "select p.pkuId, p.name FROM  packingunit p where p.pku_user = '".$userid."' order by p.name asc ";
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

}



