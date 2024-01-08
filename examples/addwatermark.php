<?php

require_once 'bootstrap.php';

//$pixelCraft = new PixelCraft();
$pixelCraft->loadImage('../assets/fox.jpg');

//loading watermark file
$pixelCraft->loadWatermark('../assets/horse.png');

$watermarkX=$pixelCraft->getImageWidth()-150;
$watermarkY=20;

$pixelCraft->drawWatermark(false,$watermarkX,$watermarkY);
$pixelCraft->drawString($watermarkX-40, 150, 'this is watermark', 'red',5);

//sample arrow
$pixelCraft->setLineWidth(5);
$pixelCraft->drawLine($watermarkX-30, 140, $watermarkX, $watermarkY+70, 'white');
$pixelCraft->drawLine($watermarkX, $watermarkY+70, $watermarkX-20, $watermarkY+75, 'white');
$pixelCraft->drawLine($watermarkX, $watermarkY+70, $watermarkX, $watermarkY+95, 'white');

//saving original image type
$originalFileType=$pixelCraft->getImageType();

$pixelCraft->renderImage($originalFileType);