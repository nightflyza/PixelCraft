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

### Minimal example

```php

$pc=new PixelCraft();

$pc->createImage(640, 480);
$pc->fill('yellow');

$pc->addColor('sky', 34, 61, 216);
$pc->drawRectangle(0, 0, 640, 240, 'sky');

$pc->renderImage('png');
```

### Image downscale and convertation from PNG to JPEG

```php
$pc=new PixelCraft();

$pc->loadImage('someimage.png');
$pc->scale(0.5);

$pc->saveImage('resizedimage.jpg','jpeg');
```

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

### Adding text to image

```php
$pixelCraft = new PixelCraft();

$pixelCraft->loadImage('yourimage.jpg');

$labelPosition = ($pixelCraft->getImageHeight()) - 10;
$pixelCraft->drawTextAutoSize($labelPosition, 10, 'Text at image bootom', 'white', 'black');

$pixelCraft->renderImage('jpeg');
```

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

[Full PixelCraft class documentation](https://ubilling.net.ua/api_doc/classes/PixelCraft.xhtml)


## Installation with [composer](https://getcomposer.org)

The recommended method of installing this library is via [Composer](https://packagist.org/packages/pixelcraft/pixelcraft)

### Terminal

```bash
composer require pixelcraft/pixelcraft
```


## License

MIT
