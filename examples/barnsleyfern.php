<?php

require_once 'bootstrap.php';

$width = 800;
$height = 800;
$pixelCraft->createImage($width, $height);

$pixelCraft->fill('black');

$transformations = array(
    array('probability' => 0.01, 'a' => 0.0, 'b' => 0.0, 'c' => 0.0, 'd' => 0.16, 'e' => 0.0, 'f' => 0.0),
    array('probability' => 0.85, 'a' => 0.85, 'b' => 0.04, 'c' => -0.04, 'd' => 0.85, 'e' => 0.0, 'f' => 1.6),
    array('probability' => 0.07, 'a' => 0.2, 'b' => -0.26, 'c' => 0.23, 'd' => 0.22, 'e' => 0.0, 'f' => 1.6),
    array('probability' => 0.07, 'a' => -0.15, 'b' => 0.28, 'c' => 0.26, 'd' => 0.24, 'e' => 0.0, 'f' => 0.44)
);

$pixelCraft->addColor('fern_green', 34, 139, 34);
$pixelCraft->addColor('dark_green', 0, 100, 0);
$pixelCraft->addColor('light_green', 144, 238, 144);
$pixelCraft->addColor('forest_green', 34, 139, 34);

$x = 0.0;
$y = 0.0;
$iterations = 50000;

$scale = 60;
$offset_x = $width / 2;
$offset_y = 50;

for ($i = 0; $i < $iterations; $i++) {
    $rand = mt_rand() / mt_getrandmax();
    $cumulative_prob = 0;
    $selected_transform = null;
    
    foreach ($transformations as $transform) {
        $cumulative_prob += $transform['probability'];
        if ($rand <= $cumulative_prob) {
            $selected_transform = $transform;
            break;
        }
    }
    
    $new_x = $selected_transform['a'] * $x + $selected_transform['b'] * $y + $selected_transform['e'];
    $new_y = $selected_transform['c'] * $x + $selected_transform['d'] * $y + $selected_transform['f'];
    
    $x = $new_x;
    $y = $new_y;
    
    $pixel_x = (int)($x * $scale + $offset_x);
    $pixel_y = (int)($height - ($y * $scale + $offset_y));
    
    if ($pixel_x >= 0 && $pixel_x < $width && $pixel_y >= 0 && $pixel_y < $height) {
        if ($y < 0.5) {
            $pixelCraft->drawPixel($pixel_x, $pixel_y, 'light_green');
        } elseif ($y < 1.0) {
            $pixelCraft->drawPixel($pixel_x, $pixel_y, 'fern_green');
        } elseif ($y < 1.5) {
            $pixelCraft->drawPixel($pixel_x, $pixel_y, 'forest_green');
        } else {
            $pixelCraft->drawPixel($pixel_x, $pixel_y, 'dark_green');
        }
    }
}

$pixelCraft->renderImage('png');

