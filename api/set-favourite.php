<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once "dblocal.php";
/** @var mysqli $db */

if (isset($_GET['ean']) && isset($_GET['id'])) {
    // Sanitize input
    $ean = mysqli_real_escape_string($db, $_GET['ean']);
    $id = mysqli_real_escape_string($db, $_GET['id']);

    // Query to get all barcodes associated with the user_id
    $verifyQuery = "SELECT * FROM `user_history` WHERE `barcode` = $ean AND `user_id` = $id;";
    $resultVerify = mysqli_query($db, $verifyQuery);

    $eanList = [];

    while ($singleEAN = mysqli_fetch_assoc($resultVerify)) {
        $eanList[] = $singleEAN['favourite']; // Collect only barcode values
    }

    if ($eanList[0] === '0'){
        $query = "UPDATE `user_history` SET `favourite` = '1' WHERE `user_history`.`user_id` = $id AND `user_history`.`barcode` = $ean;";
        $result = mysqli_query($db, $query);
        echo json_encode(array("result" => 'added favourite'));
    } else if ($eanList[0] === '1'){
        $query = "UPDATE `user_history` SET `favourite` = '0' WHERE `user_history`.`user_id` = $id AND `user_history`.`barcode` = $ean;";
        $result = mysqli_query($db, $query);
        echo json_encode(array("result" => 'removed favourite'));
    } else{
        echo json_encode(array("result" => 'error'));
    }

    //echo json_encode(array("favourite" => $eanList[0]));
}

?>

