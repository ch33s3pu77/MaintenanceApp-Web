<?php
include "functions.php";

if(empty($_REQUEST['username']) || empty($_REQUEST['password'])){
    header('Location: ../index.php');
} else{
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $usernameExist = isUsernameExist($username);
    if($usernameExist){
        $result = login($username, $password);
        echo json_encode($result);
    } else {
        echo json_encode("Username does not exist.");
    }
}
?>
