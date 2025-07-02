<?php

require_once 'bootstrap.php';

$width = 800;
$height = 600;
$iterations = 4;
$startX = 400;
$startY = 580;
$startAngle = 90;
$length = 80;
$angle = 25;

$treeRules = array(
    array('F' => 'FF+[+F-F-F]-[-F+F+F]'),
    array('F' => 'F[+F]F[-F]F'),
    array('F' => 'F[+F]F[-F][F]'),
    array('F' => 'FF-[-F+F+F]+[+F-F-F]'),
    array('F' => 'F[+FF][-FF]F[-F][+F]F'),
    array('F' => 'F[+F]F[-F]'),
    array('F' => 'F[+F][-F]F'),
    array('F' => 'FF+[+F-F-F]-[-F+F+F]'),
    array('F' => 'F[+F]F[-F]F[+F][-F]'),
    array('F' => 'F[+F]F[-F][F]')
);

$pixelCraft->createImage($width, $height);
$pixelCraft->fill('black');

function generateLSystem($axiom, $rules, $iterations) {
    $result = $axiom;
    
    for ($i = 0; $i < $iterations; $i++) {
        $newResult = '';
        for ($j = 0; $j < strlen($result); $j++) {
            $char = $result[$j];
            if (isset($rules[$char])) {
                $newResult .= $rules[$char];
            } else {
                $newResult .= $char;
            }
        }
        $result = $newResult;
    }
    
    return $result;
}

function drawTreeFractal($pixelCraft, $commands, $startX, $startY, $startAngle, $length, $angle) {
    $x = $startX;
    $y = $startY;
    $currentAngle = $startAngle;
    $stack = array();
    $currentLength = $length;
    
    for ($i = 0; $i < strlen($commands); $i++) {
        $command = $commands[$i];
        
        switch ($command) {
            case 'F':
            case 'G':
                $newX = $x + $currentLength * cos(deg2rad($currentAngle));
                $newY = $y - $currentLength * sin(deg2rad($currentAngle));
                
                $pixelCraft->drawLine($x, $y, $newX, $newY, 'white');
                $x = $newX;
                $y = $newY;
                break;
                
            case '+':
                $currentAngle += $angle;
                break;
                
            case '-':
                $currentAngle -= $angle;
                break;
                
            case '[':
                $stack[] = array($x, $y, $currentAngle, $currentLength);
                $currentLength *= 0.7;
                break;
                
            case ']':
                if (!empty($stack)) {
                    $state = array_pop($stack);
                    $x = $state[0];
                    $y = $state[1];
                    $currentAngle = $state[2];
                    $currentLength = $state[3];
                }
                break;
        }
    }
}

$selectedRule = $treeRules[array_rand($treeRules)];

$commands = generateLSystem('F', $selectedRule, $iterations);
drawTreeFractal($pixelCraft, $commands, $startX, $startY, $startAngle, $length, $angle);

$pixelCraft->renderImage('png');

