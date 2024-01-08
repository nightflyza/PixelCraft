<?php

require_once 'bootstrap.php';

//$pixelCraft = new PixelCraft();
$pixelCraft->loadImage('../assets/fox.jpg');

$pixelCraft->crop(256, 256);
$pixelCraft->resize(128, 128);

//saving original image type
$originalFileType=$pixelCraft->getImageType();

$pixelCraft->renderImage($originalFileType);