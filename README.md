![pcraftlogo](https://github.com/nightflyza/PixelCraft/assets/1496954/42c91406-dfc4-47dc-8eea-db3106edb009)

# PixelCraft

PixelCraft is a lightweight PHP library designed for easy image processing using the GD lib. 
With PixelCraft, you can perform basic image operations such as resizing, cropping, drawing of watermarks, and format conversion.
The library is characterized by its user-friendly interface and minimal code footprint, 
allowing for quick and efficient image processing in PHP projects.

## Requirements

- PHP >=5.3 (PHP 7.4, 8.2, 8.3 also compatible)
- GD Library
- Mbstring extension

## Few usage examples

### Minimal example / drawing from scratch

```php

$pc=new PixelCraft();

$pc->createImage(640, 480);
$pc->fill('yellow');

$pc->addColor('sky', 34, 61, 216);
$pc->drawRectangle(0, 0, 640, 240, 'sky');

$pc->renderImage('png');
```

![drawfromscratch](https://github.com/user-attachments/assets/56974d6a-8107-4982-8a45-736f59aac92a)



### Image downscale and convertation from PNG to JPEG

```php
$pc=new PixelCraft();

$pc->loadImage('someimage.png');
$pc->scale(0.5);

$pc->saveImage('resizedimage.jpg','jpeg');
```

![downscale](https://github.com/user-attachments/assets/dd06f439-a795-43ce-8e1e-544e7533f980)


### Adding watermarks to images

```php
$pixelCraft = new PixelCraft();

$pixelCraft->loadImage('yourimage.jpg');
$pixelCraft->loadWatermark('watermark.png');

$watermarkX=$pixelCraft->getImageWidth()-150;
$watermarkY=20;

$pixelCraft->drawWatermark(false,$watermarkX,$watermarkY);

$originalFileType=$pixelCraft->getImageType();
$pixelCraft->renderImage($originalFileType);
```

![watermark](https://github.com/user-attachments/assets/7c66903a-1554-46f3-ac40-2cb908c28284)

### Instagram-like filters

```php
$pixelCraft = new PixelCraft();

$pixelCraft->loadImage('yourimage.jpg');

$filtersSet = array();
$filtersSet[] = array(IMG_FILTER_BRIGHTNESS => -15);
$filtersSet[] = array(IMG_FILTER_GRAYSCALE => -5);
$filtersSet[] = array(IMG_FILTER_COLORIZE => array(80, 0, 60));
$filtersSet[] = array(IMG_FILTER_GAUSSIAN_BLUR => '');

$pixelCraft->imageFilters($filtersSet);

$pixelCraft->renderImage('jpeg');

```

![instafilters](https://github.com/user-attachments/assets/6b4c4a21-c2f8-4b2a-ad61-9d164c96bdb9)


### Adding text to image

```php
$pixelCraft = new PixelCraft();

$pixelCraft->loadImage('yourimage.jpg');

$labelPosition = ($pixelCraft->getImageHeight()) - 10;
$pixelCraft->drawTextAutoSize($labelPosition, 10, 'Text at image bottom', 'white', 'black');

$pixelCraft->renderImage('jpeg');
```

![textatbottom](https://github.com/user-attachments/assets/2116e0c1-6972-4959-9ae1-7224e9f04b00)

### Drawing pixel-art

```php
$pixelCraft = new PixelCraft();

$pixelMap = '
1111111111111111111111111
1000000000000000000000001
1000000000001000000000001
1000000000011100000000001
1001000000011100000001001
1001100000011100000011001
1001110000011100000111001
1001111000011100001111001
1001101100011100011011001
1001101100011100011011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001100110011100110011001
1001111100010100011111001
1001111000110110001111001
1001101101100011011011001
1001100111110111110011001
1001100011011101100011001
1001100011001001100011001
1001111111111111111111001
1001111111111111111111001
1000000011001001100000001
1000000001101011000000001
1000000000111110000000001
1000000000001000000000001
1000000000000000000000001
1111111111111111111111111
';

$pixelCraft->createImage(25,31);
$pixelCraft->addColor('foreground', 227, 209, 54);
$pixelCraft->addColor('background', 73, 140, 204);

$pixelMap=trim($pixelMap);
$pixelMap=explode(PHP_EOL,$pixelMap);
foreach ($pixelMap as $y=>$xAxis) {
    $xAxis=str_split($xAxis);
    foreach ($xAxis as $x=>$pixel) {
        if ($pixel) {
            $pixelCraft->drawPixel($x,$y,'foreground');
        } else {
            $pixelCraft->drawPixel($x,$y,'background');
        }
    }
}

$pixelCraft->scale(16);


$pixelCraft->renderImage();

```

![pixelart](https://github.com/user-attachments/assets/df72f378-4eef-4c28-bb81-5c3fcbc53cb9)


### Random values visualization

```php
$pixelCraft = new PixelCraft();

$width=100;
$height=100;
$pixelCraft->createImage($width,$height);

for ($x=0;$x<$width;$x++) {
    for ($y=0;$y<$height;$y++) {
        $randomR=rand(0,255);
        $randomG=rand(0,255);
        $randomB=rand(0,255);
        $colorName='C_'.$randomR.$randomG.$randomB;
        $pixelCraft->addColor($colorName,$randomR,$randomG,$randomB);
        $pixelCraft->drawPixel($x,$y,$colorName);
    }
}

$pixelCraft->scale(8);
$pixelCraft->renderImage();
```

![drawrandom](https://github.com/user-attachments/assets/3d970496-f286-4c10-be1c-961aeb85d9f5)

### Image region crop

```php
$pixelCraft = new PixelCraft();

$pixelCraft->loadImage('../assets/fox.jpg');

$pixelCraft->cropRegion(80, 20, 220, 220);
$pixelCraft->drawString(180,20,$pixelCraft->getImageWidth().'x'.$pixelCraft->getImageHeight(),'black');

//saving original image type
$originalFileType=$pixelCraft->getImageType();

$pixelCraft->renderImage($originalFileType);

```

![regioncrop](https://github.com/user-attachments/assets/7b30f3c5-8c56-497d-8611-72d7505ccc67)

### Image resize and region crop
```php
$pixelCraft = new PixelCraft();

$pixelCraft->loadImage('../assets/fox.jpg');

$pixelCraft->crop(256, 256);
$pixelCraft->resize(128, 128);

//saving original image type
$originalFileType=$pixelCraft->getImageType();

$pixelCraft->renderImage($originalFileType);
```

![resizeandcrop](https://github.com/user-attachments/assets/4b525b75-63e6-4b2e-83dc-6845926f8ff4)

### Converting an image to ASCII-art based on pixel brightness

```php
$pixelCraft = new PixelCraft();

$charMap = '@#W$9876543210?!abc;:+=-,._       ';
$len = strlen($charMap);

$result = '';
$pixelCraft->loadImage('../assets/horse.png');

$filterSet = array();
$filterSet []= array(IMG_FILTER_NEGATE =>'');
$pixelCraft->imageFilters($filterSet);
$pixelCraft->pixelate(3, true);
$pixelCraft->resize(64, 64);


$colorMap = $pixelCraft->getColorMap(false);

foreach ($colorMap as $x => $ys) {
    foreach ($ys as $y => $color) {
        $brightness = $pixelCraft->rgbToBrightness($color);
        $charIndex = floor(($brightness * $len) / 255);
        $result .= $charMap[$charIndex].' ';
    }
    $result .= PHP_EOL;
}

print($result);

```

![pcimg2ascii](https://github.com/user-attachments/assets/a1a1ef1e-4550-4b72-a7b5-94c38d5d229b)

[Full PixelCraft class documentation](https://ubilling.net.ua/api_doc/classes/PixelCraft.xhtml)


## Installation with [composer](https://getcomposer.org)

The recommended method of installing this library is via [Composer](https://packagist.org/packages/pixelcraft/pixelcraft)

### Terminal

```bash
composer require pixelcraft/pixelcraft
```


## License

MIT
