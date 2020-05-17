<?php
include "functions.php";

if(empty($_REQUEST['User_Name']) || empty($_REQUEST['Password'])){
    header('Location: ../index.php');
}
else{
    $username = $_REQUEST['User_Name'];
    $password = $_REQUEST['Password'];

    $usernameExist = isUsernameExist($username);
    if($usernameExist){
        $result = login($username, $password);
        echo json_encode($result);
        /*if($result){
            echo json_encode($result);
        } else {
            echo json_encode($result);
        }*/
    } else {
        echo json_encode("Username does not exist.");
    }

}
?>
