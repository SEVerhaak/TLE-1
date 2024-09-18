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

<script>
    const fileSelector = document.getElementById('file-selector');
    fileSelector.addEventListener('change', (event) => {
        const fileList = event.target.files;
        useFile(fileList)
    });

    const camera = document.getElementById('picture')
    camera.addEventListener('change', (event) => {
        const fileList = event.target.files;
        useFile(fileList)
    });

    function useFile(file){
        console.log(file);

        Quagga.decodeSingle({
            decoder: {
                readers: ["code_128_reader", "ean_reader"] // List of active readers
            },
            locate: true, // try to locate the barcode in the image
            src: URL.createObjectURL(file[0]) // or 'data:image/jpg;base64,' + data
        }, function(result){
            if(result.codeResult) {
                console.log("result", result.codeResult.code);
                fetchEAN(result.codeResult.code)
            } else {
                console.log("not detected");
            }
        });
    }
    function fetchEAN(ean) {
        // fetch(`http://localhost/TLE-1/api/product-data-api.php?ean=${ean}`)

        fetch(`https://world.openfoodfacts.org/api/v3/product/${ean}.json`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    console.log('no results found');
                    console.log(data);
                    errorHandler();
                    return false;
                } else {
                    if (data.errors.length === 0) {
                        succesHandler(ean);
                        console.log(data);
                        return true;
                    } else {
                        console.log('no results found');
                        console.log(data);
                        errorHandler();
                        return false;
                    }
                }

            })
            .catch(error => errorHandler(error));
    }

    function succesHandler(ean) {
        // location.replace = `../product-info/index.php?ean=${ean}`;
        window.location.href = `../product-info/index.php?ean=${ean}`
        //location.replace(`../product-info/index.php?ean=${ean}`)
    }

    function errorHandler(err) {
        console.error('EAN Fetch error ' + err)
        //resultElement.textContent = 'EAN not recognized'
    }

</script>
</body>
</html>
