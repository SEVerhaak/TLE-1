<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
    <link rel="stylesheet" href="../../css/style.css">

    <title>Upload picture</title>
</head>

<body>
<nav>
    <a href = "index.php"><img src="../../images/arrow.png" alt="Menu"></a>
</nav>
<h2>Upload bestaande foto</h2>
<input type="file" id="file-selector" accept="image/*">
<h2>Maak nieuwe foto (Alleen voor mobiel beschikbaar!)</h2>
<input type="file" id="picture" name="picture" accept="image/*" capture="environment" />
<p id="error" style="color: red"></p>
<script>
    const fileSelector = document.getElementById('file-selector');
    fileSelector.addEventListener('change', (event) => {
        const fileList = event.target.files;
        useFile(fileList, fileSelector)
    });

    const camera = document.getElementById('picture')
    camera.addEventListener('change', (event) => {
        const fileList = event.target.files;
        useFile(fileList, camera)
    });

    function useFile(file, selector){
        console.log(file);

        Quagga.decodeSingle({
            decoder: {
                readers: ["code_128_reader", "ean_reader"] // List of active readers
            },
            locate: true, // try to locate the barcode in the image
            src: URL.createObjectURL(file[0]) // or 'data:image/jpg;base64,' + data
        }, function(result){
            console.log(result)
            if (result){
                if(result.codeResult) {
                    console.log("result", result.codeResult.code);
                    //fetchEAN(result.codeResult.code)
                    const ean = result.codeResult.code
                    window.location.href = `../product-info/index.php?ean=${ean}`

                } else {
                    let error = document.getElementById('error');
                    error.textContent = "Geen barcode herkend in de foto!";
                    //selector.value = '';
                    console.log("not detected");
                }
            } else {
                let error = document.getElementById('error');
                error.textContent = "Geen barcode herkend in de foto!";
                //selector.value = '';
                console.log("not detected");
            }

        });
    }
</script>
</body>
</html>
