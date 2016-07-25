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
	 * @param string Currency (Defaulted to USD)
	 * @return void
	 */
	function __construct($amount, $currency = 'USD')
	{
		$this->amount = (float)$amount;
		$this->currency = (is_string($currency) ? new Currency($currency) : $currency);
	}

	/**
	 * Format amount to currency equivalent string.
	 *
	 * @return string
	 */
	public function format()
	{
		$format = $this->amount();

		if($this->currency->getSymbol() === null)
			$format .= ' '.$this->currency->getCode();
		elseif ($this->currency->getSymbolPlacement() == 'before')
			$format = $this->currency->getSymbol().$format;
		else
			$format .= $this->currency->getSymbol();

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
		if ($this->currency->getCode() == 'INR')
		{
			$decimals = null;
			$amount = $this->amount;

			// Extract decimals from amount
			if (($pos = strpos($amount, ".")) !== false)
			{
			    $decimals = substr(round(substr($amount, $pos), 2), 1);
			    $amount = substr($amount,0,$pos);
			}

			// Extract last 3 from amount
			$result = substr($amount,-3);
			$amount = substr($amount,0, -3);

			// Apply digits 2 by 2
			while(strlen($amount) > 0)
			{
			    $result = substr($amount,-2).",".$result;
			    $amount = substr($amount,0,-2);
			}

			return $result.$decimals;
		}

		// Return western format
		return number_format(
			$this->amount,
			$this->currency->getPrecision(),
			$this->currency->getThousandSeparator(),
			$this->currency->getDecimalSeparator()
		);
	}
}