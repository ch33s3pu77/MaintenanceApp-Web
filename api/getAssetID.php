<?php
include "functions.php";

    $output = array();

    $result = getAssetID();
    $numOfRows = mysqli_num_rows($result);
    if($numOfRows > 0){
            //$rows = mysqli_fetch_array($result);
        while($rows = mysqli_fetch_assoc($result)){
            $output[] = $rows;
        }
    }
    echo json_encode(array("assetID" => $output));
?>
