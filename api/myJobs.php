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
        if($result != false){
            //$rows = mysqli_fetch_array($result);
            while($rows =mysqli_fetch_assoc($result)){
               $output['Job_ID'] = $rows['Job_ID'];
               $output['Type'] = $rows['Type'];
               $output['Priority'] = $rows['Priority'];
               $output['Status'] = $rows['Status'];
               $output['Location'] = $rows['Location'];
               echo json_encode($output);
            }

        }
    } else {
        echo json_encode("User ID does not exist.");
    }

}
?>