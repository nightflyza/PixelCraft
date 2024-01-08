<?php

require_once 'bootstrap.php';

//$pixelCraft = new PixelCraft();

$pixelCraft->createImage(640, 480);
$pixelCraft->fill('yellow');

$pixelCraft->addColor('sky', 34, 61, 216);
$pixelCraft->drawRectangle(0, 0, 640, 240, 'sky');

$pixelCraft->setFontSize(48);
$pixelCraft->drawText(80, 200, 'Glory to Ukraine', 'white');
$pixelCraft->drawText(30, 400, 'Glory to the heroes', 'black');

$pixelCraft->renderImage();
