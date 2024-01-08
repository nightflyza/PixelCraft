<?php

if (file_exists('vendor/autoload.php')) {
  require_once 'vendor/autoload.php';
} else {
  require_once '../vendor/autoload.php';
}


$pixelCraft = new PixelCraft();

if (file_exists('assets/OpenSans-Regular.ttf')) {
 $pixelCraft->setFont('assets/OpenSans-Regular.ttf');
} else {
 $pixelCraft->setFont('../assets/OpenSans-Regular.ttf');
}

