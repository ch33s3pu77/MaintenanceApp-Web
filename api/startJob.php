<?php
include "functions.php";

if(empty($_REQUEST['Job_ID'])){
    header('Location: ../index.php');
} else {
    $jobid = $_REQUEST['Job_ID'];
    $datestarted = date('Y-m-d');

    $result = startJob($jobid, $datestarted);
    if($result){
        echo json_encode($result);
    }
}
