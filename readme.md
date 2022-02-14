# Composer Autoloader

This composer command allows to generate simple autoloader file based on a classmap file.

**NOTE:** The command can be executed in projects without `composer.json` file too.

## Installation

1. Add the command as a global composer plugin:

```shell
$ composer global require piotrpress/composer-autoloader
```

2. Allow plugin execution:

```shell
$ composer config -g allow-plugins.piotrpress/composer-autoloader true
```

## Usage

1. Execute the command in your project's directory:

```shell
$ composer autoload [-e|--exclude [REGEX]]
```

**NOTE:** The option `exclude` is regex that matches file paths to be excluded from the classmap.

2. After the command execution, you can simply include autoload file to your project as usual:

```php
require __DIR__ . '/vendor/autoload.php';
```

## Example

```shell
$ composer autoload -e"#/vendor/composer/(.*)#"
```

## License

[MIT](license.txt)