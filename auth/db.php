<?php
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","MadMax66");
define("DB_NAME","maintenanceapp");

$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

if(!$con){
    echo "ERROR! " . mysqli_connect_error();
}
//echo "Connected";
?>