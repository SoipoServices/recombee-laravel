# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/soiposervices/recombee-laravel.svg?style=flat-square)](https://packagist.org/packages/soiposervices/recombee-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/soiposervices/recombee-laravel.svg?style=flat-square)](https://packagist.org/packages/soiposervices/recombee-laravel)
![GitHub Actions](https://github.com/soiposervices/recombee-laravel/actions/workflows/main.yml/badge.svg)

If you are looking for a convenient way to integrate Recombee's recommendation engine into your Laravel application, you might want to check out my package. It is a wrapper around Recombee PHP SDK, allowing you to configure user and item properties, as well as send and retrieve recommendations using Laravel's fluent syntax. 

## Installation

You can install the package via composer:

```bash
composer require soiposervices/recombee-laravel
```

## Usage

To reset the database, we have an handy command (use with caution), we do not accept any responsibility. : 

```php artisan recombee:reset```

To sync the user and item properties, you will have to publish our configuration and edit the properties array. After that you can run.

```php artisan recombee:sync```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email info@soiposervices.com instead of using the issue tracker.

## Credits

-   [Luigi Laezza](https://github.com/soiposervices)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
