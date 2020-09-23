<?php

class ProductModal 
{

    public function get_product($userid,$id){
        $db = new Database();
        $condition['where'] = array('productid'=>$id,'pro_userid'=>$userid);
        $condition['return_type']='single';
        $data = $db->get('products',$condition);
        return $data;

    }

    public function check_productName($userid,$pname){
        $db = new Database();
        $condition['where'] = array('name'=>$pname,'pro_userid'=>$userid);
        $condition['return_type']='single';
        $data = $db->get('products',$condition);
        return $data;
    }

    public function add_product($data){

        //printerror($data);
        $db = new Database();
        $prodata = array(
             'pro_userid'=> $data['pro_userid'],
             'name'=> $data['name']             
        );
        $productid = $db->insert('products',$prodata);
        return $productid;   

    }

    public function update_product($data,$id,$userid){
        $db = new Database();
         $prodata = array(
             'name'=> $data['name'],            
             'pro_updatedate'=> currenttime()
        );
        $condition = array('productid'=>$id,'pro_userid'=>$userid);
        $db->update('products',$prodata,$condition);
  

    }

  
    public function delete_product($userid,$ides){
        $db = new Database();
        $conn = $db->getConnection();
        $status = '';

       foreach($ides as $id)
        {
            $sql = "select di_pid from  delivery inner join delivery_items on dId = di_did  where di_pid = '$id' and dl_delete = '0' and dl_userid = '$userid'";
            $salerow = $conn->query($sql);
            if($salerow->num_rows>0)
            {  
               continue;
            }
           
            $sql = "delete from products where pro_userid = '$userid' and productid = '$id'";
            $conn->query($sql);
            $status = 'Yes';
            
        }  

        $conn->close();
        return $status;  
        
    }

    public function filter_product($userid){
        $resultArray = array(
            "records" =>"",
            "pagination" => ""
        );
        $db = new Database();
        $conn = $db->getConnection();
        $cond = "";
        $condArr = array();
        $keyword = isset($_POST['keyword'])?mysqli_real_escape_string($conn,$_POST['keyword']):'';      
        $sort = isset($_POST['sortby'])?mysqli_real_escape_string($conn,$_POST['sortby']):' pro_created_date desc ';
        $sortby = ' order by '.$sort;
        $page = isset($_POST['page'])?$_POST['page']:'1';

        if($keyword!=""){
         $condArr[] = " ( p.name like '%$keyword%'  ) ";
        }
        
        if(count($condArr)>0){
         $cond = " and ( ".implode(" and ",$condArr)." )";
        }
        
        $cur_page = $page;
        $page -= 1;
        $per_page = 10;
        $start = $page * $per_page;

        $sql = "select p.productid, p.name,p.pro_updatedate  FROM  products p    where p.pro_userid = '$userid'    ".$cond ;
        $querynumrows = $conn->query($sql);
        $totalrecords =  $querynumrows->num_rows;

        $sql = "select p.productid, p.name,p.pro_updatedate  FROM  products p    where p.pro_userid = '$userid' ".$cond." ".$sortby."   LIMIT $start, $per_page " ;
        
        //echo $sql;
        
        $result = $conn->query($sql);
        if($result->num_rows>0)
        {
            $records = "";
            while($row = $result->fetch_assoc())
            {
            
            $updatedate = ($row['pro_updatedate']=='0000-00-00 00:00:00')?'---':dMY($row['pro_updatedate']);

            $records.='<tr> 
            <td class="text-center"><input type="checkbox" class="selectall" name="products[]" value="'.$row['productid'].'" /></td>
            <td >'.$row['name'].'</td>
            <td >'.$updatedate.'</td>
            <td class="text-center"><a href="'.MAIN_URL.'products.php?action=Edit&id='.$row['productid'].'" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
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

    public function allproducts($userid){
        $db = new Database();
        $conn = $db->getConnection(); 
        $allproduct = array();
        $sql = "select p.productid, p.name FROM  products p where p.pro_userid = '".$userid."' order by p.name asc ";
        $products = $conn->query($sql);
        if($products->num_rows>0)
        {
             while ($product = $products->fetch_assoc()) {
                  $allproduct[] = $product;
             }
        }
        $conn->close();
        return $allproduct;

    }


}



