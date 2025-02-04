<?php

require_once 'bootstrap.php';


$pixelCraft->loadImage('../assets/fox.jpg');
$pixelCraft->rotate(90);

$originalFileType = $pixelCraft->getImageType();

$pixelCraft->renderImage($originalFileType);