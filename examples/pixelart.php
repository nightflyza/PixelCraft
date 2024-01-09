<?php

require_once 'bootstrap.php';

//$pixelCraft = new PixelCraft();


$pixelMap = '
1111111111111111111111111
1000000000000000000000001
1000000000001000000000001
1000000000011100000000001
1001000000011100000001001
1001100000011100000011001
1001110000011100000111001
1001111000011100001111001
1001101100011100011011001
1001101100011100011011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001111100010100011111001
1001111000110110001111001
1001101101100011011011001
1001100111110111110011001
1001100011011101100011001
1001100011001001100011001
1001111111111111111111001
1001111111111111111111001
1000000011001001100000001
1000000001101011000000001
1000000000111110000000001
1000000000001000000000001
1000000000000000000000001
1111111111111111111111111
';

$pixelCraft->createImage(25,31);
$pixelCraft->addColor('foreground', 227, 209, 54);
$pixelCraft->addColor('background', 73, 140, 204);

$pixelMap=trim($pixelMap);
$pixelMap=explode(PHP_EOL,$pixelMap);
foreach ($pixelMap as $y=>$xAxis) {
    $xAxis=str_split($xAxis);
    foreach ($xAxis as $x=>$pixel) {
        if ($pixel) {
            $pixelCraft->drawPixel($x,$y,'foreground');
        } else {
            $pixelCraft->drawPixel($x,$y,'background');
        }
    }
}

$pixelCraft->scale(16);


$pixelCraft->renderImage();
