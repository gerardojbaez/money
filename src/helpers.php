<?php

if ( ! function_exists('moneyFormat'))
{
	function moneyFormat($amount, $currency)
	{
		$money = new Gerardojbaez\Money\Money($amount, $currency);

		return $money->format();
	}
}