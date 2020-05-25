<?php
include "functions.php";

if(empty($_REQUEST['Asset_ID'])){
    header('Location: ../index.php');
} else {
    $assetID = $_REQUEST['Asset_ID'];
    $output = array();
    $result = measures($assetID);
    if ($result != false) {
        while ($rows = mysqli_fetch_array($result)) {
            $output['Upper_Tol'] = $rows['Upper_Tol'];
            $output['Lower_Tol'] = $rows['Lower_Tol'];
            $output['Measure_1'] = $rows['Measure_1'];
            $output['Measure_2'] = $rows['Measure_2'];
            $output['Measure_3'] = $rows['Measure_3'];
            $output['Measure_4'] = $rows['Measure_4'];
            $output['Measure_5'] = $rows['Measure_5'];
            echo json_encode($output);
        }
    } else {
        echo json_encode(false);
    }
}
?>
