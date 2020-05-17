<?php
include "functions.php";

if(empty($_REQUEST['Job_ID']) || empty($_REQUEST['Hold_Reason']) || empty($_REQUEST['Hold_Notes'])){
    header('Location: ../index.php');
}
else{
    $jobid = $_REQUEST['Job_ID'];
    $holdDate = date('Y-m-d');
    $holdReason = $_REQUEST['Hold_Reason'];
    $holdNotes = $_REQUEST['Hold_Notes'];

    $result = putOnHold($jobid, $holdDate, $holdReason, $holdNotes);
    if($result){
        echo json_encode($result);
    } else {
        echo json_encode("Job order does not exist.");
    }
}
?>
