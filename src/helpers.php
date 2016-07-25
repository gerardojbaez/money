<?php

if ( ! function_exists('moneyFormat'))
{
	public function moneyFormat($amount, $currency)
	{
		$money = Gerardojbaez\Money\Money($amount, $currency);

		return $money->format();
	}
}