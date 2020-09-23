<?php

class AreaModal 
{

    public function get_area($userid,$id){
        $db = new Database();
        $condition['where'] = array('aId'=>$id,'area_user'=>$userid);
        $condition['return_type']='single';
        $data = $db->get('area',$condition);
        return $data;
    }

    public function check_areaName($userid,$pname){
        $db = new Database();
        $condition['where'] = array('name'=>$pname,'area_user'=>$userid);
        $condition['return_type']='single';
        $data = $db->get('area',$condition);
        return $data;
    }


    public function add_area($data){

        //printerror($data);
        $db = new Database();
        $prodata = array(
             'area_user'=> $data['area_user'],
             'name'=> $data['name']             
        );
        $aId = $db->insert('area',$prodata);
        return $aId;   

    }

    public function update_area($data,$id,$userid){
        $db = new Database();
         $prodata = array(
             'name'=> $data['name'],            
             'updateAt'=> currenttime()
        );
        $condition = array('aId'=>$id,'area_user'=>$userid);
        $db->update('area',$prodata,$condition);
  

    }

  
    public function delete_area($userid,$ides){
        $db = new Database();
        $conn = $db->getConnection();
        $status = '';

        foreach($ides as $id)
        {
            $sql = "select dl_area from  delivery  where dl_area = '$id' and dl_delete = '0' and dl_userid = '$userid'";
            $salerow = $conn->query($sql);
            if($salerow->num_rows>0)
            {  
               continue;
            }
            $sql = "delete from area where area_user = '$userid' and aId = '$id'";
            $conn->query($sql);
            $status = 'Yes';
            
        }  

        $conn->close();
        return $status;  
        
    }

   

    public function filter_area($userid){
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
       
        
        if($keyword!=""){
        $condArr[] = " ( a.name like '%$keyword%'  ) ";
        }
        
        if(count($condArr)>0){
        $cond = " and ( ".implode(" and ",$condArr)." )";
        }
        
        
        
        $cur_page = $page;
        $page -= 1;
        $per_page = 10;
        $start = $page * $per_page;

        $sql = "select a.aId, a.name,a.updateAt  FROM  area a    where a.area_user = '$userid'    ".$cond ;
         
        
        $querynumrows = $conn->query($sql);
        $totalrecords =  $querynumrows->num_rows;

        $sql = "select a.aId, a.name,a.updateAt  FROM  area a    where a.area_user = '$userid' ".$cond." ".$sortby."   LIMIT $start, $per_page " ;
        
        $result = $conn->query($sql);
        if($result->num_rows>0){
         $records = "";
         while($row = $result->fetch_assoc()){
          $updatedate = ($row['updateAt']=='0000-00-00 00:00:00')?'---':dMY($row['updateAt']);
          $records.='<tr> 
          <td class="text-center"><input type="checkbox" class="selectall" name="area[]" value="'.$row['aId'].'" /></td>
          <td >'.$row['name'].'</td>
          <td >'.$updatedate.'</td>
          <td class="text-center"><a href="'.MAIN_URL.'area.php?action=Edit&id='.$row['aId'].'" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
          </tr>'; 
         }

         $resultArray['records'] = $records;
         $resultArray['pagination'] = Pagination::ajax_pagination(true,true , $per_page ,$cur_page ,$totalrecords ); 
         
        }else{
         $resultArray['records'] ='<tr><td colspan="4" class="text-center"> No Records Found </td></tr>';
         $resultArray['pagination'] = '';
        }

        $conn->close();
        return $resultArray;
    }

    public function allAreas($userid){
        $db = new Database();
        $conn = $db->getConnection(); 
        $allarea = array();
        $sql = "select aId, name FROM  area where area_user = '".$userid."' order by name asc ";
        $areas = $conn->query($sql);
        if($areas->num_rows>0)
        {
             while ($area = $areas->fetch_assoc()) {
                  $allarea[] = $area;
             }
        }
        $conn->close();
        return $allarea;
    }

}



