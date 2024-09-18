<?php
session_start();
require_once "../../api/db.php";
/** @var mysqli $db */
if(isset($_SESSION['users_id'])){
    $user_id = $_SESSION['users_id'];
}else{
    header('Location: ../account/login.php');
}
$query = "SELECT barcode, product_name FROM `user_history` WHERE user_id = '$user_id';";
$result = mysqli_query($db, $query)
or die('Error ' . mysqli_error($db) . ' with query ' . $query);

if (mysqli_num_rows($result) > 0) {
    // Verwerk elke rij uit het resultaat
    while ($row = mysqli_fetch_assoc($result)) {
        // Voeg elke rij toe aan de array
        $data[] = $row;
    }
}

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
    <div class="stripe"> </div>
    <h1 class="sub-header">Scan geschiedenis</h1>
    <div class="stripe"> </div>
    <?php foreach ($data as $item) { ?>
        <section class="history">
            <h2><?= "Product Name: " . $item['product_name'] ?> </h2>
            <h2> <?= "Barcode: " . $item['barcode'] ?> </h2>

            <a href = "../product-info/index.php?ean=<?= $item['barcode']?>"><button>Ga naar product</button></a>
        </section>
            <?php } ?>


</main>

<footer>
    <img src="../../images/triangular-arrows-sign-for-recycle.png" alt="Recycle"
</footer>
</body>
</html>
