<?php
include "functions.php";

if(empty($_REQUEST['User_ID'])){
    header('Location: ../index.php');
}
else{
    $userid = $_REQUEST['User_ID'];
    $output = array();
    $useridExist = isUseridExist($userid);

    if($useridExist){

        $result = started($userid);
        if($result != false){
            //$rows = mysqli_fetch_array($result);
            while($rows =mysqli_fetch_assoc($result)){
                $output['Job_ID'] = $rows['Job_ID'];
                $output['Type'] = $rows['Type'];
                $output['Priority'] = $rows['Priority'];
                $output['Location'] = $rows['Location'];
                echo json_encode($output);
            }

        }
    } else {
        echo json_encode("User ID does not exist.");
    }

}
?>