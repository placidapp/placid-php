# Placid for PHP
[![Latest Version](https://img.shields.io/github/release/placidapp/placid-php.svg?style=flat-square)](https://github.com/placidapp/placid-php/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/placidapp/placid-php.svg?style=flat-square)](https://packagist.org/packages/placidapp/placid-php)

This packages enables you to simply create Placid Images from Templates via using the REST Api or to easily create valid placid.app embed links!

## Create an Placid.app Image URL:
```php
use Placid\Template;

$templateId = "qsraj";
$apiKey = "your-placid-api-key";

$template = new Template($templateId, $apiKey)
$template
    ->elementText($title)
    ->text("I am a dynamic Image!");

$imageURL = $template->toPlacidUrl(); // - https://placid.app/u/qsraj?title=I%20am%20a%20dynamic%20Image%21

```
[![Placid Image](https://placid.app/u/qsraj?title=I%20am%20a%20dynamic%20Image%21)](https://placid.app/u/qsraj?title=I%20am%20a%20dynamic%20Image%21)


## Generate an Image:

Using the `image()` function on the  Template Object will result in returning a [GeneratedImage Object](https://github.com/placidapp/placid-php/blob/master/src/GeneratedImage.php)
When the image has been created, the (in your config) supplied webhook will be called!

```php
 $image = $template->image();
```

`image(true)` will wait for the image to being finished: 
```php
 $image = $template->image(true); // - https://placid.app/u/qsraj?title=I%20am%20a%20dynamic%20Image%21
```


## Installation

You can install this package via composer using this command:

```bash
composer require "placidapp/placid-php:^1.0.0"
```


The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
