# EmarrefTwigDoctrineLoaderBundle

Load twig templates from a doctrine repository.

## Installation

Add EmarrefTwigDoctrineLoaderBundle to your composer.json:

```json
{
    "require": {
        "emarref/twig-doctrine-loader-bundle": "dev-master"
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

## Configuration

The default configuration is below. You can modify these settings in your own project's config.yml. The repository must
implement the Emarref\Bundle\TwigDoctrineLoaderBundle\Entity\TemplateRepositoryInterface interface, and your template
must implement the Emarref\Bundle\TwigDoctrineLoaderBundle\Entity\TemplateInterface interface.

```yaml
emarref_twig_doctrine_loader:
    repository: "EmarrefTwigDoctrineLoaderBundle:Template"
```
