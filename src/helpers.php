<?php

if ( ! function_exists('moneyFormat'))
{
	function moneyFormat($amount, $currency)
	{
		$money = Gerardojbaez\Money\Money($amount, $currency);

		return $money->format();
	}
}