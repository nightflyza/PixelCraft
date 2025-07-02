<?php

require_once 'bootstrap.php';
$pixelCraft->createImage(100, 100);

$pixelCraft->addColor('red', 255, 0, 0);
$pixelCraft->addColor('darkred', 90, 0, 0);

for ($i = 60; $i > 50; $i--) {
    $pixelCraft->drawArcFilled(50, $i, 100, 50, 75, 360, 'darkred', IMG_ARC_PIE);
}

$pixelCraft->drawArcFilled(50, 50, 100, 50, 75, 360, 'red', IMG_ARC_PIE);

$pixelCraft->scale(4);
$pixelCraft->renderImage();
