<?php
include "functions.php";

if(empty($_REQUEST['Job_ID']) && empty($_REQUEST['User_ID'])){
    header('Location: ../index.php');
} else {
    $output = array();

    $job_id = $_REQUEST['Job_ID'];
    $user_id = $_REQUEST['User_ID'];
    $result = jobOrder($job_id, $user_id);
    if($result != false){
        $rows = mysqli_fetch_array($result);
        $output['Job_ID'] = $rows['Job_ID'];
        $output['Asset_ID'] = $rows['Asset_ID'];
        $output['Description'] = $rows['Description'];
        $output['Due_By'] = $rows['Due_by'];
        $output['Date_Started'] = $rows['Date_Started'];
        $output['On_Hold_Date'] = $rows['On_Hold_Date'];
        $output['On_Hold_Reason'] = $rows['On_Hold_Reason'];
        $output['Date_Completed'] = $rows['Date_Completed'];
        $output['Priority'] = $rows['Priority'];
        $output['Status'] = $rows['Status'];
        $output['Forename'] = $rows['Forename'];
        $output['Surname'] = $rows['Surname'];
        $output['Asset_Description'] = $rows['Asset_Description'];
        $output['Location'] = $rows['Location'];
        echo json_encode($output);
    } else {
        echo json_encode(false);
    }
}
?>
