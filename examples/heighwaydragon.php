<?php

require_once 'bootstrap.php';

$width = 800;
$height = 800;
$pixelCraft->createImage($width, $height);

$pixelCraft->fill('black');

$pixelCraft->addColor('dragon_red', 255, 50, 50);

$iterations = 12;
$segment_length = 8;
$center_x = $width / 2;
$center_y = $height / 2;

function generateDragonCurve($iterations) {
    $points = array();
    $directions = array();
    
    $directions[] = 1;
    
    for ($i = 1; $i <= $iterations; $i++) {
        $new_directions = array();
        foreach ($directions as $dir) {
            $new_directions[] = $dir;
        }
        $new_directions[] = 1;
        for ($j = count($directions) - 1; $j >= 0; $j--) {
            $new_directions[] = -$directions[$j];
        }
        $directions = $new_directions;
    }
    
    $x = 0;
    $y = 0;
    $points[] = array($x, $y);
    
    $dx = 1;
    $dy = 0;
    
    foreach ($directions as $dir) {
        $new_dx = -$dy * $dir;
        $new_dy = $dx * $dir;
        $dx = $new_dx;
        $dy = $new_dy;
        
        $x += $dx;
        $y += $dy;
        $points[] = array($x, $y);
    }
    
    return $points;
}

$dragon_points = generateDragonCurve($iterations);

$min_x = $max_x = $dragon_points[0][0];
$min_y = $max_y = $dragon_points[0][1];

foreach ($dragon_points as $point) {
    $min_x = min($min_x, $point[0]);
    $max_x = max($max_x, $point[0]);
    $min_y = min($min_y, $point[1]);
    $max_y = max($max_y, $point[1]);
}

$dragon_width = $max_x - $min_x;
$dragon_height = $max_y - $min_y;
$scale = min(($width - 100) / $dragon_width, ($height - 100) / $dragon_height);

for ($i = 0; $i < count($dragon_points) - 1; $i++) {
    $x1 = ($dragon_points[$i][0] - $min_x) * $scale + $center_x - ($dragon_width * $scale) / 2;
    $y1 = ($dragon_points[$i][1] - $min_y) * $scale + $center_y - ($dragon_height * $scale) / 2;
    $x2 = ($dragon_points[$i + 1][0] - $min_x) * $scale + $center_x - ($dragon_width * $scale) / 2;
    $y2 = ($dragon_points[$i + 1][1] - $min_y) * $scale + $center_y - ($dragon_height * $scale) / 2;
    
    $pixelCraft->setLineWidth(2);
    $pixelCraft->drawLine($x1, $y1, $x2, $y2, 'dragon_red');
}

$pixelCraft->renderImage('png');

