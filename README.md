# PixelCraft

PixelCraft is a lightweight PHP library designed for easy image processing using the GD lib. 
With PixelCraft, you can perform basic image operations such as resizing, cropping, drawing of watermarks, and format conversion.
The library is characterized by its user-friendly interface and minimal code footprint, 
allowing for quick and efficient image processing in PHP projects.

## Requirements

- PHP >=5.3 (PHP 7.4, 8.2 also compatible)
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

### Image downscale and convert

```php
$pc=new PixelCraft();

$pc->loadImage('someimage.png');
$pc->scale(0.5);

$pc->saveImage('resizedimage.jpg','jpeg');
```

[Full PixelCraft class description](https://ubilling.net.ua/api_doc/classes/PixelCraft.xhtml)


## Installation with [composer](https://getcomposer.org)

The recommended method of installing this library is via [Composer](https://packagist.org/packages/chartmancer/pixelcraft)

### Terminal

```bash
composer require pixelcraft/pixelcraft
```


## License

MIT
