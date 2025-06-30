<?php

require_once 'bootstrap.php';

$width = 800;
$height = 800;
$pixelCraft->createImage($width, $height);

$pixelCraft->fill('black');

$cube_vertices = array(
    array(-1, -1, -1),
    array(1, -1, -1),
    array(1, 1, -1),
    array(-1, 1, -1),
    array(-1, -1, 1),
    array(1, -1, 1),
    array(1, 1, 1),
    array(-1, 1, 1)
);

$cube_edges = array(
    array(0, 1), array(1, 2), array(2, 3), array(3, 0),
    array(4, 5), array(5, 6), array(6, 7), array(7, 4),
    array(0, 4), array(1, 5), array(2, 6), array(3, 7)
);

$angle_x = 0.5;
$angle_y = 0.3;
$angle_z = 0.2;

function rotate_x($x, $y, $z, $angle) {
    $cos_a = cos($angle);
    $sin_a = sin($angle);
    return array(
        'x' => $x,
        'y' => $y * $cos_a - $z * $sin_a,
        'z' => $y * $sin_a + $z * $cos_a
    );
}

function rotate_y($x, $y, $z, $angle) {
    $cos_a = cos($angle);
    $sin_a = sin($angle);
    return array(
        'x' => $x * $cos_a + $z * $sin_a,
        'y' => $y,
        'z' => -$x * $sin_a + $z * $cos_a
    );
}

function rotate_z($x, $y, $z, $angle) {
    $cos_a = cos($angle);
    $sin_a = sin($angle);
    return array(
        'x' => $x * $cos_a - $y * $sin_a,
        'y' => $x * $sin_a + $y * $cos_a,
        'z' => $z
    );
}

$rotated_vertices = array();
foreach ($cube_vertices as $vertex) {
    $x = $vertex[0];
    $y = $vertex[1];
    $z = $vertex[2];
    
    $rotated = rotate_x($x, $y, $z, $angle_x);
    $rotated = rotate_y($rotated['x'], $rotated['y'], $rotated['z'], $angle_y);
    $rotated = rotate_z($rotated['x'], $rotated['y'], $rotated['z'], $angle_z);
    
    $rotated_vertices[] = $rotated;
}

$distance = 4;
$center_x = $width / 2;
$center_y = $height / 2;
$scale = 150;

$projected_vertices = array();
foreach ($rotated_vertices as $vertex) {
    $factor = $distance / ($distance + $vertex['z']);
    $x = $vertex['x'] * $factor * $scale + $center_x;
    $y = $vertex['y'] * $factor * $scale + $center_y;
    
    $projected_vertices[] = array($x, $y);
}

$pixelCraft->setLineWidth(2);
foreach ($cube_edges as $edge) {
    $v1 = $projected_vertices[$edge[0]];
    $v2 = $projected_vertices[$edge[1]];
    
    $pixelCraft->drawLine($v1[0], $v1[1], $v2[0], $v2[1], 'white');
}

$pixelCraft->renderImage('png');

