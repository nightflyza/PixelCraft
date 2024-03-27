<?php

require_once 'bootstrap.php';

$charMap = '@#W$9876543210?!abc;:+=-,._       ';
$len = strlen($charMap);

$result = '';
$pixelCraft->loadImage('../assets/horse.png');
//$pixelCraft->loadImage('../assets/fox.jpg');

$filterSet = array();
$filterSet []= array(IMG_FILTER_NEGATE =>'');
$pixelCraft->imageFilters($filterSet);
$pixelCraft->pixelate(3, true);
$pixelCraft->resize(64, 64);


$colorMap = $pixelCraft->getColorMap(false);

foreach ($colorMap as $x => $ys) {
    foreach ($ys as $y => $color) {
        $brightness = $pixelCraft->rgbToBrightness($color);
        $charIndex = floor(($brightness - 0) * $len / 255);
        $result .= $charMap[$charIndex].' ';
    }
    $result .= PHP_EOL;
}

print($result);
