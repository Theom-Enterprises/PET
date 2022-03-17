<?php
namespace Theom\Pet;
require '../vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Theom\Pet\QrCode;


if (isset($_POST['submitBtn'])) {
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $result = Builder::create()
        ->data('tel:' . $tel)
        ->encoding(new Encoding('UTF-8'))
        ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
        ->size(300)
        ->margin(10)
        ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->labelText($name)
        ->labelFont(new NotoSans(20))
        ->labelAlignment(new LabelAlignmentCenter())
        ->build();


    $_POST['qrCodeString'] = $result->getString();
    $_POST['mimetype'] = $result->getMimeType();
    $_POST['qrCodeURI'] = $result->getDataUri();
}
if(isset($_POST['printview'])) {
    header('Content-Type: ' . $_POST['mimetype']);
    echo $_POST['qrCodeString'];
}
?>

<!doctype html>
<html class="h-100 w-100" lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PET - Create</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="h-100 w-100">
<div class=" h-100 mx-auto p-3 d-flex flex-column align-content-center text-center"
     style="background-color: #8faac2">
    <h1>PET QR Code erstellen</h1>
    <div class="my-3">
        <p class="m-auto text-start" style="max-width: 500px">
            Mit unserem QR Code Generator lässt sich ein QR Code für ihr Haustier generieren, welches Ihren Namen &
            Telefonummer enthält. Bei Verlust Ihres Haustieres kann Sie der Finder mithilfe des Codes mit nur einem Scan
            kontaktieren.
        </p>
    </div>

    <?php

    if (isset($_POST['qrCodeString'])) { ?>
        <div class="m-auto my-2">
            <div>
                <h3>Ihr QR Code:</h3>
            </div>
            <img src="<?php echo $_POST['qrCodeURI'] ?>" alt="Demo Qr Code">
        </div>
        <?php
    } else { ?>

        <div class="mx-auto w-50">
            <form method="post" action="createQrCode.php">
                <div class="row">
                    <div class="col-auto">
                        <label for="name" class="col-form-label">Name: </label>
                    </div>
                    <input id="name" class="form-control" type="text" name="name" required>
                </div>

                <div class="row">
                    <div class="col-auto">
                        <label for="name" class="col-form-label">Tel. Nummer: </label>
                    </div>

                    <input id="name" class="form-control" type="tel" name="tel" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="printview" class="form-check-input" value="1" id="printview">
                    <label class="form-check-label" for="printview">Printview</label>
                </div>

                <button type="submit" name="submitBtn" value="submitted" class="mt-3 btn btn-primary">
                    QR Code generieren
                </button>
            </form>
        </div>
        <?php
    }
    ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>
