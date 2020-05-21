<?php
include "functions.php";

if(empty($_REQUEST['User_NAME'])){
    header('Location: ../index.php');
}
else{
    $username = $_REQUEST['User_NAME'];
    $output = array();
    $useridExist = isUseridExist($username);

    if($useridExist){

        $result = myJobs($username);
        $numOfRows = mysqli_num_rows($result);

        if($numOfRows > 0){
            //$rows = mysqli_fetch_array($result);
            while($rows = mysqli_fetch_assoc($result)){
               $output[] = $rows;
            }
            echo json_encode(array("jobOrders" => $output));
        }
    } else {
        echo json_encode("User ID does not exist.");
    }
}
?>