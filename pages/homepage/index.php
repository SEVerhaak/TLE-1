<?php
session_start();
if(isset($_SESSION['users_id'])){
    $userName = $_SESSION['user_name'];
    $loggedIn = TRUE;
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
    <link rel="stylesheet" href="../../css/elisa.css">
    <link rel="stylesheet" href="../../css/isis.css">
    <title>Homepage</title>
</head>
<body>
<?php include('../../includes/nav.php'); ?>
<main>
    <div class="heading-text">
    <?php if(isset($_SESSION['users_id'])){
    ?><h1 class="color-1">Welkom <?= $userName ?>,</h1>
    <?php }?>
    <h2 class="color-1"> Wat wilt u scannen vandaag?</h2>
    </div>
    <section class="container">

        <a href = "../scanner">
            <div class="box color-3">
                <h2 class="color-white">Scan barcode</h2>
                <img src="../../images/icons/barcode.svg">
            </div>
        </a>

        <a href="../scanner/upload.php">
            <div class="box color-6">
                <h2 class="color-white">Upload barcode</h2>
                <img src="../../images/icons/upload.svg">
            </div>
        </a>

        <div style="padding: 1rem; align-items: baseline;" class="box info">
            <h2 class="color-1">Hoe te gebruiken?</h2>
            <p class="color-1">
                Met de EcoJourney app kun je eenvoudig een product scannen om direct de eco-score te zien, waarmee je de milieu-impact van het product kunt beoordelen. Daarnaast kun je je zoekgeschiedenis bekijken om eerdere scans en scores terug te vinden.            </p>
        </div>

    </section>
</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
