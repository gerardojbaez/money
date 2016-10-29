<?php

namespace Gerardojbaez\Money;

class Money
{
    /**
     * Amount to format
     *
     * @var float|int
     */
    protected $amount;

    /**
     * Currency instance
     *
     * @var \Gerardojbaez\Money\Currency
     */
    protected $currency;

    /**
     * Create new Money Instance
     *
     * @param float|int
     * @param mixed $currency
     * @return void
     */
    public function __construct($amount, $currency = 'USD')
    {
        $this->amount = (float)$amount;

        if (is_string($currency)) {
            $this->currency = (is_string($currency) ? new Currency($currency) : $currency);
        } elseif ($currency instanceof Currency) {
            $this->currency = $currency;
        }
    }

    /**
     * Print formated amount.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->format();
    }

    /**
     * Format amount to currency equivalent string.
     * @param integer $precision
     * @return string
     */
    public function format()
    {
        $format = $this->amount();

        if ($this->currency->getSymbol() === null) {
            $format .= ' '.$this->currency->getCode();
        } elseif ($this->currency->getSymbolPlacement() == 'before') {
            $format = $this->currency->getSymbol().$format;
        } else {
            $format .= $this->currency->getSymbol();
        }

        return $format;
    }

    /**
     * Get amount formatted to currency.
     *
     * @return mixed
     */
    public function amount()
    {
        // Indian Rupee use special format
        if ($this->currency->getCode() == 'INR') {
            $decimals = null;
            $amount = $this->amount;

            // Extract decimals from amount
            if (($pos = strpos($amount, ".")) !== false) {
                $decimals = substr(round(substr($amount, $pos), 2), 1);
                $amount = substr($amount, 0, $pos);
            }

            // Extract last 3 from amount
            $result = substr($amount, -3);
            $amount = substr($amount, 0, -3);

            // Apply digits 2 by 2
            while (strlen($amount) > 0) {
                $result = substr($amount, -2).",".$result;
                $amount = substr($amount, 0, -2);
            }

            return $result.$decimals;
        }

        // Return western format
        return number_format(
            $this->amount,
            $this->currency->getPrecision(),
            $this->currency->getDecimalSeparator(),
            $this->currency->getThousandSeparator()
        );
    }

    /**
     * Get amount formatted decimal.
     *
     * @return string decimal
     */
    public function toDecimal()
    {
        return (string)$this->amount;
    }

    /**
     * parses locale formatted money string
     * to object of class Money
     *
     * @param  string          $str      Locale Formatted Money String
     * @param  Currency|string $currency default 'USD'
     * @return Money           $money    Decimal String
     */
    public static function parse($str, $currency = 'USD')
    {
        // get currency object
        $currency = (is_string($currency) ? new Currency($currency) : $currency);

        // remove HTML encoded characters: http://stackoverflow.com/a/657670
        // special characters that arrive like &0234;
        $str = preg_replace("/&#?[a-z0-9]{2,8};/i", '', $str);

        // remove all leading non numbers
        $str = preg_replace('/^[^0-9]*/', '', $str);

        // remove all thousands separators
        if (strlen($currency->getThousandSeparator())) {
            $str = str_replace($currency->getThousandSeparator(), '', $str);
        }

        if (strlen($currency->getDecimalSeparator())) {
        // make decimal separator regex safe
            $char = preg_quote($currency->getDecimalSeparator());
            // remove all other characters
            $str = preg_replace('/[^'.$char.'\d]/', "", $str);
            // convert all decimal seperators to PHP/bcmath safe decimal '.'
            $str = preg_replace('/'.$char.'/', ".", $str);
        } else {
            // for currencies that do not have decimal points
            // remove all other characters
            $str = preg_replace('/[^\d]/', "", $str);
        }

        return new Money($str, $currency);
    }
}
