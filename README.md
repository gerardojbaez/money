# Money

Money is a small PHP library that helps you format numbers to currencies, including INR (Indian Rupee). It's a simple alternative to money_format().

Example:

```php
<?php

$money = new Gerardojbaez\Money\Money(12.99, 'USD')
$money->format(); // RESULT: $12.99

// You can also use the included helper:
moneyFormat(12.99, 'USD'); // RESULT: $12.99
```

## Content
- [Installation](#installation)
- [Basic Usage](#basic-usage)
	- [Currencies Supported](#currencies-supported)
	- [Formatting Using Helper Function](#formatting-using-helper-function)
	- [Formatting Using Class](#formatting-using-class)
    - [Customizing Currency Format](#customizing-currency-format)
	- [Parse String](#parse-string)
	- [Get Currency Information](#get-currency-information)
	- [Get All Supported Currencies](#get-all-supported-currencies)
- [License](#license)

## Installation

Pull this package through Composer (file `composer.json`)

```js
{
    "require": {
        "gerardojbaez/money": "0.*"
    }
}
```

Then run

	composer update

```php
<?php

require 'vendor/autoload.php';

use Gerardojbaez\Money\Money;

$money = new Money(100);
$money->format();
```

## Basic Usage
### Currencies Supported

ARS, AMD, AWG, AUD, BSD, BHD, BDT, BZD, BMD, BOB, BAM, BWP, BRL, BND, CAD, KYD, CLP, CNY, COP, CRC, HRK, CUC, CUP, CYP, CZK, DKK, DOP, XCD, EGP, SVC, EUR, GHC, GIP, GTQ, HNL, HKD, HUF, ISK, INR, IDR, IRR, JMD, JPY, JOD, KES, KWD, LVL, LBP, LTL, MKD, MYR, MTL, MUR, MXN, MZM, NPR, ANG, ILS, TRY, NZD, NOK, PKR, PEN, UYU, PHP, PLN, GBP, OMR, RON, ROL, RUB, SAR, SGD, SKK, SIT, ZAR, KRW, SZL, SEK, CHF, TZS, THB, TOP, AED, UAH, USD, VUV, VEF, VEB, VND, ZWD.

### Formatting Using Helper Function

```php
<?php

// USD
echo moneyFormat(100); // RESULT: $100.00
echo moneyFormat(10000); // RESULT: $10,000.00

// INR
echo moneyFormat(100, 'INR'); // RESULT: र100
echo moneyFormat(1000000, 'INR'); // RESULT: र10,00,000
```

### Formatting Using Class

```php
<?php

$money = new Gerardojbaez\Money\Money(1000000, 'INR');

echo $money->format(); // RESULT: र10,00,000
echo $money; // The same as using $money->format()

echo $money->amount(); // RESULT: 10,00,000
```

### Customizing Currency Format

To use a custom format, create an instance of the `Currency` class with the desired currency and use the setters (se the example below) to apply the desired format. Use this instance with the `Money` class (or the helper) to finally format the number.

For example:

```php
$currency = new Gerardojbaez\Money\Currency('USD');
$currency->setPrecision(3);
$currency->setThousandSeparator('.');
$currency->setDecimalSeparator(',');
$currency->setSymbolPlacement('after');

$money = new Gerardojbaez\Money\Money(1200.9, $currency);
echo $money; // RESULT: 1.200,900$ (example)

// OR
echo moneyFormat(1200.9, $currency);
```

### Parse String

```php
<?php

echo Money::parse('$1,200.90', 'USD')->toDecimal(); // RESULT: 1200.9
```

### Get Currency Information

```php

$currency = new Gerardojbaez\Money\Currency('USD');
echo $currency->getTitle(); // US Dollar
echo $currency->getCode(); // USD
echo $currency->getSymbol(); // $
echo $currency->getSymbolPlacement(); // after (before|after amount)
echo $currency->getPrecision(); // 2 (number of decimals)
echo $currency->getThousandSeparator(); // ,
echo $currency->getDecimalSeparator(); // .
```

### Get All Supported Currencies

```php

$currencies = Gerardojbaez\Money\Currency::getAllCurrencies();

// Result Example:
[
	'ARS' => [
		'code' => 'ARS'
		'title' => 'Argentine Peso'
		'symbol' => null
		'precision' => 2
		'thousandSeparator' => ','
		'decimalSeparator' => '.'
		'symbolPlacement' => 'before'
	]

	'AMD' => [
		'code' => 'AMD'
		'title' => 'Armenian Dram'
		'symbol' => null
		'precision' => 2
		'thousandSeparator' => '.'
		'decimalSeparator' => ','
		'symbolPlacement' => 'before'
	]

	...
```

## License

This package is free software distributed under the terms of the MIT license.
