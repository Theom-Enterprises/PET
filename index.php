<?php
require './vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;

$result = Builder::create()
    ->data('tel:+43 1 22 33 444')
    ->encoding(new Encoding('UTF-8'))
    ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
    ->size(150)
    ->margin(10)
    ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
    ->labelText('Max Mustermann')
    ->labelFont(new NotoSans(15))
    ->labelAlignment(new LabelAlignmentCenter())
    ->build();

// Generate a data URI to include image data inline (i.e. inside an <img> tag)
$dataUri = $result->getDataUri();

?>

<!doctype html>
<html class="h-100 w-100" lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PET - Welcome</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="h-100 w-100" style="background-color: #4695d4">
<div class=" h-100 mx-auto w-50 p-3 d-flex flex-column align-content-center text-center" style="background-color: #8faac2">
    <h1>Willkommen bei PET!</h1>
    <div class="my-3">
        <p class="m-auto text-start" style="max-width: 500px">
            Mit unserem QR Code Generator lässt sich ein QR Code für ihr Haustier generieren, welches Ihren Namen &
            Telefonummer enthält. Bei Verlust Ihres Haustieres kann Sie der Finder mithilfe des Codes mit nur einem Scan
            kontaktieren.
        </p>
    </div>

    <div class="d-flex m-auto my-2">
        <div>
        <h3>Demo QR Code:</h3>
        <p style="max-width: 300px">
            Hier präsentieren wir einen Demo QR Code mit der Telefonnumer:
            <br>
            +43 1 22 33 444
        </p>
        </div>
        <img src="<?php echo $dataUri ?>" alt="Demo Qr Code">
    </div>

    <div class="my-2">
        Erstellen Sie schnell und einfach Ihren Code
        <a href="src/createQrCode.php" class="btn btn-primary p-1">
            hier
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>

