<?php

require_once 'bootstrap.php';

$pixelCraft->loadImage('../assets/fox.jpg');
$pixelCraft->loadWatermark('../assets/tlen.png');
$pixelCraft->drawWatermark(true);

$filtersSet = array();
$filtersSet[] = array(IMG_FILTER_BRIGHTNESS => -10);
$filtersSet[] = array(IMG_FILTER_CONTRAST => -30);
$filtersSet[] = array(IMG_FILTER_GRAYSCALE => '');


$pixelCraft->imageFilters($filtersSet);

$labelPosition = ($pixelCraft->getImageHeight()) - 10;
$pixelCraft->drawTextAutoSize($labelPosition, 10, 'Sad and depressive', 'white', 'black');

$pixelCraft->renderImage('jpeg');
