<?php
include "functions.php";

if(empty($_REQUEST['User_Name'])){
    header('Location: ../index.php');
}
else{
    $username = $_REQUEST['User_Name'];
    $output = array();
    $userNameExist = isUserNameExist($username);
    if($userNameExist){
        $result = notStarted($username);
        $numOfRows = mysqli_num_rows($result);
        if($numOfRows > 0){
            //$rows = mysqli_fetch_array($result);
            while($rows = mysqli_fetch_assoc($result)){
                $output[] = $rows;
            }
        }
        echo json_encode(array("notStarted"=>$output));
    } else {
        echo json_encode("User ID does not exist.");
    }
}
?>