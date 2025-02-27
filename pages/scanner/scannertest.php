<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.rawgit.com/serratus/quaggaJS/0420d5e0/dist/quagga.min.js"></script>
    <style>
        /* In order to place the tracking correctly */
        canvas.drawing, canvas.drawingBuffer {
            position: absolute;
            left: 0;
            top: 0;
        }
    </style>
</head>

<body>
<!-- Div to show the scanner -->
<div id="scanner-container"></div>
<input style='display: none' type="button" id="btn" value="Start/Stop the scanner" />
<script src="../../js/scannerQTracking.js"></script>

<!-- Include the image-diff library -->
<script src="quagga.min.js"></script>


</body>

</html>
