# Value Object - E-mail

This package provides a Value Object for an e-mail address. For the background behind this package,
see [`frankvanhest/value-objects`](#https://github.com/frankvanhest/value-objects).

* [Installation](#installation)
* [Using this package](#using-this-package)
* [Contribution](#contribution)
* [License](#license)

## Installation

```
composer require frankvanhest/value-objects-email
```

## Using this package

The class [Email](Email.php) provides the means to create your domain specific value objects which require a valid
e-mail address. For example, you need a Value Object for an invoice e-mail address, you can just extend the class Email.

```php
use FrankVanHest\ValueObjects\Email;
 
final class InvoiceEmail extends Email
{
}
```

You can override the methods `assert` and `modifyValue` if they don't meet your requirements. The assertion for a valid
e-mail address is based on PHP `filter_var` flag `FILTER_VALIDATE_EMAIL` which only
supports [RFC822](#http://www.faqs.org/rfcs/rfc822.html).

## Contribution

Feel free to submit an issue of pull request. When it comes to a pull request I'm curious of how it improves this
packages of which problem it may solve.

There are some requirements:

- Use PSR-12 for code styling
- Write a test for every meaningful change

## License

See [LICENCE](LICENSE)
