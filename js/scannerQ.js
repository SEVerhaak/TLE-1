const quaggaConf = {
    inputStream: {
        target: document.querySelector("#camera"),
        type: "LiveStream",
        constraints: {
            width: { min: 640 },
            height: { min: 480 },
            facingMode: "environment",
            aspectRatio: { min: 1, max: 2 }
        }
    },
    decoder: {
        readers: ['code_128_reader']
    },
}

Quagga.init(quaggaConf, function (err) {
    if (err) {
        return console.log(err);
    }
    Quagga.start();
});

Quagga.onDetected(function (result) {
    //alert("Detected barcode: " + result.codeResult.code);

});

function fetchEAN(ean) {
    fetch(`http://localhost/TLE-1/api/product-data-api.php?ean=${ean}`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0){
                console.log('no results found')
                return false;
            } else{
                console.log(data)
            }

        })
        .catch(error => console.error('Error:', error));
}