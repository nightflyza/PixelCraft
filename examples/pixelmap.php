<?php

require_once 'bootstrap.php';

//$pixelCraft=new PixelCraft();

$pixelCraft->loadImage('../assets/bw_smile.png');

$pixelMap='';
$colorMap=$pixelCraft->getColorMap(false);

foreach ($colorMap as $y=>$xs) {
    foreach ($xs as $color) {
        $dot = ($color['r'] AND $color['g'] AND $color['b']) ? 1 : 0;
        $pixelMap.=$dot;
    }
    $pixelMap.=PHP_EOL;
}

print($pixelMap);