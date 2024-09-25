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

    echo json_encode(array("favourite" => $eanList[0]));
}

?>

