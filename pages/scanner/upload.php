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
    <title>Upload picture</title>
</head>
<body>
<p>Upload bestaande foto</p>
<input type="file" id="file-selector" accept="image/*">
<p>Maak nieuwe foto (Alleen voor mobiel beschikbaar!)</p>
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
                readers: ["code_128_reader"] // List of active readers
            },
            locate: true, // try to locate the barcode in the image
            src: URL.createObjectURL(file[0]) // or 'data:image/jpg;base64,' + data
        }, function(result){
            if(result.codeResult) {
                console.log("result", result.codeResult.code);
            } else {
                console.log("not detected");
            }
        });
    }

</script>
</body>
</html>
