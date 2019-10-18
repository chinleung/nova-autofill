# Nova Autofill
Auto prefill values for Laravel Nova fields based on the parent model.

## Installation

You can install the package via composer:

```
composer require chinleung/nova-autofill
```

## Usage

If your model has a relationship, it can autofill some values when adding via a relationship in Laravel Nova. For instance, an order that belongs to a user, you can autofill the user's address when adding a new order via the user resource.

``` php
public function fields(Request $request)
{
    return [
        Text::make('Shipping Address Line 1')
            ->autofill(),
    ];
}
```

If no attribute is passed in the method, it will use the field's attribute name to fetch from the parent resource. However, you can specify the attribute to fill from:

``` php
public function fields(Request $request)
{
    return [
        Text::make('Shipping Address Line 1')
            ->autofill('address_line_1'),
    ];
}
```

### Security

If you discover any security related issues, please email hello@chinleung.com instead of using the issue tracker.

## Credits

- [Chin Leung](https://github.com/chinleung)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
