<?php

require_once 'bootstrap.php';

$width=500;
$height=500;
$maxIterations = 100;
$minX = -2.0;
$maxX = 1.0;
$minY = -1.5;
$maxY = 1.5;

$pixelCraft->createImage($width,$height);

for ($y = 0; $y < $height; $y++) {
    for ($x = 0; $x < $width; $x++) {
        $cx = $minX + ($x / $width) * ($maxX - $minX);
        $cy = $minY + ($y / $height) * ($maxY - $minY);

        $zx = 0.0;
        $zy = 0.0;
        $iteration = 0;

        while ($zx * $zx + $zy * $zy < 4 and $iteration < $maxIterations) {
            $temp = $zx * $zx - $zy * $zy + $cx;
            $zy = 2 * $zx * $zy + $cy;
            $zx = $temp;
            $iteration++;
        }


        $colorIntensity = (int)(255 * $iteration / $maxIterations);
        $colorName = 'C_' . $colorIntensity . '0' . (255 - $colorIntensity);
        $pixelCraft->addColor($colorName, $colorIntensity, 0, 255 - $colorIntensity);
        $pixelCraft->drawPixel($x, $y, $colorName);
    }
}


$pixelCraft->renderImage();