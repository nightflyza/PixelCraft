<?php

require_once 'bootstrap.php';

//$pixelCraft = new PixelCraft();
$pixelCraft->loadImage('../assets/fox.jpg');

$pixelCraft->cropRegion(80, 20, 220, 220);
$pixelCraft->drawString(180,20,$pixelCraft->getImageWidth().'x'.$pixelCraft->getImageHeight(),'black');

//saving original image type
$originalFileType=$pixelCraft->getImageType();

$pixelCraft->renderImage($originalFileType);