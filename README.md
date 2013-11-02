# EmarrefTwigDoctrineLoaderBundle

Load twig templates from a doctrine connection.

## Installation

Add EmarrefTwigDoctrineLoaderBundle to your composer.json:

```json
{
    "require": {
        "emarref/twig-doctrine-loader-bundle": "*"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/emarref/EmarrefTwigDoctrineLoaderBundle"
        }
    ]
}
```

Tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update emarref/twig-doctrine-loader-bundle
```

Enable the bundle in the kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Emarref\Bundle\TwigDoctrineLoaderBundle\EmarrefTwigDoctrineLoaderBundle(),
    );
}
```

## Todo

- Configurable entity table
