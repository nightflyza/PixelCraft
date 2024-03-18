<?php

require_once 'bootstrap.php';

$pixelCraft->loadImage('../assets/fox.jpg');
print('<img src="'.$pixelCraft->getImageBase('png',true).'"  />');