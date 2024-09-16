// check of de API ondersteunt wordt
console.log('active')
if ('BarcodeDetector' in window) {
    const video = document.getElementById('video');
    const resultDiv = document.getElementById('result');

    // Haal camera feed op (voorkeur naar voorste camera's)
    // returned een MediaStream object
    navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
        .then(stream => {
            // zorg dat het video element op de pagina gebruik maakt van de webcam stream
            // video.srcObject is de bron die het video HTML element gebruikt & stream is de webcam/camera stream
            video.srcObject = stream;
            // geef aan welke barcodes ondersteunt worden
            // https://developer.mozilla.org/en-US/docs/Web/API/Barcode_Detection_API
            // op die hierboven aangegeven site staan alle verschillende ondersteunde formaten
            const barcodeDetector = new BarcodeDetector({ formats: ['ean_13', 'code_128', 'qr_code'] });
            // als de video afspeelt start het scannnen
            video.addEventListener('play', () => {
                const scanBarcode = () => {
                    console.log('scanning')
                    // functie uit de API om uit een videoframe de barcode te halen
                    barcodeDetector.detect(video)
                        .then(barcodes => {
                            // barcode gespot, pas de tekst onder het frame aan met de gevonden barcode
                            if (barcodes.length > 0) {
                                resultDiv.textContent = 'Barcode: ' + barcodes[0].rawValue;
                                // hier kunnen we verder dingen aan toevoegen met de gevonden barcode
                                barcodeCheck(barcodes[0].rawValue)
                            } else{
                                console.log('no barcode found')
                            }
                        })
                        .catch(err => {
                            // error handling
                            console.error('Barcode detection failed:', err);
                        });
                    // Als het browser vernster opnieuw getekent wordt, dan wordt de ScanBarcode functie opnieuw uitgevoerd
                    // hierdoor blijft de functie constant aan
                    requestAnimationFrame(scanBarcode);
                };
                // initiele start van de functie
                scanBarcode();
            });
        })
        .catch(err => {
            // error handling camera
            console.error('Error accessing camera:', err);
            resultDiv.textContent = 'Camera access error!';``
        });
} else {
    // error handling
    document.getElementById('result').textContent = 'Barcode Detector is not supported by this browser.';
}

function barcodeCheck(barcode){

}