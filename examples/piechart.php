<?php

require_once 'bootstrap.php';

$centerX = 400;
$centerY = 350;
$radius = 250;
$gapAngle = 3;
$totalAngle = 360 - (5 * $gapAngle);
$currentAngle = 0;
$legendX = 50;
$legendY = 650;
$legendSpacing = 30;


$data = array(
    '2019' => 42,
    '2020' => 12,
    '2021' => 17,
    '2022' => 50,
    '2023' => 55,
);

foreach ($data as $year => $value) {
    $md5 = md5($year);
    $r = hexdec(substr($md5, 0, 2));
    $g = hexdec(substr($md5, 2, 2));
    $b = hexdec(substr($md5, 4, 2));
    
    $colorName = 'color' . $year;
    $darkColorName = 'darkcolor' . $year;
    
    $pixelCraft->addColor($colorName, $r, $g, $b);
    $pixelCraft->addColor($darkColorName, $r * 0.4, $g * 0.4, $b * 0.4);
}

$total = 0;
foreach ($data as $value) {
    $total += $value;
}

$pixelCraft->createImage(800, 800);
$pixelCraft->fill('white');

$pixelCraft->setFontSize(24);
$pixelCraft->drawText(300, 50, '3D pie chart', 'black');

foreach ($data as $year => $value) {
    $percentage = ($value / $total) * 100;
    $angle = ($percentage / 100) * $totalAngle;
    $endAngle = $currentAngle + $angle;
    
    $colorName = 'color' . $year;
    $darkColorName = 'darkcolor' . $year;
    
    $segmentCenterAngle = $currentAngle + ($angle / 2);
    $offsetX = cos(deg2rad($segmentCenterAngle)) * 8;
    $offsetY = sin(deg2rad($segmentCenterAngle)) * 8;
    
    for ($i = 15; $i > 0; $i--) {
        $pixelCraft->drawArc($centerX + $offsetX, $centerY + $offsetY + $i, $radius * 2, $radius * 2, $currentAngle, $endAngle, $darkColorName, IMG_ARC_PIE);
    }
    
    $pixelCraft->drawArc($centerX + $offsetX, $centerY + $offsetY, $radius * 2, $radius * 2, $currentAngle, $endAngle, $colorName, IMG_ARC_PIE);
    
    $currentAngle = $endAngle + $gapAngle;
}

$pixelCraft->setFontSize(16);

$index = 0;
foreach ($data as $year => $value) {
    if ($index <= 5) {
    
    $y = $legendY + ($index * $legendSpacing);
    
    $colorName = 'color' . $year;
    $pixelCraft->drawRectangle($legendX, $y - 10, $legendX + 20, $y + 10, $colorName);
    
    $legendText = $year . ': ' . $value . ' (' . round(($value / $total) * 100, 1) . '%)';
    $pixelCraft->drawText($legendX + 30, $y + 5, $legendText, 'black');
    
    $index++;
    }
}

$pixelCraft->renderImage();