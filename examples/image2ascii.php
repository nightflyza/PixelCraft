<?php

require_once 'bootstrap.php';

//$pixelCraft = new PixelCraft();
$pixelCraft->loadImage('../assets/globe.jpg');

$pixelCraft->pixelate(3,true);
$pixelCraft->resize(32, 32);

$map = $pixelCraft->getColorMap(false);
$result = '';

foreach ($map as $x => $ys) {
    foreach ($ys as $y => $color) {
        $hex = $pixelCraft->rgbToHex($color);
        $result .= '<font style="font-weight: bold;" color="' . $hex . '">@</font>'.PHP_EOL;
    }
    $result .= '<br>';
}

print('<small>' . $result . '</small>');
