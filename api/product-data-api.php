<?php
include "isLocal.php";

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$dbLocation = '';

if (isLocalhost()){
    $dbLocation = 'dblocal.php';
} else {
    $dbLocation = 'db.php';
}

require_once $dbLocation;

/** @var mysqli $db */

if (isset($_GET['ean'])) {
    $ean = mysqli_real_escape_string($db, $_GET['ean']);
    mysqli_real_escape_string($db, $ean);
    $query = "SELECT * FROM `products` WHERE EAN = '$ean';";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
        echo json_encode(mysqli_fetch_assoc($result));
    } else{
        $errorArray = ['error'];
        echo json_encode($errorArray);
    }

}
?>

