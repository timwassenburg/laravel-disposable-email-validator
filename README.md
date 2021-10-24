# Laravel Disposable Email Validator
This package adds validation to check if a given email address is a disposable email adress. 

## Installation
Run composer require to install the package.
```bash
composer require timwassenburg/disposable-email-validator
```

## Usage
If you are working with a Form Request you can add the disposable-email rule to input value you want to check. 
Keep in mind that the ```disposable-email``` rule doesn't check if the email is valid so it is recommended
to use it in combination with the ```email``` validation rule.

```php
public function rules()
{
    return [
        'email' => 'required|email|disposable-email'
    ];
}
```

When validating the request inside your controller you can use the following:

```php
public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|disposable-email'
    ]);
    
    // your code
}
```

## Translations
First publish the translations with the following command.
```bash
php artisan vendor:publish --provider="TimWassenburg\DisposableEmailValidator\DisposableEmailServiceProvider" --tag="translations"
```
You can now find the language files in ```/resources/lang/vendor/disposable-email```, here you can add new languages or
update existing translations.

## Adding more disposable email domains
To add more domains you need to publish the config. The config file contains all domains the validator is checking, 
you can extend the list by adding more domains when needed.
```bash
php artisan vendor:publish --provider="TimWassenburg\DisposableEmailValidator\DisposableEmailServiceProvider" --tag="config"
```

## Caching
The list of disposable emails is loaded from a config file. For a production environment it is recommended to cache the
config for optimal performance. You can use the default Laravel config caching for this.

```bash
php artisan config:cache
```

## Contributing
If you want to contribute to this package feel tree to open a ticket or a pull request. 

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
