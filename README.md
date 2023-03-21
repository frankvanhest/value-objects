# Value Objects

This package provides abstracts classes and interface to create Value Objects based on the four scalar type supported by
PHP.

* [Installation](#installation)
* [What is a Value Object](#what-is-a-value-object)
* [Using this package](#using-this-package)
* [Contribution](#contribution)
* [License](#license)

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
- it has a name which give it a meaningful purpose
- it is equals to another instance when the value is the same, but the instance itself is not

Whenever an instance of a Value Object is passed around your application, you can be sure that the value inside is what
you expect it to be. For example, if you have a Value Object Email, you can be sure that the value is a correctly
formatted string according to what an e-mail address should be.

## Using this package

This package only provided the means to create your own Value Objects. The four main primitives types string, integer,
float and boolean are included. Each one has its own interface, abstract and factory (except for boolean) available.
With each factory you can add a corresponding value modifier.
For instance, you want to create a Value Object
for Money. You can use the interface [`FloatValueObject`](src/Interfaces/FloatValueObject.php) and implement according
to your own need. To simplify things, you can also use the abstract
class  [`FloatValueObject`](src/Abstracts/FloatValueObject.php). See the following example.

```php
use FrankVanHest\ValueObjects\Abstracts\FloatValueObject;

final readonly class Money extends FloatValueObject
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

final readonly class Money extends FloatValueObject implements StringValueObject
{
    protected function assert(float $value): void
    {
        if ($value < 0) {
            throw new \InvalidArgumentException('Only a value greater than zero is allowed');
        }
    }
    
    public function toString(): string
    {
        return sprintf('The value of Money is %f', $this->toFloat());
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

If you want to modify the value before the value object is created you can provide a value modified when using the
factory to create the Money object.

```php
use FrankVanHest\ValueObjects\Interfaces\FloatValueModifier;

final readonly class DivideBy implements FloatValueModifier
{
    public function __construct(private float $divideBy)
    {    
    }
    
    public function modify(float $value): float
    {
        return $value / $this->divideBy;
    }
}
```
```php
use FrankVanHest\ValueObjects\Factories\FloatValueObjectFactory;

$money = FloatValueObjectFactory::create(Money::class, 100.50, new DivideBy(10));
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

## Contribution

Feel free to submit an issue of pull request. When it comes to a pull request I'm curious of how it improves this
packages of which problem it may solve.

There are some requirements:

- Use PSR-12 for code styling
- Write a test for every meaningful change

## License

See [LICENCE](LICENSE.md)
