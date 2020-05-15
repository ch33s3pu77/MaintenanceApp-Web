<?php
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

function newJob(){

}

function putOnHold(){

}

function signOff(){

}

function myJobs(){

}

function jobOrder(){

}

function completed(){

}

function inProgress(){

}

function onHold(){

}

function notStarted(){

}

function isUsernameExist($username){
    global $con;

    $query = "SELECT User_Name FROM users WHERE email = '$username'";
    $result = mysqli_query($con, $query);
    if($result){
        $rows = mysqli_num_rows($result);
        if($rows >= 1){
            return true;
        } else {
            return false;
        }
    } else {
        die("Query Failed " . mysqli_error($con));
        //return "Query Failed";
    }
}
?>