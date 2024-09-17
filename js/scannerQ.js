const resultElement = document.getElementById('result')

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
        readers: ['ean_reader', 'code_128_reader']
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
    fetchEAN(result.codeResult.code)
    console.log(result.codeResult.code)
});

let filterArray = [];

function filter(ean){
    if (filterArray.includes(ean)){

    }
}

function fetchEAN(ean) {
    // fetch(`http://localhost/TLE-1/api/product-data-api.php?ean=${ean}`)

    fetch(`https://world.openfoodfacts.org/api/v3/product/${ean}.json`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0){
                console.log('no results found');
                console.log(data);
                errorHandler();
                return false;
            } else{
                if (data.errors.length === 0){
                    succesHandler(ean);
                    console.log(data);
                    return true;
                } else{
                    console.log('no results found');
                    console.log(data);
                    errorHandler();
                    return false;
                }
            }

        })
        .catch(error => errorHandler(error));
}

function succesHandler(ean){
    // !!!! dit moet veranderd worden tijdelijke fix !!!!!
    window.location.href = `http://localhost/TLE-1/pages/product-info/index.php?ean=${ean}`;
}

function errorHandler(err){
    console.error('EAN Fetch error ' + err)
    resultElement.textContent = 'EAN not recognized'
}

function fetchJSON(ean) {
    fetch(`https://world.openfoodfacts.org/api/v3/product/${ean}.json`)
        .then(response => response.json())
        .then(data => {
            if (data.length === 0){
                console.log(data)
                return false;
            } else{
                console.log(data)
            }

        })
        .catch(error => console.error('Error:', error));
}
