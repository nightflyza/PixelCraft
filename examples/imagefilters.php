<?php

require_once 'bootstrap.php';

$pixelCraft->loadImage('../assets/fox.jpg');

$filtersSet = array();
$filtersSet[] = array(IMG_FILTER_BRIGHTNESS => -15);
$filtersSet[] = array(IMG_FILTER_GRAYSCALE => -5);
$filtersSet[] = array(IMG_FILTER_COLORIZE => array(80, 0, 60));
$filtersSet[] = array(IMG_FILTER_GAUSSIAN_BLUR => '');

$pixelCraft->imageFilters($filtersSet);

$pixelCraft->renderImage('jpeg');
