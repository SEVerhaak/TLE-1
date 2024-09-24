let _scannerIsRunning = false;
//let filterMax = 25;
let results = [];
let processCounter = 0;

startScanner();

function startScanner() {

    Quagga.init({

        inputStream: {
            // basis instellingen voor de camera live stream
            name: "Live",
            type: "LiveStream",
            // bepaalt het element waar de video op gestreamd worden
            target: document.querySelector('#scanner-container'),
            constraints: {
                // bepaald de resolutie niet aankomen
                width: 280,
                height: 320,
                // buiten camera heeft voorkeur
                facingMode: "environment"
            },

        },
        // hoe vaak er per seconde gescand wordt
        frequency: 60,
        // type barcodes waarvoor gezocht moet worden
        decoder: {
            readers: [
                "code_128_reader",
                "ean_reader"
            ],
            // debug info niet aankomen
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
        // instellingen voor efficienter scannen
        locator:
            {
                halfSample: false,
                patchSize: "medium", // x-small, small, medium, large, x-large
            }

    }, function (err) {
        // error handler als de scanner niet kan starten
        if (err) {
            console.log(err);
            document.getElementById('warning').textContent = 'kon de scanner niet starten!'
            return
        }
        console.log("Initialization finished. Ready to start");
        Quagga.start();
        document.getElementById('warning').textContent = 'Scanner gestart!'

        // Scanner running boolean aan
        _scannerIsRunning = true;
    });

    Quagga.onProcessed(function (result) {
        var drawingCtx = Quagga.canvas.ctx.overlay,
            drawingCanvas = Quagga.canvas.dom.overlay;

        if (result) {
            processCounter++
            if (result.boxes && processCounter === 10) {
                drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                result.boxes.filter(function (box) {
                    return box !== result.box;
                }).forEach(function (box) {
                    Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
                });
                processCounter = 0;
            }

            if (result.box) {
                Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
            }

            if (result.codeResult && result.codeResult.code) {
                Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
            }
        }
    });

    Quagga.onDetected(function (result) {

        console.log("Barcode detected and processed : [" + result.codeResult.code + "]");
        // results.push(result.codeResult.code)
        addVariable(result.codeResult.code)
    });
}


function fetchEAN(ean) {
    // fetch(`http://localhost/TLE-1/api/product-data-api.php?ean=${ean}`)
    window.location.href = `../product-info/index.php?ean=${ean}`

    /*
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

     */
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

function addVariable(variable) {
    results.push(variable);

    // Check if any variable occurs 5 times
    let occurrences = results.filter(item => item === variable).length;

    if (occurrences === 5) {
        fetchEAN(variable);
        results = [];
    }
}