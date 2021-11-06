# Value Objects

This package provides abstracts classes and interface to create Value Objects based on the four scalar type supported by
PHP.

* [Installation](#installation)
* [What is a Value Object](#what-is-a-value-object)
* [Using this package](#using-this-package)
* [Contribution](#contribution)

## Installation

```
composer require frankvanhest/value-objects
```

## What is a Value Object

A Value Object is a wrapper for primitive types such as a string. It usually has specific domain knowledge, and it will
make sure that the value is asserted accordingly to that domain knowledge. The characteristics of a Value Object are:

- it is immutable
- it wraps primitive data
- it represents domain specific knowledge
- it is equals to another instance when the value is the same, but the instance itself is not

Whenever an instance of a Value Object is passed around your application, you can be sure that the value inside is what
you expect it to be. For example, if you have a Value Object Email, you can be sure that the value is a correctly
formatted string according to what an e-mail address should be.

## Using this package

This package only provided the means to create your own Value Objects. For instance, you want to create a Value Object
for Money. You can use the interface [`FloatValueObject`](src/Interfaces/FloatValueObject.php) and implement according
to your own need. To simplify things, you can also use the abstract
class  [`FloatValueObject`](src/Abstracts/FloatValueObject.php). See the following example.

```php
use FrankVanHest\ValueObjects\Abstracts\FloatValueObject;

final class Money extends FloatValueObject
{
    protected function assert(float $value): void
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Only a value greater than zero is allowed');
        }
    }
}
```

As you can see, you only have to implement the assertion for your Value Object according to your domain knowledge. In
this case the only constraint is that the value should be greater than zero.

We got convenient methods like `fromFloat`, `toFloat` and `equals` available.

What if I want to be able to initialize `Money` from a string. Just implement the
interface [`StringValueObject`](src/Interfaces/StringValueObject.php) and we get:

```php
use FrankVanHest\ValueObjects\Abstracts\FloatValueObject;
use FrankVanHest\ValueObjects\Interfaces\StringValueObject;

final class Money extends FloatValueObject implements StringValueObject
{
    protected function assert(float $value): void
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Only a value greater than zero is allowed');
        }
    }
    
    public function toString(): string
    {
        return (string)$this->toFloat();
    }
    
    public static function fromString(string $value): static
    {
        if (!is_numeric($value)) {
            throw new \InvalidArgumentException('Only numeric values are allowed');
        }
        
        return new static((float)$value);
    }
}
```

As stated before when it comes to comparing two instances of Value Objects it only compares the value itself, not if the
Value Objects are the same instance. To clarify this, look at the following examples based the `Money` class.

```php
$moneyA = Money::fromFloat(10.25);
$moneyB = Money::fromFloat(10.25);
$moneyC = Money::fromFloat(1.50);

$moneyA->equals($moneyA); // Returns true
$moneyA->equals($moneyB); // Returns true
$moneyA->equals($moneyC); // Returns false
$moneyA->equals(null); // Returns false
```

## Predefined common Value Objects

There are some Value Objects which will be used in different projects. To make it easier not having to write the same
thing over and over again I'm providing several common Value Objects packages. For now the following are already
available:

- [E-mail](https://github.com/frankvanhest/value-objects-email)

## Contribution

Feel free to submit an issue of pull request. When it comes to a pull request I'm curious of how it improves this
packages of which problem it may solve.

There are some requirements:

- Use PSR-12 for code styling
- Write a test for every meaningful change

## License

See [LICENCE](LICENSE)
