# Composer Autoloader

This library is a composer autoloader replacement based on a classmap file.

## Usage

1. Include required dependency `piotrpress/composer-autoloader` in your project's `composer.json` file.
2. Add the function `PiotrPress\\Composer\\Autoloader::dump`  to script section in your project's `composer.json` file. It'll be triggered after install/update composer command execution.

```json
{
  "require": {
    "piotrpress/composer-autoloader": "*"
  },
  "scripts": {
    "post-install-cmd": [
      "PiotrPress\\Composer\\Autoloader::dump"
    ],
    "post-update-cmd": [
      "PiotrPress\\Composer\\Autoloader::dump"
    ]
  }
}
```

3. After `composer install`/`composer update` command execution, you can simply include autoload file to your project as usual.

```php
require __DIR__ . '/vendor/autoload.php';
```

## License

[GPL3.0](license.txt)