<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
    <link rel="stylesheet" href="../../css/style.css">
    <style>
        /* In order to place the tracking correctly */
        canvas.drawing, canvas.drawingBuffer {
            position: absolute;
            left: 15vw;
            top: 24vw;
        }
    </style>
</head>
<nav>
    <a href = "../homepage"><img src="../../images/arrow.png" alt="Menu"></a>
</nav>
<body>
<!-- Div to show the scanner -->
<div id="scanner-container">

</div>
<input style='display: none' type="button" id="btn" value="Start/Stop the scanner"/>
<script src="../../js/scannerQTracking.js"></script>

<!-- Include the image-diff library -->
<div class="wrapper">
    <a href = "upload.php"><button>Upload een foto</button></a>
    <button>Geschiedenis</button>
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
</body>
</html>


