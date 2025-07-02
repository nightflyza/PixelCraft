<?php

require_once 'bootstrap.php';

$dotSpacing = 6;
$maxDotSize = 8;

$pixelCraft->loadImage('../assets/fox.jpg');

$originalWidth = $pixelCraft->getImageWidth();
$originalHeight = $pixelCraft->getImageHeight();

$colorMap = $pixelCraft->getColorMap(false);

$halftoneWidth = $originalWidth;
$halftoneHeight = $originalHeight;
$pixelCraft->createImage($halftoneWidth, $halftoneHeight);

$pixelCraft->fill('white');

for ($x = 0; $x < $originalWidth; $x += $dotSpacing) {
    for ($y = 0; $y < $originalHeight; $y += $dotSpacing) {
        $rgb = $colorMap[$y][$x];
        $brightness = $pixelCraft->rgbToBrightness($rgb);
        
        $dotSize = $maxDotSize * (1 - ($brightness / 255));
        
        if ($dotSize > 0.3) {
            $pixelCraft->drawArcFilled(
                $x, $y, 
                $dotSize * 2, $dotSize * 2, 
                0, 360, 
                'black', 
                IMG_ARC_PIE
            );
        }
    }
}

$pixelCraft->renderImage('png');
