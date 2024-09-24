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
        }
    </style>
</head>

<body>
<?php include('../../includes/nav.php'); ?>
<main>

<!-- Div to show the scanner -->
<div id="scanner-container">

</div>
<input style='display: none' type="button" id="btn" value="Start/Stop the scanner"/>
<script src="../../js/scannerQTracking.js"></script>

    <div class="box info">
        <h2 class="color-1">Hoe te gebruiken?</h2>
        <p class="color-1">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto consequatur debitis deleniti obcaecati provident! Aliquid atque autem corporis esse, ex explicabo facere, facilis illo illum maiores, minus officia optio soluta.
        </p>
    </div>


<!-- Include the image-diff library -->
    <div class="wrapper">
        <a href = "upload.php">
            <div class="box color-3">
                <h2 class="color-white">Upload/maak een foto</h2>
                <img src="../../images/upload.png">
            </div>
        </a>
    </div>

<p id="warning"></p>
<script>
    let keypressArray = [];

    window.onload = function () {
        let video = document.getElementsByTagName('video')[0]
        video.setAttribute('playsinline', '');
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


