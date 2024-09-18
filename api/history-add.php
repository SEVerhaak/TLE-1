<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once "db.php";
/** @var mysqli $db */

if (isset($_GET['ean']) and $_GET['name'] and $_GET['id']) {

    $runQuery = true;

    $ean = mysqli_real_escape_string($db, $_GET['ean']);
    $name  = mysqli_real_escape_string($db, $_GET['name']);
    $id = mysqli_real_escape_string($db, $_GET['id']);

    $verifyQuery = "SELECT `barcode` FROM `user_history` WHERE `user_id` = $id;";
    $resultVerify = mysqli_query($db, $verifyQuery);

    $eanList = [];

    while ($singleEAN = mysqli_fetch_assoc($resultVerify)) {
        $eanList[] = $singleEAN;
    }

    //print_r($eanList);

    for ($i = 0; $i < count($eanList); $i++) {
        if ($eanList[$i]['barcode'] == $ean) {
            $runQuery = false;
        } else{
            $runQuery = true;
        }
    }

    if ($runQuery) {
        $query = "INSERT INTO `user_history` (`barcode`, `product_name`, `user_id`) VALUES ('$ean', '$name', '$id');";
        $result = mysqli_query($db, $query);
    }
}
?>