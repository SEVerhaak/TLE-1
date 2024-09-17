<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Barcode Scanner</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<nav>
    <a href="../homepage/index.php">
    <img src="../../images/arrow.png" alt="Terug">
    </a>
</nav>
<main>
<div id="camera"></div>
<script src="https://cdn.jsdelivr.net/npm/@ericblade/quagga2/dist/quagga.min.js"></script>
<!-- <div id="result">Waiting for barcode...</div> -->
<script src="../../js/scannerQ.js"></script>
<!--<h1 id="result">Geen barcode gevonden</h1>-->

    <a href = "../scanner">
        <button>Scan nog een product</button>
    </a>
    <a href="">
        <button>Product Geschiedenis</button>
    </a>


</main>

</body>
</html>

