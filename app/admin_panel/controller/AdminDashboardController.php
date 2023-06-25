<?php
include_once "../config/dbconnect.php";

class AdminController {
    private $conn;

    public function __construct($conn)
        {
            $this->conn = $conn;
        }
        
    public function addCategory(){
        include_once "../config/dbconnect.php";
    
        if(isset($_POST['upload']))
        {
           
            $catname = $_POST['c_name'];
           
             $insert = mysqli_query($conn,"INSERT INTO category
             (category_name) 
             VALUES ('$catname')");
     
             if(!$insert)
             {
                 echo mysqli_error($conn);
                 header("Location: ../index.php?category=error");
             }
             else
             {
                 echo "Records added successfully.";
                 header("Location: ../index.php?category=success");
             }
         
        }
            
    }

    public function addItem(){
        include_once "../config/dbconnect.php";

        if(isset($_POST['upload'])){
            $ProductName = $_POST['p_name'];
            $desc= $_POST['p_desc'];
            $price = $_POST['p_price'];
            $category = $_POST['category'];
            $name = $_FILES['file']['name'];
            $temp = $_FILES['file']['tmp_name'];
            $location="./uploads/";
            $image=$location.$name;
            $target_dir="../uploads/";
            $finalImage=$target_dir.$name;

            move_uploaded_file($temp,$finalImage);
                $insert = mysqli_query($conn,"INSERT INTO product
                (product_name,product_image,price,product_desc,category_id) 
                VALUES ('$ProductName','$image',$price,'$desc','$category')");
        
                if(!$insert)
                {
                    echo mysqli_error($conn);
                }
                else
                {
                    echo "Records added successfully.";
                }}
    }
    public function addSize(){
        include_once "../config/dbconnect.php";
    
        if(isset($_POST['upload']))
        {
           
            $size = $_POST['size'];
           
             $insert = mysqli_query($conn,"INSERT INTO sizes
             (size_name)   VALUES ('$size')");
     
             if(!$insert)
             {
                 echo mysqli_error($conn);
                 header("Location: ../index.php?size=error");
             }
             else
             {
                 echo "Records added successfully.";
                 header("Location: ../index.php?size=success");
             }
         
        }
            
    }
    public function addVariation(){
        include_once "../config/dbconnect.php";
    
        if(isset($_POST['upload']))
        {
           
            $product = $_POST['product'];
            $size= $_POST['size'];
            $qty = $_POST['qty'];
    
             $insert = mysqli_query($conn,"INSERT INTO product_size_variation
             (product_id,size_id,quantity_in_stock) VALUES ('$product','$size','$qty')");
     
             if(!$insert)
             {
                 echo mysqli_error($conn);
                 header("Location: ../index.php?variation=error");
             }
             else
             {
                 echo "Records added successfully.";
                 header("Location: ../index.php?variation=success");
             }
         
        }
    }
    public function deleteCategory(){

        include_once "../config/dbconnect.php";
    
        $c_id=$_POST['record'];
        $query="DELETE FROM category where category_id='$c_id'";
    
        $data=mysqli_query($conn,$query);
    
        if($data){
            echo"Category Item Deleted";
        }
        else{
            echo"Not able to delete";
        }
        
    }
    public function deleteItem($id){
        include_once "../config/dbconnect.php";
        // $p_id=$_POST['record'];
        $query="DELETE FROM product where product_id='$id'";
    
        $data=mysqli_query($conn,$query);
    
        if($data){
            echo"Product Item Deleted";
        }
        else{
            echo"Not able to delete";
        }
    }
    public function deleteSize(){
        include_once "../config/dbconnect.php";
    
        $id=$_POST['record'];
        $query="DELETE FROM sizes where size_id='$id'";
    
        $data=mysqli_query($conn,$query);
    
        if($data){
            echo"Size Deleted";
        }
        else{
            echo"Not able to delete";
        }
        
    }
    public function deleteVariation(){
        include_once "../config/dbconnect.php";
    
        $id=$_POST['record'];
        $query="DELETE FROM product_size_variation where variation_id='$id'";
    
        $data=mysqli_query($conn,$query);
    
        if($data){
            echo"variation Deleted";
        }
        else{
            echo"Not able to delete";
        }
        
    }
    public function updateItem(){
        include_once "../config/dbconnect.php";

        $product_id=$_POST['product_id'];
        $p_name= $_POST['p_name'];
        $p_desc= $_POST['p_desc'];
        $p_price= $_POST['p_price'];
        $category= $_POST['category'];
    
        if( isset($_FILES['newImage']) ){
            
            $location="./uploads/";
            $img = $_FILES['newImage']['name'];
            $tmp = $_FILES['newImage']['tmp_name'];
            $dir = '../uploads/';
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif','webp');
            $image =rand(1000,1000000).".".$ext;
            $final_image=$location. $image;
            if (in_array($ext, $valid_extensions)) {
                $path = UPLOAD_PATH . $image;
                move_uploaded_file($tmp, $dir.$image);
            }
        }else{
            $final_image=$_POST['existingImage'];
        }
        $updateItem = mysqli_query($conn,"UPDATE product SET 
            product_name='$p_name', 
            product_desc='$p_desc', 
            price=$p_price,
            category_id=$category,
            product_image='$final_image' 
            WHERE product_id=$product_id");
    
    
        if($updateItem)
        {
            echo "true";
        }
        // else
        // {
        //     echo mysqli_error($conn);
        // }
    }
    public function updateOrder(){

        include_once "../config/dbconnect.php";
   
        $order_id=$_POST['record'];
        //echo $order_id;
        $sql = "SELECT order_status from orders where order_id='$order_id'"; 
        $result=$conn-> query($sql);
      //  echo $result;
    
        $row=$result-> fetch_assoc();
        
       // echo $row["pay_status"];
        
        if($row["order_status"]==0){
             $update = mysqli_query($conn,"UPDATE orders SET order_status=1 where order_id='$order_id'");
        }
        else if($row["order_status"]==1){
             $update = mysqli_query($conn,"UPDATE orders SET order_status=0 where order_id='$order_id'");
        }
        
            
     
        // if($update){
        //     echo"success";
        // }
        // else{
        //     echo"error";
        // }
        
    }
    public function updatePayStatus(){
        include_once "../config/dbconnect.php";
        $order_id=$_POST['record'];
        //echo $order_id;
        $sql = "SELECT pay_status from orders where order_id='$order_id'"; 
        $result=$conn-> query($sql);
      //  echo $result;
    
        $row=$result-> fetch_assoc();
        
       // echo $row["pay_status"];
        
        if($row["pay_status"]==0){
             $update = mysqli_query($conn,"UPDATE orders SET pay_status=1 where order_id='$order_id'");
        }
        else if($row["pay_status"]==1){
             $update = mysqli_query($conn,"UPDATE orders SET pay_status=0 where order_id='$order_id'");
        }
            
     
        // if($update){
        //     echo"success";
        // }
        // else{
        //     echo"error";
        // }
        
    }
    public function updateVariation(){
        include_once "../config/dbconnect.php";

        $v_id=$_POST['v_id'];
        $product= $_POST['product'];
        $size= $_POST['size'];
        $qty= $_POST['qty'];
       
        $updateItem = mysqli_query($conn,"UPDATE product_size_variation SET 
            product_id=$product, 
            size_id=$size,
            quantity_in_stock=$qty 
            WHERE variation_id=$v_id");
    
    
        if($updateItem)
        {
            echo "true";
        }
    }

}
        
?>