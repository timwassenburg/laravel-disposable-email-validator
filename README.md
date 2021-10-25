# Laravel Disposable Email Validator
Prevent users from registrering with a disposable email addresses with this validation rule. 

## Installation
Run composer require to install the package.
```bash
composer require timwassenburg/laravel-disposable-email-validator
```

## Usage
Add the disposable-email rule to input you want to check. 
Keep in mind that the ```disposable-email``` rule doesn't check if the email is valid so it is recommended
to use it in combination with the ```email``` validation rule.

```php
'email' => 'required|email|disposable-email'
```

## Translations
Publish the translations with the following command.
```bash
php artisan vendor:publish --provider="TimWassenburg\DisposableEmailValidator\DisposableEmailServiceProvider" --tag="translations"
```
You can now add or update translations in the ```resources/lang/vendor/disposable-email``` folder.

## Adding more disposable email domains
The config contains all domains the validator is checking, 
you can publish the config and extend the list by adding more domains.
```bash
php artisan vendor:publish --provider="TimWassenburg\DisposableEmailValidator\DisposableEmailServiceProvider" --tag="config"
```

## Caching
Although this might be obvious, just a small reminder. The list of disposable emails is loaded from a config file. For a production environment it is recommended to cache the
config for optimal performance. You can use the default Laravel config caching for this.

```bash
php artisan config:cache
```

## Contributing
If you want to contribute to this package feel tree to open a ticket or a pull request. 

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
