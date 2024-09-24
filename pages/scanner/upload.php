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
    <link rel="stylesheet" href="../../css/elisa.css">

    <title>Upload picture</title>
</head>

<body>
<?php include('../../includes/nav.php'); ?>

<main>
<h1>Upload</h1>
<div class = "upload-page">
    <img id="output" width="200" />
    <p id="error" style="color: red"></p>
    <input id = "send-image" type = "submit" name="button" value="Verstuur foto" class = "image-upload" style = "display: none"/>
    <input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;">
    <label for="file" style="cursor: pointer;" class = "image-upload">Upload een foto</label>
</div>

<!--<input type="file" id="file-selector" accept="image/*">-->

<script>
    let fileList
    let loadFile = function(event) {
        let image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    const fileSelector = document.getElementById('file');
    fileSelector.addEventListener('change', (event) => {
        fileList = event.target.files;
        document.getElementById('send-image').style.display = "block";
        let error = document.getElementById('error');
        error.textContent = "";
    });
    document.getElementById('send-image').onclick = function() {
        useFile(fileList, fileSelector)
    }


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
                    error.textContent = "";

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
</main>
<?php include('../../includes/footer.php'); ?>
</body>
</html>
