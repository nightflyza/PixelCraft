<?php

require_once 'bootstrap.php';

$width = 400;
$height = 400;
$pixelCraft->createImage($width, $height);

function generatePermutation($seed = null) {
    if ($seed !== null) {
        srand($seed);
    }
    
    $permutation = array();
    for ($i = 0; $i < 256; $i++) {
        $permutation[$i] = $i;
    }
    
    for ($i = 255; $i > 0; $i--) {
        $j = rand(0, $i);
        $temp = $permutation[$i];
        $permutation[$i] = $permutation[$j];
        $permutation[$j] = $temp;
    }
    
    for ($i = 0; $i < 256; $i++) {
        $permutation[256 + $i] = $permutation[$i];
    }
    
    return $permutation;
}

function fade($t) {
    return $t * $t * $t * ($t * ($t * 6 - 15) + 10);
}

function lerp($t, $a, $b) {
    return $a + $t * ($b - $a);
}

function grad2D($hash, $x, $y) {
    $hash = $hash & 15;
    $u = $hash < 8 ? $x : $y;
    $v = $hash < 4 ? $y : ($hash == 12 || $hash == 14 ? $x : 0);
    return (($hash & 1) == 0 ? $u : -$u) + (($hash & 2) == 0 ? $v : -$v);
}

function perlinNoise2D($x, $y, $permutation) {
    $X = (int)floor($x) & 255;
    $Y = (int)floor($y) & 255;
    $x -= floor($x);
    $y -= floor($y);
    $u = fade($x);
    $v = fade($y);
    
    $A = $permutation[$X] + $Y;
    $AA = $permutation[$A];
    $AB = $permutation[$A + 1];
    $B = $permutation[$X + 1] + $Y;
    $BA = $permutation[$B];
    $BB = $permutation[$B + 1];
    
    return lerp($v, lerp($u, grad2D($AA, $x, $y), grad2D($BA, $x - 1, $y)),
                lerp($u, grad2D($AB, $x, $y - 1), grad2D($BB, $x - 1, $y - 1)));
}

$permutation = generatePermutation();

for ($i = 0; $i < 256; $i++) {
    $pixelCraft->addColor('gray_' . $i, $i, $i, $i);
}

$scale = 0.02;

for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $noiseValue = perlinNoise2D($x * $scale, $y * $scale, $permutation);
        $normalizedValue = ($noiseValue + 1) / 2;
        $grayIndex = (int)($normalizedValue * 255);
        $pixelCraft->drawPixel($x, $y, 'gray_' . $grayIndex);
    }
}

$pixelCraft->renderImage('png');
