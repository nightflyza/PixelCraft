<?php

require_once 'bootstrap.php';

//$pixelCraft = new PixelCraft();
$pixelCraft->loadImage('../assets/fox.jpg');

$pixelCraft->scale(0.5);

//saving original image type
$originalFileType = $pixelCraft->getImageType();

$pixelCraft->renderImage($originalFileType);
