let _scannerIsRunning = false;
let filterMax = 25;
let results = [];

startScanner();

function startScanner() {

    Quagga.init({

        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#scanner-container'),
            constraints: {
                width: 280,
                height: 320,
                facingMode: "environment"
            },

        },
        decoder: {
            readers: [
                "code_128_reader",
                "ean_reader"
            ],
            debug: {
                showCanvas: true,
                showPatches: true,
                showFoundPatches: true,
                showSkeleton: true,
                showLabels: true,
                showPatchLabels: true,
                showRemainingPatchLabels: true,
                boxFromPatches: {
                    showTransformed: true,
                    showTransformedBox: true,
                    showBB: true
                }
            }
        },

    }, function (err) {
        if (err) {
            console.log(err);
            document.getElementById('warning').textContent = 'kon de scanner niet starten!'
            return
        }

        console.log("Initialization finished. Ready to start");
        Quagga.start();
        document.getElementById('warning').textContent = 'Scanner gestart!'

        // Set flag to is running
        _scannerIsRunning = true;
    });

    Quagga.onProcessed(function (result) {
        var drawingCtx = Quagga.canvas.ctx.overlay,
            drawingCanvas = Quagga.canvas.dom.overlay;

        if (result) {
            if (result.boxes) {
                drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                result.boxes.filter(function (box) {
                    return box !== result.box;
                }).forEach(function (box) {
                    Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                });
            }

            if (result.box) {
                Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
            }

            if (result.codeResult && result.codeResult.code) {
                Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
            }
        }
    });


    Quagga.onDetected(function (result) {

        console.log("Barcode detected and processed : [" + result.codeResult.code + "]");
        results.push(result.codeResult.code)
        if (results.length > filterMax){
            fetchEAN(mostFrequentNumber(results))
        }
    });
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
    window.location.href = `../product-info/index.php?ean=${ean}`;
}

function errorHandler(err){
    console.error('EAN Fetch error ' + err)
    resultElement.textContent = 'EAN not recognized'
}

function mostFrequentNumber(arr) {
    // Object om de frequenties van elk getal bij te houden
    let frequency = {};

    // Door de array lopen en frequenties bijwerken
    arr.forEach(num => {
        frequency[num] = (frequency[num] || 0) + 1;
    });

    // Variabelen om het meest voorkomende getal en zijn frequentie op te slaan
    let mostFrequent = null;
    let maxCount = 0;

    // Door het frequentie-object lopen om het getal met de hoogste frequentie te vinden
    for (let num in frequency) {
        if (frequency[num] > maxCount) {
            maxCount = frequency[num];
            mostFrequent = Number(num);
        }
    }

    results = [];

    return mostFrequent;
}
    