<?php

require_once 'bootstrap.php';
$pixelCraft->createImage(200, 200);

$pixelCraft->drawArc(100, 100, 200, 200, 0, 360, 'white');
$pixelCraft->drawArc(100, 100, 150, 150, 25, 155, 'red');
$pixelCraft->drawArc(60, 75, 50, 50, 0, 360, 'green');
$pixelCraft->drawArc(140, 75, 50, 50, 0, 360, 'blue');

$pixelCraft->renderImage();
