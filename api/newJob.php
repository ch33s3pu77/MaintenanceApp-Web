<?php
include "functions.php";

if(empty($_REQUEST['User_ID']) || empty($_REQUEST['Asset_ID'])
    || empty($_REQUEST['Type']) || empty($_REQUEST['Description'])
    || empty($_REQUEST['Priority'])){
    header('Location: ../index.php');
}
else{
    $user_id = $_REQUEST['User_ID'];
    $asset_id = $_REQUEST['Asset_ID'];
    $type = $_REQUEST['Type'];
    $description = $_REQUEST['Description'];
    $date_raised = date('Y-m-d');
    $priority = $_REQUEST['Priority'];

        $result = newJob($user_id, $asset_id, $type, $description, $date_raised, $priority);
        if($result){
            echo json_encode($result);
        }
}
?>