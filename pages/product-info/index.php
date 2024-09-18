<?php
//require_once "../../api/db.php";
///** @var mysqli $db */
session_start();
if (isset($_GET['ean'])) {
    $ean = $_GET['ean'];
    if (isset($_SESSION['users_id'])) {
        $id = $_SESSION['users_id'];
    } else{
        $id = '';
    }
//    $ean = mysqli_real_escape_string($db, $_GET['ean']);
    // Controleer of er al een array voor EAN's in de sessie bestaat, zo niet, maak er een
} else {
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
    <div id="meta-data-id" style="display: none"><?= $id ?></div>
</header>
<body>

<nav>
    <a href = "../homepage"><img src="../../images/arrow.png" alt="Menu"></a>
</nav>

<section>
    <h1 id="product-name"></h1>
    <img id="product-image">
    <p id="categories"></p>
    <p id="quantity"></p>
    <p id="nutri-score"></p>
    <img id="nutri-score-image">
    <div id="ingredienttagwrapper">
        <p id="ingredienttag_0">Palmolie: </p>
        <p id="ingredienttag_1">Vegan: </p>
        <p id="ingredienttag_2">Vegetarisch: </p>
    </div>
    <img id="ecoscore-image">
    <p id="ecoscore-score"></p>
    <p id="co2-score"></p>
    <p id="packaging"></p>
    <p id="recycling"></p>
    <p id="transport"></p>
    <p>Ingredients:</p>
    <img id="ingredients-image">
    <a href="../scanner">
        <button>Scan opnieuw</button>
    </a>

</section>

</body>
</html>
<script>
    const ean = document.getElementById('meta-data-ean').innerHTML;
    const userId =  document.getElementById('meta-data-id').textContent;
    let url = `https://world.openfoodfacts.org/api/v2/product/${ean}.json`;
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
                dataHandler(data)
                let name
                if (data.product.brands && data.product.product_name){
                    name = `${data.product.brands} - ${data.product.product_name}`
                    saveToHistory(ean, name, userId)
                } else{
                    name = 'N.A'
                    saveToHistory(ean, name, userId)
                }
            } else {
                window.location.href = '../scanner'
            }
        })
        .catch(error => {
            // Foutafhandeling als het verzoek mislukt
            console.error('Er is een fout opgetreden:', error);
        });

    function saveToHistory(ean, name, id){
        if (userId !== '' && userId !== undefined && userId){
            console.log('saving to history!')
            const url = `../../api/history-add.php?ean=` + encodeURIComponent(`${ean}`) + `&name=` + encodeURIComponent(`${name}`) + `&id=` + encodeURIComponent(`${id}`)
            fetch(url)
                .then(response => {
                    // Controleer of het verzoek succesvol was
                    if (!response.ok) {
                        //window.location.href = '../scanner'
                        throw new Error('Network response was not ok');
                    }
                    // Converteer de response naar JSON
                    return response.json();
                })
                .then(data => {

                })
                .catch(error => {
                    // Foutafhandeling als het verzoek mislukt
                    console.error('Er is een fout opgetreden:', error);
                });
        }
    }

    function dataHandler(data) {
        console.log(data);
        if (data.product.brands !== undefined && data.product.brands !== '' && data.product.brands !== null) {
            if (data.product.product_name !== undefined && data.product.product_name !== '' && data.product.product_name !== null) {
                document.getElementById('product-name').innerHTML = `${data.product.brands} - ${data.product.product_name}`;
            } else {
                document.getElementById('product-name').innerHTML = `${data.product.brands}`;
            }
        } else if (data.product.product_name !== undefined && data.product.product_name !== '' && data.product.product_name !== null) {
            document.getElementById('product-name').innerHTML = `${data.product.product_name}`;
        } else {
            document.getElementById('product-name').innerHTML = `Geen naam of merk bekend voor dit product!`;
        }


        if (data.product.image_front_small_url !== undefined && data.product.image_front_small_url !== '' && data.product.image_front_small_url !== null) {
            document.getElementById('product-image').src = `${data.product.image_front_small_url}`;
        } else {
            // dit veranderen tijdelijk!!
            // dit veranderen tijdelijk!!
            // dit veranderen tijdelijk!!
            // dit veranderen tijdelijk!!
            document.getElementById('product-image').src = `../../images/placeholder.webp`;
        }

        if (data.product.categories !== undefined && data.product.categories !== '' && data.product.categories !== null) {
            document.getElementById('categories').innerHTML = `Categorien: ${data.product.categories}`;
        } else {
            console.log('categorien')
            document.getElementById('categories').innerHTML = 'Geen categorien gevonden'
        }


        if (data.product.product_quantity !== undefined && data.product.product_quantity !== '' && data.product.product_quantity !== null) {
            if (data.product.product_quantity_unit !== undefined && data.product.product_quantity_unit !== '' && data.product.product_quantity_unit !== null) {
                document.getElementById('quantity').innerHTML = `Hoeveelheid: ${data.product.product_quantity} ${data.product.product_quantity_unit}`;
            } else {
                document.getElementById('quantity').innerHTML = `Hoeveelheid: ${data.product.product_quantity}`;
            }
        } else {
            console.log(`Geen gewicht bekend voor dit product`)
            document.getElementById('quantity').innerHTML = `Geen gewicht bekend voor dit product`;
        }

        if (data.product.nutriscore_2023_tags[0] !== '' && data.product.nutriscore_2023_tags[0] !== null && data.product.nutriscore_2023_tags[0] !== undefined) {
            document.getElementById('nutri-score-image').src = `https://static.openfoodfacts.org/images/attributes/dist/nutriscore-${data.product.nutriscore_2023_tags[0]}-new-en.svg`;
        } else if (data.product.nutriscore_2021_tags[0] !== '' && data.product.nutriscore_2021_tags[0] !== null && data.product.nutriscore_2021_tags[0] !== undefined) {
            document.getElementById('nutri-score-image').src = `https://static.openfoodfacts.org/images/attributes/dist/nutriscore-${data.product.nutriscore_2021_tags[0]}-new-en.svg`;
        } else {
            document.getElementById('nutri-score-image').src = `https://static.openfoodfacts.org/images/attributes/dist/nutriscore-unknown-new-en.svg`;
        }

        if (data.product.ingredients_analysis_tags !== undefined) {
            for (let i = 0; i < 3; i++) {
                try {
                    let newString = data.product.ingredients_analysis_tags[i].slice(3)
                    if (newString !== '' && newString !== null && newString !== undefined) {
                        document.getElementById(`ingredienttag_${i}`).innerHTML = `${newString}`;
                    } else {
                        document.getElementById(`ingredienttag_${i}`).innerHTML = `Geen data`;
                    }
                } catch (e) {
                    console.error('Error slicing: ' + e)
                }
            }
        } else {
            document.getElementById(`ingredienttagwrapper`).style.display = 'none';
        }

        if (data.product.ecoscore_grade !== '' && data.product.ecoscore_grade !== null && data.product.ecoscore_grade) {
            document.getElementById('ecoscore-image').src = `https://static.openfoodfacts.org/images/attributes/dist/ecoscore-${data.product.ecoscore_grade}.svg`;
        } else {
            document.getElementById('ecoscore-image').src = `https://static.openfoodfacts.org/images/attributes/dist/ecoscore-unknown.svg`;
        }

        if (data.product.ecoscore_score !== undefined && data.product.ecoscore_score !== '') {
            document.getElementById('ecoscore-score').innerHTML = `Ecoscore: ${data.product.ecoscore_score}%`;
            if (data.product.ecoscore_data.agribalyse.co2_total !== undefined && data.product.ecoscore_data.agribalyse.co2_total !== '') {
                document.getElementById('co2-score').innerHTML = `CO2-score: ${Math.round(data.product.ecoscore_data.agribalyse.co2_total * 100)} gram CO2 uitstoot per 100 gram product`;
            } else {
                document.getElementById('co2-score').innerHTML = ``;
            }
        } else {
            document.getElementById('ecoscore-score').innerHTML = `Ecoscore: Onbekend`;
        }

        if (data.product.packaging !== undefined && data.product.packaging !== '') {
            document.getElementById('packaging').innerHTML = `Verpakking: ${data.product.packaging}`;
        } else {
            document.getElementById('packaging').innerHTML = `Verpakking: Onbekend`;
        }

        if (data.product.packaging_recycling_tags !== undefined && data.product.packaging_recycling_tags !== '' && data.product.packaging_recycling_tags.length !== 0) {
            document.getElementById('recycling').innerHTML = `Recycling: ${data.product.packaging_recycling_tags}`;
        } else {
            document.getElementById('recycling').innerHTML = `Recycling: Onbekend`;
        }

        if (data.product.origins !== undefined && data.product.origins !== '') {
            document.getElementById('transport').innerHTML = `Transport: ${data.product.origins}`;
        } else {
            document.getElementById('transport').innerHTML = `Transport: Onbekend`;
        }

        if (data.product.image_ingredients_small_url !== undefined && data.product.image_ingredients_small_url !== '') {
            document.getElementById('ingredients-image').src = `${data.product.image_ingredients_small_url}`;
        } else {
            document.getElementById('ingredients-image').src = ``;
        }


        //document.getElementById('nutri-score').innerHTML = `Nutri-score: ${data.product.nutriscore_2021_tags || 'N/A'}`;

        console.log(data.product.packaging_recycling_tags.length)

    }
</script>