<?php
include "../../api/isLocal.php";

session_start();

$dbLocation = '';

if (isLocalhost()){
    $dbLocation = '../../api/dblocal.php';
} else {
    $dbLocation = '../../api/db.php';
}

require_once $dbLocation;

/** @var mysqli $db */

$loggedIn = false;

if (isset($_GET['ean'])) {
    $ean = $_GET['ean'];
    if (isset($_SESSION['users_id'])) {
        $id = $_SESSION['users_id'];
        $loggedIn = true;
        $updateQuery = "UPDATE `users` SET `score` = `score` + 10 WHERE `id` = '$id'";
        mysqli_query($db, $updateQuery);
    } else {
        $id = '';
    }
} else {
    echo 'no ean given :(';
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
    <link rel="stylesheet" href="../../css/bas.css">
    <link rel="stylesheet" href="../../css/elisa.css">
    <script type="text/javascript" src="../../js/productPagina.js" defer></script>
    <title>EcoJourney Product-info</title>
</head>
<header>
    <div id="meta-data-ean" style="display: none;"><?php echo $ean ?> </div>
    <div id="meta-data-id" style="display: none"><?= $id ?></div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>

<main style="padding-bottom: 14rem">

    <div id="loading"
         style="display: flex; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); z-index: 9999;">
        <video id="loading-video" width="80%" autoplay loop>
            <source src="../../video/laden.mp4" type="video/mp4">
            Now Loading
        </video>
    </div>

    <section class="container background-color-3">
        <div class="image-container color-7">
            <img id='product-image' src="../../images/placeholder.webp"/>
        </div>
    </section>
    <div id='eco-score-color' class="eco-score-container eco-color-unknown">
        <div class="eco-score-flex-container">
            <h2 id='product-name' class="product-title results">Lorem Ipsum</h2>
            <div class="eco-score-img-text-container">
                <div class="text-stacker">
                    <p class="bold results">Gewicht:</p>
                    <p id="quantity" class="results"></p>
                    <p class="bold results">CO2 per 100gr:</p>
                    <p id='co2-score' class="results"></p>
                </div>
                <img class='eco-score-img' id="ecoscore-image"
                     src="https://static.openfoodfacts.org/images/attributes/dist/ecoscore-unknown.svg">
            </div>
        </div>
    </div>
    <div style="display: flex; margin-top: 1rem; margin-bottom: 1rem">
        <h3 id="categories" style="font-weight: lighter">Categorie</h3>
    </div>
    <div class="accordion-wrapper">
        <button class="accordion">CO2 Informatie <img class="accordion-image" src="../../images/chefron.svg"/></button>
        <div class="panel">
            <ul>
                <li id="co2-info">
                </li>
            </ul>
        </div>

        <button class="accordion">Verpakking & Recycle Informatie<img class="accordion-image"
                                                                      src="../../images/chefron.svg"/></button>
        <div class="panel">
            <ul>
                <li id="packaging">
                </li>
                <li id="recycling">
                </li>
            </ul>
        </div>

        <button class="accordion">Transport Informatie<img class="accordion-image" src="../../images/chefron.svg"/>
        </button>
        <div class="panel">
            <ul>
                <li id="transport">
                </li>
            </ul>
        </div>


    </div>
    <?php

    if ($loggedIn) {
        echo '    <button class="save-info eco-color-grey">
        <h3 id="button-text" class="color-white"> bewaar zoekopdracht </h3>
    </button>
    ';
    }
/*
    // Check if the EAN is 8710412043749 and display the link
    if ($ean == '8710412043749') {
        $link = "https://localhost/TLE-1/pages/product-info/index.php?ean=7622201751708";
        echo '<div style="text-align: center; margin-top: 20px; font-size: 24px; color: blue;">
        <a href="' . $link . '" target="_blank">Recommended Product</a>
      </div>';

    }
    if ($ean == '8712800188339') {
        $link = "https://localhost/TLE-1/pages/product-info/index.php?ean=7394376616136";
        echo '<div style="text-align: center; margin-top: 20px; font-size: 24px; color: blue;">
        <a href="' . $link . '" target="_blank">Recommended Product</a>
      </div>';

    }
    */
    ?>
    <div style="margin-top: <?php if ($loggedIn) {
        echo '6rem';
    } else {
        echo '0';
    } ?>"></div>

    <style>
        .recommended-eco-score-img{
            max-width: 35%;
            position: relative;
            border-radius: 0;
            left: 6rem;
            bottom: 2rem;
        }

        .recommended-container{
            background-color: rgba(149, 149, 149, 0.25);
            border-radius: 1.5rem;
            padding-bottom: 2rem;
            min-width: 90vw;
            max-width: 90vw;
            min-height: 35vh;
            max-height: 35vh;
        }

        .text-buttons{
            padding: 0 1rem;
            margin: 1.5rem 0.5rem;
            border-radius: 0.5rem;
            background-color: #59733F;
            color: white;
        }

        .recommended-text-flexbox{
            display: flex; justify-content: space-around; align-items: center;
        }
        .recommended-image-flexbox{
            flex-direction: column;
        }

    </style>
    <h2 style="margin-bottom: 1rem">Aanbevolen ECO-Producten</h2>
    <div class="recommended-container">
        <div class="recommended-text-flexbox">
            <h1 id="previous" class="text-buttons"><</h1>
            <h3 id="product-title-recommended" style="color: black;max-width: 40%;min-width: 40%;">Loading...</h3>
            <h1 id="next" class="text-buttons">></h1>
        </div>
        <div class="recommended-image-flexbox" style="display: flex">
            <img id="product-image-recommended" src="../../images/placeholder.webp" style="max-width: 80%;">
            <img id="ecoscore-recommended" class='recommended-eco-score-img' src="../../images/eco-score/ecoscore-unknown.svg">
        </div>
    </div>
</main>
<?php include('../../includes/footer.php'); ?>

</body>
</html>
