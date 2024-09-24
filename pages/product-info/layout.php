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
</head>
<style>
    .container{

    }

    .eco-color-a{
        background-color: #1E8F4E;
    }

    .eco-color-b{
        background-color: #2ECC71;

    }

    .eco-color-c{
        background-color: #F5C100;
    }

    .eco-color-d{
        background-color: #EF7E1A;
    }

    .eco-color-e{
        background-color: #D93726;
    }

    .eco-color-grey{
        background-color: #B3B3B3;
    }

    .image-container{
        padding: 1vw;
        border-radius: 1.5rem;
        width: 85vw;
        background-color: rgba(149, 149, 149, 0.5);
    }

    .eco-score-container{
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        border-radius: 1.5rem;
        top: -2rem;
        position: relative;
        box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.1);
    }

    img{
        max-width: 85vw;
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-radius: 1.5rem;
    }

    .eco-score-img{
        width: 40%;
        height: fit-content;
        border-radius: 0;
        margin-top: auto;
        margin-bottom: auto;
        margin-left: 0;
        margin-right: 0;
    }

    .product-title{
        padding: 0.5rem 1rem;
    }

    .eco-score-flex-container{

    }

    .eco-score-img-text-container{
        display: flex;
        padding: 0.5rem 1rem;
        justify-content: space-between;
    }

    .text-stacker{
        display: flex;
        flex-direction: column;
    }

    .bold{
        font-weight: bold;
    }

    .accordion-wrapper{
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .accordion {
        background-color: white;
        color: #444;
        cursor: pointer;
        padding: 6vw;
        width: 85vw;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
        box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.05);
        margin: 2vw 0;
        border-radius: 0.5rem;
    }

    .active{
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0);
        border-radius: 0.5rem 0.5rem 0 0;
    }

    .panel {
        margin-top: -2vw;
        padding: 0;
        display: none;
        background-color: white;
        width: 85vw;
        overflow: hidden;
        border-radius: 0 0 0.5rem 0.5rem;
        transition: all 0.3s ease-in-out;
    }


    .save-info{
        border: none;
        border-radius: 1.5rem;
        padding: 1.5rem;
        position: fixed;
        left: 0;
        right: 0;
        margin-inline: auto;
        width: 85%;
        bottom: 7rem;
        font-size: 1.1rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .accordion-container{
        display: flex;
        flex-direction: row;
    }

</style>
<header>
    <div id="meta-data-ean" style="display: none;"><?php echo $ean ?> </div>
    <div id="meta-data-id" style="display: none"><?= $id ?></div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>

<main>
    <section class="container background-color-3" >
        <div class="image-container color-7">
            <img id='product-image' src="../../images/placeholder.webp"
        </div>
    </section>
    <div class="eco-score-container eco-color-grey">
        <div class="eco-score-flex-container">
            <h2 id='product-name' class="product-title">Lorem Ipsum</h2>
            <div class="eco-score-img-text-container">
                <div class="text-stacker">
                    <p class="bold">Gewicht:</p>
                    <p>Lorem Ipsum</p>
                    <p class="bold">CO2 per 100gr:</p>
                    <p>Lorem Ipsum</p>
                </div>
                    <img class='eco-score-img' src="https://static.openfoodfacts.org/images/attributes/dist/ecoscore-unknown.svg">
            </div>
        </div>
    </div>
    <div style="display: flex; margin-top: 1rem; margin-bottom: 1rem">
        <h3 id="categories" style="font-weight: lighter">Categorie 1, </h3>
    </div>
    <div class="accordion-wrapper">
        <button class="accordion">CO2 Informatie</button>
        <div class="panel">
            <ul>
            <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
            </ul>
        </div>

        <button class="accordion">Verpakking Informatie</button>
        <div class="panel">
            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
            </ul>        </div>

            <button class="accordion">Transport Informatie</button>

        <div class="panel">
            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
            </ul>        </div>
    </div>
    <button class="save-info eco-color-grey">
        <h3> bewaar zoekopdracht </h3>
    </button>
    <div style="margin-top: 20rem"></div>

</main>
<?php include('../../includes/footer.php'); ?>

</body>
<script>
    let accordion = document.getElementsByClassName("accordion");
    const ean = document.getElementById('meta-data-ean').innerHTML;
    const userId =  document.getElementById('meta-data-id').textContent;
    let url = `https://world.openfoodfacts.org/api/v2/product/${ean}.json`;

    document.addEventListener("load", fetchResults);


    // voor de dropdown accordion menu's
    for (let i = 0; i < accordion.length; i++) {
        accordion[i].addEventListener("click", function() {
            console.log(this)
            let panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
                this.classList.remove("active");
            } else {
                panel.style.display = "block";
                this.classList.add("active");
            }
        });
    }

    // Gebruik de fetch-API om de data op te halen

    function fetchResults(){
        console.log('start of fetch')
        fetch(url)
            .then(response => {
                // Controleer of het verzoek succesvol was
                if (!response.ok) {
                    window.location.href = '../scanner'
                    throw new Error('Network response was not ok');
                }
                // Converteer de response naar JSON
                console.log('fetch complete')
                return response.json();
            })
            .then(data => {
                if (data && data.product) {
                    console.log('handling data')

                    localStorage.setItem('data', JSON.stringify(data.product))

                    if (localStorage.getItem('data')){
                        dataHandler(JSON.parse(localStorage.getItem('data')))
                    } else{
                        dataHandler(data)
                        let name
                        if (data.product.brands && data.product.product_name){
                            name = `${data.product.brands} - ${data.product.product_name}`
                            saveToHistory(ean, name, userId)
                        } else{
                            name = 'N.A'
                            saveToHistory(ean, name, userId)
                        }
                    }

                } else {
                    window.location.href = '../scanner'
                }
            })
            .catch(error => {
                // Foutafhandeling als het verzoek mislukt
                console.error('Er is een fout opgetreden:', error);
            });
    }


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
            document.getElementById('product-name').innerHTML = `N.A`;
        }


        if (data.product.image_front_small_url !== undefined && data.product.image_front_small_url !== '' && data.product.image_front_small_url !== null) {
            document.getElementById('product-image').src = `${data.product.image_front_small_url}`;
        } else {
            document.getElementById('product-image').src = `../../images/placeholder.webp`;
        }

        if (data.product.categories !== undefined && data.product.categories !== '' && data.product.categories !== null) {
            document.getElementById('categories').innerHTML = `Categorieën: ${data.product.categories}`;
        } else {
            console.log('categorien')
            document.getElementById('categories').innerHTML = 'Geen categorieën gevonden'
        }

        /*

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
         */


        //document.getElementById('nutri-score').innerHTML = `Nutri-score: ${data.product.nutriscore_2021_tags || 'N/A'}`;

        console.log(data.product.packaging_recycling_tags.length)

    }

</script>
</html>
