<?php
//require_once "../../api/db.php";
///** @var mysqli $db */

if (isset($_GET['ean'])) {
    $ean = $_GET['ean'];
//    $ean = mysqli_real_escape_string($db, $_GET['ean']);
    // echo $ean;
} else{
    header('location: ../homepage');
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
    <title>Product-info</title>
</head>
<header>
    <div id="meta-data-ean" style="display: none;"><?php echo $ean ?> </div>
</header>
<body>
<h1 id = "product-name"></h1>
<img id = "product-image" >
<p id = "nutri-score"></p>
<div id="ean" style="display: none"><?= $ean ?></div>
<p>Producent: producer</p>
<p>diet-info: IF STATEMENT alleen als deze info er is</p>
<p>Materialen: materialen</p>
<p>Eco-impact: getal</p>
</body>
</html>
<script>
    let ean = document.getElementById('meta-data-ean').innerHTML;
    let url = `https://world.openfoodfacts.org/api/v2/product/${ean}.json`;
    console.log(url)
    // Gebruik de fetch-API om de data op te halen
    fetch(url)
        .then(response => {
            // Controleer of het verzoek succesvol was
            if (!response.ok) {
                window.location.href = '../scanner'
                throw new Error('Network response was not ok');
            }
            // Converteer de response naar JSON
            return response.json();
        })
        .then(data => {
            if (data && data.product) {
                document.getElementById('product-name').innerHTML = `${data.product.product_name || 'N/A'}`;
                document.getElementById('nutri-score').innerHTML = `Nutri-score: ${data.product.nutriscore_2021_tags || 'N/A'}`;
                document.getElementById('product-image').src = `${data.product.image_front_small_url || 'N/A'}`;
            } else {
                window.location.href = '../scanner'
            }
        })
        .catch(error => {
            // Foutafhandeling als het verzoek mislukt
            console.error('Er is een fout opgetreden:', error);
        });
</script>