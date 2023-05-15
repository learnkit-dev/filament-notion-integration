# 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/learnkit-dev/filament-notion-integration.svg?style=flat-square)](https://packagist.org/packages/learnkit-dev/filament-notion-integration)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/learnkit-dev/filament-notion-integration/run-tests?label=tests)](https://github.com/learnkit-dev/filament-notion-integration/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/learnkit-dev/filament-notion-integration/Check%20&%20fix%20styling?label=code%20style)](https://github.com/learnkit-dev/filament-notion-integration/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/learnkit-dev/filament-notion-integration.svg?style=flat-square)](https://packagist.org/packages/learnkit-dev/filament-notion-integration)



This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require learnkit-dev/filament-notion-integration
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="filament-notion-integration-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-notion-integration-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-notion-integration-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$filament-notion-integration = new LearnKit\FilamentNotion();
echo $filament-notion-integration->echoPhrase('Hello, LearnKit!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Sebastiaan Kloos](https://github.com/learnkit-dev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
