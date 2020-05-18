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

function newJob($userid, $asset, $calibrationType, $notes, $priority, $dateRaised){
    global $con;
    $USER_ID = mysqli_real_escape_string($con, $userid);
    $ASSET_ID = mysqli_real_escape_string($con, $asset);
    $CALIBRATION_TYPE = mysqli_real_escape_string($con, $calibrationType);
    $DESCRIPTION = mysqli_real_escape_string($con, $notes);
    $PRIORITY = mysqli_real_escape_string($con, $priority);

    $query = "INSERT INTO 'job_order'('User_ID','Asset_ID','Type','Description','Date_Raised','Priority', 'Status')";
    $query .= "VALUES('$USER_ID','$ASSET_ID','$CALIBRATION_TYPE','$DESCRIPTION','$dateRaised','$PRIORITY', not_started)";

    $result = mysqli_query($query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
    }
}

function putOnHold($jobid, $holdDate, $holdReason, $holdNotes){
    global $con;
    $JOB_ID = mysqli_real_escape_string($con, $jobid);

    $HOLD_REASON = mysqli_real_escape_string($con, $holdReason);
    $HOLD_NOTES = mysqli_real_escape_string($con, $holdNotes);

    $query = "UPDATE job_order";
    $query .= "SET On_Hold_Date='$holdDate', On_Hold_Reason='$HOLD_REASON', ";
    $query .= "On_Hold_Notes='$HOLD_NOTES', Status=on_Hold";
    $query .= "WHERE Job_ID='$JOB_ID'";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        return false;
    }
}

function signOff($asset, $calibrationType, $resultOne, $resultTwo, $resultThree, $resultFour, $resultFive, $passFail1, $passFail2, $passFail3, $passFail4, $passFail5, $overallPassFail, $notes){
    global $con;
}

function myJobs($username){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $username);

    $query = "SELECT job_order.Job_ID, job_order.Type, ";
    $query .= "job_order.Priority, job_order.Status, asset.Location";
    $query .= "FROM job_order, asset, user";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID";
    $query .= "AND user.User_ID = job_order.User_iD";
    $query .= "AND user.User_Name = '$USER_NAME'";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function jobOrder($jobid, $userid){
    global $con;
    $USER_ID = mysqli_real_escape_string($con, $userid);
    $JOB_ID = mysqli_real_escape_string($con, $jobid);

    $query = "SELECT job_order.Job_ID, job_order.Asset_ID,";
    $query .= "job_order.Description, job_order.Due_By,";
    $query .= "job_order.Date_Started, job_order.On_Hold_Date,";
    $query .= "job_order.On_Hold_Reason,";
    $query .= "job_order.Date_Completed, job_order.Priority,";
    $query .= "job_order.Status, user.Forename, user.Surname,";
    $query .= "asset.Description, asset.Location";
    $query .= "FROM job_order, user, asset";
    $query .= "WHERE user.User_ID = job_order.User_ID";
    $query .= "AND asset.Asset_ID = job_order.Asset_ID";
    $query .= "AND job_order.User_ID = '$USER_ID'";
    $query .= "AND job_order.Job_ID = '$JOB_ID'";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
    }
}

function completed($userid){
    global $con;
    $USER_ID = mysqli_real_escape_string($con, $userid);

    $query = "SELECT job_order.Job_ID, job_order.Type, job_order.Priority, asset.Location";
    $query .= "FROM job_order, asset";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID";
    $query .= "AND User_ID = '$USER_ID'";
    $query .= "AND Status = complete";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function inProgress($userid){
    global $con;
    $USER_ID = mysqli_real_escape_string($con, $userid);

    $query = "SELECT job_order.Job_ID, job_order.Type, job_order.Priority, asset.Location";
    $query .= "FROM job_order, asset";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID";
    $query .= "AND User_ID = '$USER_ID'";
    $query .= "AND Status = in_progress";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function onHold($userid){
    global $con;
    $USER_ID = mysqli_real_escape_string($con, $userid);

    $query = "SELECT job_order.Job_ID, job_order.Type, job_order.Priority, asset.Location";
    $query .= "FROM job_order, asset";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID";
    $query .= "AND User_ID = '$USER_ID'";
    $query .= "AND Status = on_hold";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function notStarted($userid){
    global $con;
    $USER_ID = mysqli_real_escape_string($con, $userid);

    $query = "SELECT job_order.Job_ID, job_order.Type, job_order.Priority, asset.Location";
    $query .= "FROM job_order, asset";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID";
    $query .= "AND User_ID = '$USER_ID'";
    $query .= "AND Status = not_started";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function measures(){
    global $con;

    $query = "SELECT BS_Measure, Upper_Tol, Lower_Tol";
    $query .= "FROM measures";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
    }
}

function startJob($userid){
    global $con;
    $USER_ID = mysqli_real_escape_string($con, $userid);

    $query = "SELECT job_order.Job_ID, job_order.Type, job_order.Priority, asset.Location";
    $query .= "FROM job_order, asset";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID";
    $query .= "AND User_ID = '$USER_ID'";
    $query .= "AND Status = started";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
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