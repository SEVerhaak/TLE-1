<?php
//require_once "../../api/db.php";
///** @var mysqli $db */
session_start();

$loggedIn = false;

if (isset($_GET['ean'])) {
    $ean = $_GET['ean'];
    if (isset($_SESSION['users_id'])) {
        $id = $_SESSION['users_id'];
        $loggedIn = true;
    } else {
        $id = '';
    }
//    $ean = mysqli_real_escape_string($db, $_GET['ean']);
    // Controleer of er al een array voor EAN's in de sessie bestaat, zo niet, maak er een
} else {
    //header('location: ../homepage');
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
    <title>Layout</title>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/bas.css">
    <link rel="stylesheet" href="../../css/elisa.css">
    <script type="text/javascript" src="../../js/productPagina.js" defer></script>

</head>
<style>

</style>
<header>
    <div id="meta-data-ean" style="display: none;"><?php echo $ean ?> </div>
    <div id="meta-data-id" style="display: none"><?= $id ?></div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>

<main>

    <div id="loading" style="display: flex; justify-content: center; align-items: center; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.8); z-index: 9999;">
        <video id="loading-video" width="80%" autoplay loop>
            <source src="../../video/laden.mp4" type="video/mp4">
            Now Loading
        </video>
    </div>

    <section class="container background-color-3">
        <div class="image-container color-7">
            <img id='product-image' src="../../images/placeholder.webp"
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
        <button class="accordion">CO2 Informatie <img class = "accordion-image" src="../../images/chefron.svg" /></button>
        <div class="panel">
            <ul>
                <li id="co2-info">
                </li>
            </ul>
        </div>

        <button class="accordion">Verpakking & Recycle Informatie<img class = "accordion-image" src="../../images/chefron.svg" /></button>
        <div class="panel">
            <ul>
                <li id="packaging">
                </li>
                <li id="recycling">
                </li>
            </ul>
        </div>

        <button class="accordion">Transport Informatie<img class = "accordion-image" src="../../images/chefron.svg" /></button>
        <div class="panel">
            <ul>
                <li id="transport">
                </li>
            </ul>
        </div>
            <div class = "recommendation" >
        </div >

    </div>
    <?php
    if($loggedIn){
        echo '    <button class="save-info eco-color-grey">
        <h3 id="button-text" class="color-white"> bewaar zoekopdracht </h3>
    </button>
    '; }?>
    <div style="margin-top: <?php if($loggedIn){echo '6rem';}else{echo '0';}?>"></div>

</main>
<?php include('../../includes/footer.php'); ?>

</body>
</html>
