<!--
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include_once "./AdminDashboardController.php";
// if($_SERVER["REQUEST_METHOD"] == "POST") {
//     $data = json_decode(file_get_contents('php://input'), true);
//     if($data != null && $data['method'] == 'deleteItem'){
//     $admin = new AdminController();
//     $result = $admin->deleteItem($data['record']);
//     echo('testing5' +  $data );} 
//     else{
//         echo('testing6');
//     }
// }
// else{
//     echo('testing7');
// }
// 
 -->

<?php
    include_once "../config/dbconnect.php";
    
    // if(isset($_POST['deleteItem']))
    // {
        $ID = $_POST['record'];
         $delete = mysqli_query($conn,"DELETE from product WHERE product_id= $ID");
 
         if(!$delete)
         {
             echo mysqli_error($conn);
         }
         else
         {
             echo "Records deleted successfully.";
         }
     
    // }
        
?>