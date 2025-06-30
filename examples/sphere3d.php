<?php

require_once 'bootstrap.php';

$width = 800;
$height = 800;
$pixelCraft->createImage($width, $height);

$pixelCraft->fill('black');

$radius = 150;
$center_x = $width / 2;
$center_y = $height / 2;
$center_z = 0;

$light_x = 200;
$light_y = -200;
$light_z = 300;

$light_length = sqrt($light_x * $light_x + $light_y * $light_y + $light_z * $light_z);
$light_x /= $light_length;
$light_y /= $light_length;
$light_z /= $light_length;

for ($i = 0; $i < 256; $i++) {
    $pixelCraft->addColor('col_' . $i, $i, $i, $i);
}

for ($x = -$radius; $x <= $radius; $x++) {
    for ($y = -$radius; $y <= $radius; $y++) {
        $distance = sqrt($x * $x + $y * $y);
        
        if ($distance <= $radius) {
            $z = sqrt($radius * $radius - $distance * $distance);
            
            $normal_x = $x / $radius;
            $normal_y = $y / $radius;
            $normal_z = $z / $radius;
            
            $dot_product = $normal_x * $light_x + $normal_y * $light_y + $normal_z * $light_z;
            
            $dot_product = max(0, min(1, $dot_product));
            
            $ambient = 0.3;
            $lighting = $ambient + (1 - $ambient) * $dot_product;
            
            $grey_value = (int)($lighting * 255);
            $color = 'col_' . $grey_value;
            
            $screen_x = $center_x + $x;
            $screen_y = $center_y + $y;
            
            if ($screen_x >= 0 and $screen_x < $width and $screen_y >= 0 and $screen_y < $height) {
                $pixelCraft->drawPixel($screen_x, $screen_y, $color);
            }
        }
    }
}

$pixelCraft->renderImage('png');

