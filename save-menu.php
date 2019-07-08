<?php
 //error_reporting(0);
 if(isset($_POST['txt-name']) == true ){
    $connecton = new mysqli('localhost', 'root', '', 'rean_web');
    $name = $_POST['txt-name'];
    $color = $_POST['txt-color'];
    $photo =$_POST['txt-photo'];
    $edit_id = $_POST['txt-edit-id'];
    $name=  trim($name); //! remove all whitespace
    $name= str_replace("'","''",$name); //! replace ' 
    if($edit_id==0){
        $sql_check ="SELECT * FROM tbl_menu WHERE name='".$name."'";
        $re_check = $connecton->query($sql_check);
        $num_check= $re_check->num_rows; //! num > 0 mean have data in row
        $status['insert'] = false;
        if($num_check == 0){
            $sql = "INSERT INTO tbl_menu VALUES(null,'" . $name . "','" . $color . "','" . $photo . "')";
            if( $result =$connecton->query($sql)){
                $lastID = $connecton->insert_id; //! ចាប់យកតម្លៃ​ insert ​ចុងក្រោយ
                $status['last_id'] = $lastID;
                $status['dpl'] = false;  
                $status['insert']=true;
            }  
        }else{
            $status['dpl'] = true;
        }    
    }else{
        $sql = "UPDATE tbl_menu SET name = '".$name."', color = '".$color."',img ='".$photo."' WHERE id =".$edit_id."";
        $connecton->query($sql);
        $status['last_id'] = 'edit';
    }
    echo json_encode($status); // ! return value of $status as json data to another file
        
 }    
// error_reporting(0);
?>