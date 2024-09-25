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

        <a href="../history/index.php">
            <div class="box color-6">
                <h2 class="color-white">Zoek product</h2>
                <img src="../../images/icons/search-big.svg">
            </div>
        </a>

        <div style="padding: 1rem; align-items: baseline;" class="box info">
            <h2 class="color-1">Hoe te gebruiken?</h2>
            <p class="color-1">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto consequatur debitis deleniti obcaecati provident! Aliquid atque autem corporis esse, ex explicabo facere, facilis illo illum maiores, minus officia optio soluta.
            </p>
        </div>

    </section>
</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
