<?php
session_start();
if(isset($_SESSION['users_id'])){
    $user_id = $_SESSION['users_id'];
}else{
    header('Location: ../account/login.php');
}
$query = "SELECT barcode, product_name FROM `user_history` WHERE user_id = 4;";
$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Homepage</title>
</head>
<body>
<nav>
    <a href = "../homepage"><img src="../../images/arrow.png" alt="Menu"></a>
</nav>

<main>
    <h1>Scan geschiedenis</h1>
    <h2>Product naam</h2>
</main>

<footer>
    <img src="../../images/triangular-arrows-sign-for-recycle.png" alt="Recycle"
</footer>
</body>
</html>
