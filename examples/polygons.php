<?php

require_once 'bootstrap.php';

$pixelCraft->createImage(400, 400);

$pointsPolygon = array(
    0,   0,
    100, 200,
    300, 200
);

$pixelCraft->drawPolygon($pointsPolygon, 'red');

$pointsPolygonFilled = array(
    100, 100,
    200, 200,
    300, 100
);

$pixelCraft->drawPolygonFilled($pointsPolygonFilled, 'blue');

$pixelCraft->renderImage();