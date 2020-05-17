<?php
include "../auth/db.php";

function login($username, $password){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $username);
    $USER_PASSWORD = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM user WHERE User_Name = '$USER_NAME'";
    $result = mysqli_query($con, $query);
    if($result){
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 1){
            $user = mysqli_fetch_array($result);
            $PASSWORD = $user['password'];

            if(password_verify($USER_PASSWORD, $PASSWORD)){
                return true;
            } else {
                return "Password does not exist.";
            }
        }
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function newJob($asset, $calibrationType, $notes, $priority){
    global $con;
}

function putOnHold($holdDate, $holdReason, $holdNotes){
    global $con;
}

function signOff($asset, $calibrationType, $resultOne, $resultTwo, $resultThree, $resultFour, $resultFive, $passFail1, $passFail2, $passFail3, $passFail4, $passFail5, $overallPassFail, $notes){
    global $con;
}

function myJobs($userid){
    global $con;
    $USER_ID = mysqli_real_escape_string($con, $userid);

    $query = "SELECT Job_ID, Type, Priority, Status, Location";
    $query .= "FROM job_order, asset";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID";
    $query .= "AND User_ID = '$USER_ID'";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function jobOrder(){
    global $con;
}

function completed($status, $username){
    global $con;
}

function inProgress($status, $username){
    global $con;
}

function onHold($status, $username){
    global $con;
}

function notStarted($status, $username){
    global $con;
}

function measures($measureId){
    global $con;
}

function startJob($jobId){
    global $con;
}

function isUseridExist($userid){
    global $con;

    $query = "SELECT User_ID FROM users WHERE email = '$userid'";
    $result = mysqli_query($con, $query);
    if($result){
        return true;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query Failed";
    }
}
?>