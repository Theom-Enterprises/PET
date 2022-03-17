<?php
namespace Theom\Pet;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;

class QrCode
{
    private $qrcodeURI;
    private $mimetype;
    private $qrcodeString;

    public function __construct($name, $telNumber)
    {
        $this->createQrCode($name, $telNumber);
    }

    private function createQrCode($name, $telNumber): void
    {
        $result = Builder::create()
            ->data('tel:' . $telNumber)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->labelText($name)
            ->labelFont(new NotoSans(20))
            ->labelAlignment(new LabelAlignmentCenter())
            ->build();

        $this->mimetype = $result->getMimeType();
        $this->qrcodeURI = $result;
        $this->qrcodeString = $result->getString();
    }

    public function getQrCodeURI()
    {
        return $this->qrcodeURI;
    }

    public function getQrCodeString()
    {
        return $this->qrcodeString;
    }

    public function getMimeType()
    {
        return $this->mimetype;
    }

    public function outputQrCode()
    {
        header('Content-Type: ' . $this->getmimetype());
        echo $this->getQrCodeString();
    }

}