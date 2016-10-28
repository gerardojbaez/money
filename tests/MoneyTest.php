<?php

use Gerardojbaez\Money\Money;
use PHPUnit\Framework\TestCase;
use Gerardojbaez\Money\Currency;

class MoneyTest extends TestCase
{
    /**
     * Amount can be formatted to currency
     *
     * @test
     * @return void
     */
    public function it_can_format_amount_to_currency()
    {
        $amountOne = new Money(1200.90, 'USD');

        $this->assertEquals((string)$amountOne, '$1,200.90');
        $this->assertEquals($amountOne->format(), '$1,200.90');

        $currency = new Currency('USD');
        $currency->setPrecision(3);
        $currency->setThousandSeparator('.');
        $currency->setDecimalSeparator(',');
        $currency->setSymbolPlacement('after');
        $amountTwo = new Money(1200.90, $currency);

        $this->assertEquals((string)$amountTwo, '1.200,900$');
        $this->assertEquals($amountTwo->format(), '1.200,900$');
    }

    /**
     * String can be parsed to numeric
     *
     * @test
     * @return void
     */
    public function it_can_parse_string()
    {
        $validCurrency = Money::parse('$1,200.90', 'USD');
        $emptyString = Money::parse('');
        $numericString = Money::parse('20');
        $decimalString = Money::parse('35.10');
        $numeric = Money::parse(10);

        $this->assertEquals($validCurrency->toDecimal(), 1200.9);
        $this->assertEquals($emptyString->toDecimal(), 0);
        $this->assertEquals($numericString->toDecimal(), 20);
        $this->assertEquals($decimalString->toDecimal(), 35.1);
        $this->assertEquals($numeric->toDecimal(), 10);
    }
}
