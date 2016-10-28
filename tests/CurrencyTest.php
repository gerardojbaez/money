<?php

use PHPUnit\Framework\TestCase;
use Gerardojbaez\Money\Currency;

class CurrencyTest extends TestCase
{
    protected $currency;

    public function setUp()
    {
        $this->currency = new Currency('USD');
    }

    /**
     * Test getters
     *
     * @test
     * @return void
     */
    public function it_can_get_currency_data()
    {
        $this->assertEquals($this->currency->getCode(), 'USD');
        $this->assertEquals($this->currency->getSymbol(), '$');
        $this->assertEquals($this->currency->getPrecision(), 2);
        $this->assertEquals($this->currency->getTitle(), 'US Dollar');
        $this->assertEquals($this->currency->getThousandSeparator(), ',');
        $this->assertEquals($this->currency->getDecimalSeparator(), '.');
        $this->assertEquals($this->currency->getSymbolPlacement(), 'before');
    }

    /**
     * String can be parsed to numeric
     *
     * @test
     * @return void
     */
    public function it_can_get_all_currencies()
    {
        $this->assertTrue(is_array(Currency::getAllCurrencies()));
    }

    /**
     * Currency format can be modified.
     *
     * @test
     * @return void
     */
    public function it_can_set_currency_format()
    {
        $this->currency->setPrecision(3);
        $this->currency->setThousandSeparator('.');
        $this->currency->setDecimalSeparator(',');
        $this->currency->setSymbolPlacement('after');

        $this->assertEquals($this->currency->getPrecision(), 3);
        $this->assertEquals($this->currency->getThousandSeparator(), '.');
        $this->assertEquals($this->currency->getDecimalSeparator(), ',');
        $this->assertEquals($this->currency->getSymbolPlacement(), 'after');
    }
}
