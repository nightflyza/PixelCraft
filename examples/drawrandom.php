<?php

require_once 'bootstrap.php';

//$pixelCraft = new PixelCraft();

$width=100;
$height=100;
$pixelCraft->createImage($width,$height);

for ($x=0;$x<$width;$x++) {
    for ($y=0;$y<$height;$y++) {
        $randomR=rand(0,255);
        $randomG=rand(0,255);
        $randomB=rand(0,255);
        $colorName='C_'.$randomR.$randomG.$randomB;
        $pixelCraft->addColor($colorName,$randomR,$randomG,$randomB);
        $pixelCraft->drawPixel($x,$y,$colorName);
    }
}

$pixelCraft->scale(8);
$pixelCraft->renderImage();
print_r($pixelCraft);
