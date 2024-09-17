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
<p id = "categories"></p>
<p id = "quantity"></p>
<p id = "nutri-score"></p>
<img id = "nutri-score-image" >
<p id = "ingredienttag_0"></p>
<p id = "ingredienttag_1"></p>
<p id = "ingredienttag_2"></p>
<img id = "ecoscore-image" >
<p id = "ecoscore-score"></p>
<p id = "co2-score"></p>
<p id = "packaging"></p>
<p id = "recycling"></p>
<p id = "transport"></p>
<p>Ingredients:</p>
<img id = "ingredients-image" >
<a href = "../scanner"><button>Scan opnieuw</button></a>
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
                document.getElementById('product-name').innerHTML = `${data.product.brands} - ${data.product.product_name}`;
                document.getElementById('product-image').src = `${data.product.image_front_small_url || 'N/A'}`;
                document.getElementById('categories').innerHTML = `Categorien: ${data.product.categories}`;
                document.getElementById('categories').innerHTML = `Hoeveelheid: ${data.product.product_quantity} ${data.product.product_quantity_unit}`;
                if (data.product.nutriscore_2023_tags[0] !== '' && data.product.nutriscore_2023_tags[0] !== null && data.product.nutriscore_2023_tags[0]){
                    document.getElementById('nutri-score-image').src = `https://static.openfoodfacts.org/images/attributes/dist/nutriscore-${data.product.nutriscore_2023_tags[0]}-new-en.svg`;
                }else if (data.product.nutriscore_2021_tags[0] !== '' && data.product.nutriscore_2021_tags[0] !== null && data.product.nutriscore_2021_tags[0]) {
                    document.getElementById('nutri-score-image').src = `https://static.openfoodfacts.org/images/attributes/dist/nutriscore-${data.product.nutriscore_2021_tags[0]}-new-en.svg`;
                }else{

                }
                for(let i = 0; i < 3; i++){
                    let newString = data.product.ingredients_analysis_tags[i].slice(3)
                    document.getElementById(`ingredienttag_${i}`).innerHTML = `${newString}`;
                }
                if (data.product.ecoscore_grade !== '' && data.product.ecoscore_grade !== null && data.product.ecoscore_grade){
                    document.getElementById('ecoscore-image').src = `https://static.openfoodfacts.org/images/attributes/dist/ecoscore-${data.product.ecoscore_grade}.svg`;
                }else{

                }
                document.getElementById('ecoscore-score').innerHTML = `Ecoscore: ${data.product.ecoscore_score}%`;
                document.getElementById('co2-score').innerHTML = `CO2-score: ${Math.round(data.product.ecoscore_data.agribalyse.co2_total*100)} gram CO2 uitstoot per 100 gram product`;
                document.getElementById('packaging').innerHTML = `Verpakking: ${data.product.packaging}`;
                document.getElementById('recycling').innerHTML = `Recycling: ${data.product.packaging_recycling_tags}`;
                document.getElementById('transport').innerHTML = `Transport: ${data.product.origins}`;
                document.getElementById('ingredients-image').src = `${data.product.image_ingredients_small_url}`;



                //document.getElementById('nutri-score').innerHTML = `Nutri-score: ${data.product.nutriscore_2021_tags || 'N/A'}`;


                console.log(data.product.packaging)
                console.log(data.product.packaging_recycling_tags)
                console.log(data.product.image_ingredients_small_url)
                console.log(data.product.origins)

            } else {
                window.location.href = '../scanner'
            }
        })
        .catch(error => {
            // Foutafhandeling als het verzoek mislukt
            console.error('Er is een fout opgetreden:', error);
        });
</script>