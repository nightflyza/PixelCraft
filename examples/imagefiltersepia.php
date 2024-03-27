<?php

require_once 'bootstrap.php';

$pixelCraft->loadImage('../assets/fox.jpg');

$filtersSet = array();
$filtersSet[] = array(IMG_FILTER_GRAYSCALE => '');
$filtersSet[] = array(IMG_FILTER_BRIGHTNESS => -10);
$filtersSet[] = array(IMG_FILTER_CONTRAST => -20);
$filtersSet[] = array(IMG_FILTER_COLORIZE => array(60, 30, -15));

$pixelCraft->imageFilters($filtersSet);

$pixelCraft->renderImage('jpeg');
