<?php
session_start();
if (isset($_GET['error'])) {
    $error = $_GET['error'];
} else {
    $error = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/elisa.css">
    <link rel="stylesheet" href="../../css/isis.css">

    <style>
        /* In order to place the tracking correctly */
        canvas.drawing, canvas.drawingBuffer {
            position: absolute;
            left: 15vw;
            top: 24vw;
            border-radius: 1.5rem;
        }
    </style>
</head>
<header>
    <div id="meta-data-error" style="display: none;"><?php echo $error ?></div>
</header>
<body>
<?php include('../../includes/nav.php'); ?>
<main>

<!-- Div to show the scanner -->
<div id="scanner-container">
</div>
<input style='display: none' type="button" id="btn" value="Start/Stop the scanner"/>
<script src="../../js/scannerQTracking.js"></script>

    <!-- Include the image-diff library -->
    <p id="error" style="color: red"><?php echo $error ?></p>
    <p id="warning"></p>

    <div class="wrapper">
        <a href = "upload.php">
            <div class="box color-3" style="padding: 1.5rem;">
                <h2 class="color-white">Upload/maak een foto</h2>
                <img src="../../images/icons/upload.svg">
            </div>
        </a>
    </div>

    <div style="padding: 1rem; align-items: baseline;" class="box info">
        <h2 class="color-1">Hoe te gebruiken?</h2>
        <p class="color-1">
            Op de scanpagina van EcoJourney kun je producten scannen door simpelweg de barcode te scannen of een foto van het product te uploaden. De app analyseert de gegevens en geeft direct de eco-score, zodat je snel kunt zien hoe milieuvriendelijk het product is.        </p>
    </div>
    <script>
    let keypressArray = [];

    window.onload = function () {
        let video = document.getElementsByTagName('video')[0]
        video.setAttribute('playsinline', '');
        video.style.borderRadius = '1.5rem'
    };

    document.addEventListener("keypress", function(e) {
        if (e.target.tagName !== "INPUT") {
            /*
            var input = document.querySelector(".my-input");
            input.focus();
            input.value = e.key;
             */
            console.log(e.key)
            keypressArray.push(e.key)
            console.log(keypressArray)
            e.preventDefault();
        }
    });


</script>
</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>


