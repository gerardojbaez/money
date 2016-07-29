<?php

namespace Gerardojbaez\Money;

use Gerardojbaez\Money\Exceptions\CurrencyException;

class Currency
{
	/**
	 * ISO-4217 Currency Code.
	 *
	 * @var string
	 */
	protected $code;

	/**
	 * Currency symbol.
	 *
	 * @var string
	 */
	protected $symbol;

	/**
	 * Currency precision (number of decimals).
	 *
	 * @var int
	 */
	protected $precision;

	/**
	 * Currency title.
	 *
	 * @var string
	 */
	protected $title;

	/**
	 * Currency thousand separator.
	 *
	 * @var string
	 */
	protected $thousandSeparator;

	/**
	 * Currency decimal separator.
	 *
	 * @var string
	 */
	protected $decimalSeparator;

	/**
	 * Currency symbol placement.
	 *
	 * @var string (front|after) currency
	 */
	protected $symbolPlacement;

	/**
	 * Currency Formats.
	 *
	 * Formats from
	 * http://www.joelpeterson.com/blog/2011/03/formatting-over-100-currencies-in-php/
	 *
	 * @var array
	 */
	private static $currencies = [
		'ARS' => ['code' => 'ARS', 'title' => 'Argentine Peso', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'AMD' => ['code' => 'AMD', 'title' => 'Armenian Dram', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'AWG' => ['code' => 'AWG', 'title' => 'Aruban Guilder', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'AUD' => ['code' => 'AUD', 'title' => 'Australian Dollar', 'symbol' => 'AU$', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ' ', 'symbolPlacement' => 'before'],
		'BSD' => ['code' => 'BSD', 'title' => 'Bahamian Dollar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'BHD' => ['code' => 'BHD', 'title' => 'Bahraini Dinar', 'symbol' => null, 'precision' => 3, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'BDT' => ['code' => 'BDT', 'title' => 'Bangladesh, Taka', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'BZD' => ['code' => 'BZD', 'title' => 'Belize Dollar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'BMD' => ['code' => 'BMD', 'title' => 'Bermudian Dollar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'BOB' => ['code' => 'BOB', 'title' => 'Bolivia, Boliviano', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'BAM' => ['code' => 'BAM', 'title' => 'Bosnia and Herzegovina, Convertible Marks', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'BWP' => ['code' => 'BWP', 'title' => 'Botswana, Pula', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'BRL' => ['code' => 'BRL', 'title' => 'Brazilian Real', 'symbol' => 'R$', 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'BND' => ['code' => 'BND', 'title' => 'Brunei Dollar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'CAD' => ['code' => 'CAD', 'title' => 'Canadian Dollar', 'symbol' => 'CA$', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'KYD' => ['code' => 'KYD', 'title' => 'Cayman Islands Dollar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'CLP' => ['code' => 'CLP', 'title' => 'Chilean Peso', 'symbol' => null, 'precision' => 0, 'thousandSeparator' => '', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'CNY' => ['code' => 'CNY', 'title' => 'China Yuan Renminbi', 'symbol' => 'CN&yen;', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'COP' => ['code' => 'COP', 'title' => 'Colombian Peso', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'CRC' => ['code' => 'CRC', 'title' => 'Costa Rican Colon', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'HRK' => ['code' => 'HRK', 'title' => 'Croatian Kuna', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'CUC' => ['code' => 'CUC', 'title' => 'Cuban Convertible Peso', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'CUP' => ['code' => 'CUP', 'title' => 'Cuban Peso', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'CYP' => ['code' => 'CYP', 'title' => 'Cyprus Pound', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'CZK' => ['code' => 'CZK', 'title' => 'Czech Koruna', 'symbol' => 'Kc', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'after'],
		'DKK' => ['code' => 'DKK', 'title' => 'Danish Krone', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'DOP' => ['code' => 'DOP', 'title' => 'Dominican Peso', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'XCD' => ['code' => 'XCD', 'title' => 'East Caribbean Dollar', 'symbol' => 'EC$', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'EGP' => ['code' => 'EGP', 'title' => 'Egyptian Pound', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'SVC' => ['code' => 'SVC', 'title' => 'El Salvador Colon', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'EUR' => ['code' => 'EUR', 'title' => 'Euro', 'symbol' => '&euro;', 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'GHC' => ['code' => 'GHC', 'title' => 'Ghana, Cedi', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'GIP' => ['code' => 'GIP', 'title' => 'Gibraltar Pound', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'GTQ' => ['code' => 'GTQ', 'title' => 'Guatemala, Quetzal', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'HNL' => ['code' => 'HNL', 'title' => 'Honduras, Lempira', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'HKD' => ['code' => 'HKD', 'title' => 'Hong Kong Dollar', 'symbol' => 'HK$', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'HUF' => ['code' => 'HUF', 'title' => 'Hungary, Forint', 'symbol' => 'HK$', 'precision' => 0, 'thousandSeparator' => '', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'ISK' => ['code' => 'ISK', 'title' => 'Iceland Krona', 'symbol' => 'kr', 'precision' => 0, 'thousandSeparator' => '', 'decimalSeparator' => '.', 'symbolPlacement' => 'after'],
		'INR' => ['code' => 'INR', 'title' => 'Indian Rupee ₹', 'symbol' => '&#2352;', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'IDR' => ['code' => 'IDR', 'title' => 'Indonesia, Rupiah', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'IRR' => ['code' => 'IRR', 'title' => 'Iranian Rial', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'JMD' => ['code' => 'JMD', 'title' => 'Jamaican Dollar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'JPY' => ['code' => 'JPY', 'title' => 'Japan, Yen', 'symbol' => '&yen;', 'precision' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'JOD' => ['code' => 'JOD', 'title' => 'Jordanian Dinar', 'symbol' => null, 'precision' => 3, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'KES' => ['code' => 'KES', 'title' => 'Kenyan Shilling', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'KWD' => ['code' => 'KWD', 'title' => 'Kuwaiti Dinar', 'symbol' => null, 'precision' => 3, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'LVL' => ['code' => 'LVL', 'title' => 'Latvian Lats', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'LBP' => ['code' => 'LBP', 'title' => 'Lebanese Pound', 'symbol' => null, 'precision' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ' ', 'symbolPlacement' => 'before'],
		'LTL' => ['code' => 'LTL', 'title' => 'Lithuanian Litas', 'symbol' => 'Lt', 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => ' ', 'symbolPlacement' => 'after'],
		'MKD' => ['code' => 'MKD', 'title' => 'Macedonia, Denar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'MYR' => ['code' => 'MYR', 'title' => 'Malaysian Ringgit', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'MTL' => ['code' => 'MTL', 'title' => 'Maltese Lira', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'MUR' => ['code' => 'MUR', 'title' => 'Mauritius Rupee', 'symbol' => null, 'precision' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'MXN' => ['code' => 'MXN', 'title' => 'Mexican Peso', 'symbol' => 'MX$', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'MZM' => ['code' => 'MZM', 'title' => 'Mozambique Metical', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'NPR' => ['code' => 'NPR', 'title' => 'Nepalese Rupee', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'ANG' => ['code' => 'ANG', 'title' => 'Netherlands Antillian Guilder', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'ILS' => ['code' => 'ILS', 'title' => 'New Israeli Shekel ₪', 'symbol' => '&#8362;', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'TRY' => ['code' => 'TRY', 'title' => 'New Turkish Lira', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'NZD' => ['code' => 'NZD', 'title' => 'New Zealand Dollar', 'symbol' => 'NZ$', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'NOK' => ['code' => 'NOK', 'title' => 'Norwegian Krone', 'symbol' => 'kr', 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'after'],
		'PKR' => ['code' => 'PKR', 'title' => 'Pakistan Rupee', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'PEN' => ['code' => 'PEN', 'title' => 'Peru, Nuevo Sol', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'UYU' => ['code' => 'UYU', 'title' => 'Peso Uruguayo', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'PHP' => ['code' => 'PHP', 'title' => 'Philippine Peso', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'PLN' => ['code' => 'PLN', 'title' => 'Poland, Zloty', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ' ', 'symbolPlacement' => 'before'],
		'GBP' => ['code' => 'GBP', 'title' => 'Pound Sterling', 'symbol' => '&pound;', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'OMR' => ['code' => 'OMR', 'title' => 'Rial Omani', 'symbol' => null, 'precision' => 3, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'RON' => ['code' => 'RON', 'title' => 'Romania, New Leu', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'ROL' => ['code' => 'ROL', 'title' => 'Romania, Old Leu', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'RUB' => ['code' => 'RUB', 'title' => 'Russian Ruble', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'SAR' => ['code' => 'SAR', 'title' => 'Saudi Riyal', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'SGD' => ['code' => 'SGD', 'title' => 'Singapore Dollar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'SKK' => ['code' => 'SKK', 'title' => 'Slovak Koruna', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => ' ', 'symbolPlacement' => 'before'],
		'SIT' => ['code' => 'SIT', 'title' => 'Slovenia, Tolar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'ZAR' => ['code' => 'ZAR', 'title' => 'South Africa, Rand', 'symbol' => 'R', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ' ', 'symbolPlacement' => 'before'],
		'KRW' => ['code' => 'KRW', 'title' => 'South Korea, Won ₩', 'symbol' => '&#8361;', 'precision' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'SZL' => ['code' => 'SZL', 'title' => 'Swaziland, Lilangeni', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ', ', 'symbolPlacement' => 'before'],
		'SEK' => ['code' => 'SEK', 'title' => 'Swedish Krona', 'symbol' => 'kr', 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'after'],
		'CHF' => ['code' => 'CHF', 'title' => 'Swiss Franc', 'symbol' => 'SFr ', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => '\'', 'symbolPlacement' => 'before'],
		'TZS' => ['code' => 'TZS', 'title' => 'Tanzanian Shilling', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'THB' => ['code' => 'THB', 'title' => 'Thailand, Baht ฿', 'symbol' => '&#3647;', 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'after'],
		'TOP' => ['code' => 'TOP', 'title' => 'Tonga, Paanga', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'AED' => ['code' => 'AED', 'title' => 'UAE Dirham', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'UAH' => ['code' => 'UAH', 'title' => 'Ukraine, Hryvnia', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => ' ', 'symbolPlacement' => 'before'],
		'USD' => ['code' => 'USD', 'title' => 'US Dollar', 'symbol' => '$', 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'VUV' => ['code' => 'VUV', 'title' => 'Vanuatu, Vatu', 'symbol' => null, 'precision' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ',', 'symbolPlacement' => 'before'],
		'VEF' => ['code' => 'VEF', 'title' => 'Venezuela Bolivares Fuertes', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'VEB' => ['code' => 'VEB', 'title' => 'Venezuela, Bolivar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'VND' => ['code' => 'VND', 'title' => 'Viet Nam, Dong ₫', 'symbol' => '&#x20ab;', 'precision' => 0, 'thousandSeparator' => '', 'decimalSeparator' => '.', 'symbolPlacement' => 'before'],
		'ZWD' => ['code' => 'ZWD', 'title' => 'Zimbabwe Dollar', 'symbol' => null, 'precision' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ' ', 'symbolPlacement' => 'before'],
	];

	/**
	 * Create new Currency instance.
	 *
	 * @param string Currency ISO-4217 code
	 * @return void
	 */
	function __construct($code)
	{
		if ( ! $this->hasCurrency($code))
			throw new CurrencyException("Currency not found: \"{$code}\"");

		$currency = $this->getCurrency($code);

		foreach($currency as $key => $value)
		{
			if (property_exists($this, $key))
				$this->$key = $value;
		}
	}

	/**
	 * Get currency ISO-4217 code.
	 *
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * Get currency symbol.
	 *
	 * @return string
	 */
	public function getSymbol()
	{
		return $this->symbol;
	}

	/**
	 * Get currency precision.
	 *
	 * @return int
	 */
	public function getPrecision()
	{
		return $this->precision;
	}

	/**
	 * Get currency title.
	 *
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get currency thousand separator.
	 *
	 * @return string
	 */
	public function getThousandSeparator()
	{
		return $this->thousandSeparator;
	}

	/**
	 * Get currency decimal separator.
	 *
	 * @return string
	 */
	public function getDecimalSeparator()
	{
		return $this->decimalSeparator;
	}

	/**
	 * Get currency symbol placement.
	 *
	 * @return string
	 */
	public function getSymbolPlacement()
	{
		return $this->symbolPlacement;
	}

	/**
	 * Get all currencies.
	 *
	 * @return array
	 */
	public static function getAllCurrencies()
	{
		return self::$currencies;
	}

	/**
	 * Get currency.
	 *
	 * @access protected
	 * @return array
	 */
	protected function getCurrency($code)
	{
		return self::$currencies[$code];
	}

	/**
	 * Check currency existence (within the class)
	 *
	 * @access protected
	 * @return bool
	 */
	protected function hasCurrency($code)
	{
		return isset(self::$currencies[$code]);
	}
}