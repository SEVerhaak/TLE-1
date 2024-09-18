<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once "db.php";
/** @var mysqli $db */

if (isset($_GET['ean']) and $_GET['name'] and $_GET['id']) {
    $ean = mysqli_real_escape_string($db, $_GET['ean']);
    $name  = mysqli_real_escape_string($db, $_GET['name']);
    $id = mysqli_real_escape_string($db, $_GET['id']);

    $query = "INSERT INTO `user_history` (`barcode`, `product_name`, `user_id`) VALUES ('$ean', '$name', '$id');";
    $result = mysqli_query($db, $query);


}
?>