<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Layout test</title>
</head>
<style>
    body {
        background-color: #FAF4EB;
        margin: 0;
    }

    main {
        margin: 1rem;
    }

    .box {
        padding: 12.5vw 5vw;
        border-radius: 1.5rem;
        margin: 3vw 1vw;
    }

    .background-color-1{
        background-color: #FAF4EB;
    }

    .color-1 {
        background-color: #152108;
    }

    .color-2 {
        background-color: #59733F;
    }

    .color-3 {
        background-color: #F5D07C;
    }

    .color-4 {
        background-color: #E5E5E5;
        /* gebruik transparancy 40% / 60% */
    }

    .color-5 {
        background-color: #E3E2DE;
    }

    .color-white{
        background-color: white;
    }

    .text-color-1{
        color: #152108;
    }

    .text-color-2{
        color: #E5E5E5;
    }

    .text-color-3{
        color: black;
    }


    .container{
        display: flex;
        flex-direction: column;
    }


</style>
<body>
<main>
    <section class="container">
    <div class="box color-2">
        <p class="text-color-1">Sample text</p>
    </div>
    <div class="box color-3">
        <p>Sample text</p>
    </div>
    </section>
</main>
</body>
</html>
