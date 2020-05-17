<?php
include "functions.php";

    $output = array();
    $result = measures();
    if($result != false){
        while($rows = mysqli_fetch_array($result)){
            $output['BS_Measure'] = $rows['BS_Measure'];
            $output['Upper_Tol'] = $rows['Upper_Tol'];
            $output['Lower_Tol'] = $rows['Lower_Tol'];
            echo json_encode($output);
        }
    } else {
        echo json_encode(false);
    }
?>
