<?php

require_once 'bootstrap.php';

$width = 800;
$height = 600;
$pixelCraft->createImage($width, $height);

$julia_constants = array(
    array(-0.7, 0.27015),
    array(0.285, 0),
    array(0.285, 0.01),
    array(0.45, 0.1428),
    array(-0.70176, -0.3842),
    array(-0.835, -0.2321),
    array(-0.8, 0.156),
    array(-0.7269, 0.1889),
    array(0.35, 0.35),
    array(0.4, 0.4)
);

$selected = $julia_constants[array_rand($julia_constants)];
$c_real = $selected[0];
$c_imag = $selected[1];

$max_iterations = 100;
$escape_radius = 2.0;

$pixelCraft->addColor('black', 0, 0, 0);
$pixelCraft->addColor('navy', 0, 0, 128);
$pixelCraft->addColor('blue', 0, 0, 255);
$pixelCraft->addColor('cyan', 0, 255, 255);
$pixelCraft->addColor('green', 0, 255, 0);
$pixelCraft->addColor('yellow', 255, 255, 0);
$pixelCraft->addColor('orange', 255, 165, 0);
$pixelCraft->addColor('red', 255, 0, 0);
$pixelCraft->addColor('purple', 128, 0, 128);

$center_x = -0.5;
$center_y = 0.0;
$zoom = 1.5;

$min_x = $center_x - 2.0 / $zoom;
$max_x = $center_x + 2.0 / $zoom;
$min_y = $center_y - 1.5 / $zoom;
$max_y = $center_y + 1.5 / $zoom;


for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $z_real = $min_x + ($x / $width) * ($max_x - $min_x);
        $z_imag = $min_y + ($y / $height) * ($max_y - $min_y);
        
        $iterations = 0;
        $escaped = false;
        
        while ($iterations < $max_iterations) {
            $z_real_squared = $z_real * $z_real;
            $z_imag_squared = $z_imag * $z_imag;
            
            if ($z_real_squared + $z_imag_squared > $escape_radius * $escape_radius) {
                $escaped = true;
                break;
            }
            
            $new_z_real = $z_real_squared - $z_imag_squared + $c_real;
            $new_z_imag = 2 * $z_real * $z_imag + $c_imag;
            
            $z_real = $new_z_real;
            $z_imag = $new_z_imag;
            
            $iterations++;
        }
        
        if (!$escaped) {
            $pixelCraft->drawPixel($x, $y, 'black');
        } else {
            $color_index = (int)($iterations / $max_iterations * 8);
            
            switch ($color_index) {
                case 0:
                    $pixelCraft->drawPixel($x, $y, 'navy');
                    break;
                case 1:
                    $pixelCraft->drawPixel($x, $y, 'blue');
                    break;
                case 2:
                    $pixelCraft->drawPixel($x, $y, 'cyan');
                    break;
                case 3:
                    $pixelCraft->drawPixel($x, $y, 'green');
                    break;
                case 4:
                    $pixelCraft->drawPixel($x, $y, 'yellow');
                    break;
                case 5:
                    $pixelCraft->drawPixel($x, $y, 'orange');
                    break;
                case 6:
                    $pixelCraft->drawPixel($x, $y, 'red');
                    break;
                default:
                    $pixelCraft->drawPixel($x, $y, 'purple');
                    break;
            }
        }
    }
}

$pixelCraft->renderImage('png');

