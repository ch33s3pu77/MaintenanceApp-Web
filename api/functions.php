<?php
include "../auth/db.php";

function login($username, $password){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $username);
    $USER_PASSWORD = mysqli_real_escape_string($con, $password);


    $query = "SELECT * FROM user WHERE User_Name = '$USER_NAME'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $rowcount = mysqli_num_rows($result);
        if ($rowcount == 1) {
            $user = mysqli_fetch_array($result);
            $PASSWORD = password_hash($user['Password'], PASSWORD_ARGON2ID) ;

            if (password_verify($USER_PASSWORD, $PASSWORD)) {
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

    $query = "INSERT INTO 'job_order'('User_ID','Asset_ID','Type','Description','Date_Raised','Priority', 'Status') ";
    $query .= "VALUES('$USER_ID','$ASSET_ID','$CALIBRATION_TYPE','$DESCRIPTION','$dateRaised','$PRIORITY', 'not_started')";

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

    $query = "UPDATE job_order ";
    $query .= "SET On_Hold_Date='$holdDate', On_Hold_Reason='$HOLD_REASON', ";
    $query .= "On_Hold_Notes='$HOLD_NOTES', Status='on_hold' ";
    $query .= "WHERE Job_ID='$JOB_ID'";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        return false;
    }
}

function signOff($asset, $calibrationType, $resultOne, $resultTwo, $resultThree, $resultFour, $resultFive,
                 $passFail1, $passFail2, $passFail3, $passFail4, $passFail5, $overallPassFail, $notes){
    global $con;
    $ASSET = mysqli_real_escape_string($con, $asset);
    $CALIBRATIONTYPE = mysqli_real_escape_string($con, $calibrationType);
    $RESULTONE = mysqli_real_escape_string($con, $resultOne);
    $RESULTTWO = mysqli_real_escape_string($con, $resultTwo);
    $RESULTTHREE = mysqli_real_escape_string($con, $resultThree);
    $RESULTFOUR = mysqli_real_escape_string($con, $resultFour);
    $RESULTFIVE = mysqli_real_escape_string($con, $resultFive);
    $PASSFAIL1 = mysqli_real_escape_string($con, $passFail1);
    $PASSFAIL2 = mysqli_real_escape_string($con, $passFail2);
    $PASSFAIL3 = mysqli_real_escape_string($con, $passFail3);
    $PASSFAIL4 = mysqli_real_escape_string($con, $passFail4);
    $PASSFAIL5 = mysqli_real_escape_string($con, $passFail5);
    $OVERALL = mysqli_real_escape_string($con, $overallPassFail);
    $NOTES = mysqli_real_escape_string($con, $notes);

    $query = "INSERT INTO `results` (`Notes`, `Overall_Result`, `Result_1`, ";
    $query .= "`Pass_Fail_1`, `Result_2`, `Pass_Fail_2`, `Result_3`, `Pass_Fail_3`, `Result_4`, `Pass_Fail_4`, ";
    $query .= "`Result_5`, `Pass_Fail_5`) ";
    $query .= "VALUES ('$NOTES', '$OVERALL', '$RESULTONE', '$PASSFAIL1', '$RESULTTWO', '$PASSFAIL2', ";
    $query .= "'$RESULTTHREE', '$PASSFAIL3', '$RESULTFOUR', '$PASSFAIL4', '$RESULTFIVE', '$PASSFAIL5')";
    $result = mysqli_query($con, $query);
    if($result){
        return true;
    } else {
        die("Query Failed " . mysqli_error($con));
    }
}

function myJobs($username){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $username);

    $query = "SELECT job_order.Job_ID, job_order.Type, ";
    $query .= "job_order.Priority, job_order.Status, asset.Location ";
    $query .= "FROM job_order, asset, user ";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID ";
    $query .= "AND user.User_ID = job_order.User_ID ";
    $query .= "AND user.User_Name = '$USER_NAME'";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function jobOrder($jobid, $username){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $username);
    $JOB_ID = mysqli_real_escape_string($con, $jobid);

    $query = "SELECT job_order.Job_ID, job_order.Asset_ID, ";
    $query .= "job_order.Description, job_order.Due_By, ";
    $query .= "job_order.Date_Started, job_order.On_Hold_Date,";
    $query .= "job_order.On_Hold_Reason, ";
    $query .= "job_order.Date_Completed, job_order.Priority, ";
    $query .= "job_order.Status, user.Forename, user.Surname, ";
    $query .= "asset.Description, asset.Location ";
    $query .= "FROM job_order, user, asset";
    $query .= "WHERE user.User_ID = job_order.User_ID ";
    $query .= "AND asset.Asset_ID = job_order.Asset_ID ";
    $query .= "AND user.User_Name = '$USER_NAME' ";
    $query .= "AND job_order.Job_ID = '$JOB_ID'";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
    }
}

function completed($username){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $username);

    $query = "SELECT job_order.Job_ID, job_order.Type, job_order.Priority, asset.Location ";
    $query .= "FROM job_order, asset, user ";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID ";
    $query .= "AND user.User_ID = job_order.User_ID ";
    $query .= "AND user.User_Name = '$USER_NAME' ";
    $query .= "AND job_order.Status = complete";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function inProgress($username){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $username);

    $query = "SELECT job_order.Job_ID, job_order.Type, job_order.Priority, asset.Location ";
    $query .= "FROM job_order, asset, user ";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID ";
    $query .= "AND user.User_ID = job_order.User_ID ";
    $query .= "AND user.User_Name = '$USER_NAME' ";
    $query .= "AND job_order.Status = in_progress";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function onHold($username){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $username);

    $query = "SELECT job_order.Job_ID, job_order.Type, job_order.Priority, asset.Location ";
    $query .= "FROM job_order, asset, user ";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID ";
    $query .= "AND user.User_ID = job_order.User_ID ";
    $query .= "AND user.User_Name = '$USER_NAME' ";
    $query .= "AND job_order.Status = 'on_hold'";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function notStarted($username){
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $username);

    $query = "SELECT job_order.Job_ID, job_order.Type, job_order.Priority, asset.Location ";
    $query .= "FROM job_order, asset, user ";
    $query .= "WHERE asset.Asset_ID = job_order.Asset_ID ";
    $query .= "AND user.User_ID = job_order.User_ID ";
    $query .= "AND user.User_Name = '$USER_NAME' ";
    $query .= "AND job_order.Status = 'not_started'";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function measures($assetID){
    global $con;

    $query = "SELECT Upper_Tol, Lower_Tol, Measure_1, Measure_2, Measure_3, Measure_4, Measure5 ";
    $query .= "FROM measures, asset ";
    $query .= "asset.Measure_ID = measures.Measure_ID";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
    }
}

function startJob($jobid, $datestarted){
    global $con;

    $query = "UPDATE job_order";
    $query .= "SET Status = 'started', Date_Started = '$datestarted' ";
    $query .= "WHERE Job_ID = '$jobid'";

    $result = mysqli_query($con, $query);
    if($result){
        return true;
    } else {
        die("Query Failed " . mysqli_error($con));
    }

}

function getAssetID(){
    global $con;

    $query = "SELECT Asset_ID ";
    $query .= "FROM asset";

    $result = mysqli_query($con, $query);
    if($result){
        return $result;
    } else {
        die("Query Failed " . mysqli_error($con));
    }
}

function isUserNameExist($username){
    global $con;

    $query = "SELECT User_Name FROM user WHERE User_Name = '$username'";
    $result = mysqli_query($con, $query);
    if($result){
        return true;
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query Failed";
    }
}
?>