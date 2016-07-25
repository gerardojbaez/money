# Money

Money is a small PHP library that helps you format numbers to currencies, including INR (Indian Rupee). It's a simple alternative to money_format().

Example:

```php
<?php

	$currency = new Gerardojbaez\Money\Currency('USD');
	$money = new Gerardojbaez\Money\Money(12.99, $currency)

	$money->format(); // RESULT: $12.99

	// You can also use the included helper:
	moneyFormat(12.99, 'USD'); // RESULT: $12.99
```