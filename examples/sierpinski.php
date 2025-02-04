<?php

require_once 'bootstrap.php';

$widht = 700;
$height = 200;

$pixelCraft->createImage($widht, $height);
$points = array(
    array('x' => 00, 'y' => 10),
    array('x' => 0, 'y' => 190),
    array('x' => 800, 'y' => 190)
);

$x = $widht;
$y = $height;
for ($i = 0; $i < 100000; $i++) {
    $pixelCraft->drawPixel(round($x), round($y), 'red');
    $a = rand(0, 2);
    $x = ($x + $points[$a]['x']) / 2;
    $y = ($y + $points[$a]['y']) / 2;
}


$pixelCraft->renderImage();
