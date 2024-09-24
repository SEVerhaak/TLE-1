<?php
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
    }

    .eco-score-container{
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        border-radius: 1.5rem;
        top: -2rem;
        position: relative;
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



    .accordion {
        background-color: white;
        color: #444;
        cursor: pointer;
        padding: 6vw;
        width: 100%;
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
        padding: 0 8vw;
        display: none;
        background-color: white;
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
        bottom: 6rem;
        font-size: 1.1rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    .accordion-container{
        display: flex;
        flex-direction: row;
    }

</style>
<body>
<main>
    <section class="container background-color-3" >
        <div class="image-container color-7">
            <img src="../../images/placeholder.webp"
        </div>
    </section>
    <div class="eco-score-container eco-color-grey">
        <div class="eco-score-flex-container">
            <h2 class="product-title">Lorem Ipsum</h2>
            <div class="eco-score-img-text-container">
                <div class="text-stacker">
                    <p class="bold">Lorem Ipsum:</p>
                    <p>Lorem Ipsum</p>
                    <p class="bold">Lorem Ipsum:</p>
                    <p>Lorem Ipsum</p>
                </div>
                    <img class='eco-score-img' src="https://static.openfoodfacts.org/images/attributes/dist/ecoscore-unknown.svg">
            </div>
        </div>
    </div>
    <div style="display: flex; margin-top: 1rem; margin-bottom: 1rem">
        <h3>Categorie 1, </h3>
        <h3>Categorie 2, </h3>
        <h3>Categorie 3</h3>
    </div>
    <div>
        <button class="accordion">Section 1</button>
        <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>

        <button class="accordion">Section 2</button>
        <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>

            <button class="accordion">Section 3</button>

        <div class="panel">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </div>
    <button class="save-info eco-color-grey">
        <h3> bewaar zoekopdracht </h3>
    </button>
    <div style="margin-top: 20rem"></div>

</main>
</body>
<script>
    let accordion = document.getElementsByClassName("accordion");

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
</script>
</html>
