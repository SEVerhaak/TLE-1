<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once "dblocal.php";
/** @var mysqli $db */

if (isset($_GET['ean']) && isset($_GET['name']) && isset($_GET['id'])) {

    $runQuery = true;

    // Sanitize input
    $ean = mysqli_real_escape_string($db, $_GET['ean']);
    $name = mysqli_real_escape_string($db, $_GET['name']);
    $id = mysqli_real_escape_string($db, $_GET['id']);

    // Query to get all barcodes associated with the user_id
    $verifyQuery = "SELECT `barcode` FROM `user_history` WHERE `user_id` = $id;";
    $resultVerify = mysqli_query($db, $verifyQuery);

    $eanList = [];

    while ($singleEAN = mysqli_fetch_assoc($resultVerify)) {
        $eanList[] = $singleEAN['barcode']; // Collect only barcode values
    }

    // Check if $ean exists in the $eanList
    if (!in_array($ean, $eanList)) {
        // If $ean exists in the list
        $query = "INSERT INTO `user_history` (`barcode`, `product_name`, `user_id`) VALUES ('$ean', '$name', '$id');";
        $result = mysqli_query($db, $query);
        echo json_encode(array("status" => 'succes'));
    } else {
        // If $ean does not exist in the list
        echo json_encode(array("status" => 'already_exists'));
    }
}

?>

