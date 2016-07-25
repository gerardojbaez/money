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
	 * Currency precission (number of decimals).
	 *
	 * @var int
	 */
	protected $precission;

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
	protected $currencies = [
		'ARS' => ['code' => 'ARS', 'title' => 'Argentine Peso', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'AMD' => ['code' => 'AMD', 'title' => 'Armenian Dram', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'AWG' => ['code' => 'AWG', 'title' => 'Aruban Guilder', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'AUD' => ['code' => 'AUD', 'title' => 'Australian Dollar', 'symbol' => 'AU$', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ' ', 'symbolPlacement' => 'front'],
		'BSD' => ['code' => 'BSD', 'title' => 'Bahamian Dollar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'BHD' => ['code' => 'BHD', 'title' => 'Bahraini Dinar', 'symbol' => null, 'precission' => 3, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'BDT' => ['code' => 'BDT', 'title' => 'Bangladesh, Taka', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'BZD' => ['code' => 'BZD', 'title' => 'Belize Dollar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'BMD' => ['code' => 'BMD', 'title' => 'Bermudian Dollar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'BOB' => ['code' => 'BOB', 'title' => 'Bolivia, Boliviano', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'BAM' => ['code' => 'BAM', 'title' => 'Bosnia and Herzegovina, Convertible Marks', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'BWP' => ['code' => 'BWP', 'title' => 'Botswana, Pula', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'BRL' => ['code' => 'BRL', 'title' => 'Brazilian Real', 'symbol' => 'R$', 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'BND' => ['code' => 'BND', 'title' => 'Brunei Dollar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'CAD' => ['code' => 'CAD', 'title' => 'Canadian Dollar', 'symbol' => 'CA$', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'KYD' => ['code' => 'KYD', 'title' => 'Cayman Islands Dollar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'CLP' => ['code' => 'CLP', 'title' => 'Chilean Peso', 'symbol' => null, 'precission' => 0, 'thousandSeparator' => '', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'CNY' => ['code' => 'CNY', 'title' => 'China Yuan Renminbi', 'symbol' => 'CN&yen;', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'COP' => ['code' => 'COP', 'title' => 'Colombian Peso', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'CRC' => ['code' => 'CRC', 'title' => 'Costa Rican Colon', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'HRK' => ['code' => 'HRK', 'title' => 'Croatian Kuna', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'CUC' => ['code' => 'CUC', 'title' => 'Cuban Convertible Peso', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'CUP' => ['code' => 'CUP', 'title' => 'Cuban Peso', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'CYP' => ['code' => 'CYP', 'title' => 'Cyprus Pound', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'CZK' => ['code' => 'CZK', 'title' => 'Czech Koruna', 'symbol' => 'Kc', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'after'],
		'DKK' => ['code' => 'DKK', 'title' => 'Danish Krone', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'DOP' => ['code' => 'DOP', 'title' => 'Dominican Peso', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'XCD' => ['code' => 'XCD', 'title' => 'East Caribbean Dollar', 'symbol' => 'EC$', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'EGP' => ['code' => 'EGP', 'title' => 'Egyptian Pound', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'SVC' => ['code' => 'SVC', 'title' => 'El Salvador Colon', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'EUR' => ['code' => 'EUR', 'title' => 'Euro', 'symbol' => '&euro;', 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'GHC' => ['code' => 'GHC', 'title' => 'Ghana, Cedi', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'GIP' => ['code' => 'GIP', 'title' => 'Gibraltar Pound', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'GTQ' => ['code' => 'GTQ', 'title' => 'Guatemala, Quetzal', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'HNL' => ['code' => 'HNL', 'title' => 'Honduras, Lempira', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'HKD' => ['code' => 'HKD', 'title' => 'Hong Kong Dollar', 'symbol' => 'HK$', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'HUF' => ['code' => 'HUF', 'title' => 'Hungary, Forint', 'symbol' => 'HK$', 'precission' => 0, 'thousandSeparator' => '', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'ISK' => ['code' => 'ISK', 'title' => 'Iceland Krona', 'symbol' => 'kr', 'precission' => 0, 'thousandSeparator' => '', 'decimalSeparator' => '.', 'symbolPlacement' => 'after'],
		'INR' => ['code' => 'INR', 'title' => 'Indian Rupee ₹', 'symbol' => '&#2352;', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'IDR' => ['code' => 'IDR', 'title' => 'Indonesia, Rupiah', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'IRR' => ['code' => 'IRR', 'title' => 'Iranian Rial', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'JMD' => ['code' => 'JMD', 'title' => 'Jamaican Dollar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'JPY' => ['code' => 'JPY', 'title' => 'Japan, Yen', 'symbol' => '&yen;', 'precission' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'JOD' => ['code' => 'JOD', 'title' => 'Jordanian Dinar', 'symbol' => null, 'precission' => 3, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'KES' => ['code' => 'KES', 'title' => 'Kenyan Shilling', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'KWD' => ['code' => 'KWD', 'title' => 'Kuwaiti Dinar', 'symbol' => null, 'precission' => 3, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'LVL' => ['code' => 'LVL', 'title' => 'Latvian Lats', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'LBP' => ['code' => 'LBP', 'title' => 'Lebanese Pound', 'symbol' => null, 'precission' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ' ', 'symbolPlacement' => 'front'],
		'LTL' => ['code' => 'LTL', 'title' => 'Lithuanian Litas', 'symbol' => 'Lt', 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => ' ', 'symbolPlacement' => 'after'],
		'MKD' => ['code' => 'MKD', 'title' => 'Macedonia, Denar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'MYR' => ['code' => 'MYR', 'title' => 'Malaysian Ringgit', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'MTL' => ['code' => 'MTL', 'title' => 'Maltese Lira', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'MUR' => ['code' => 'MUR', 'title' => 'Mauritius Rupee', 'symbol' => null, 'precission' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'MXN' => ['code' => 'MXN', 'title' => 'Mexican Peso', 'symbol' => 'MX$', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'MZM' => ['code' => 'MZM', 'title' => 'Mozambique Metical', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'NPR' => ['code' => 'NPR', 'title' => 'Nepalese Rupee', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'ANG' => ['code' => 'ANG', 'title' => 'Netherlands Antillian Guilder', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'ILS' => ['code' => 'ILS', 'title' => 'New Israeli Shekel ₪', 'symbol' => '&#8362;', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'TRY' => ['code' => 'TRY', 'title' => 'New Turkish Lira', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'NZD' => ['code' => 'NZD', 'title' => 'New Zealand Dollar', 'symbol' => 'NZ$', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'NOK' => ['code' => 'NOK', 'title' => 'Norwegian Krone', 'symbol' => 'kr', 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'after'],
		'PKR' => ['code' => 'PKR', 'title' => 'Pakistan Rupee', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'PEN' => ['code' => 'PEN', 'title' => 'Peru, Nuevo Sol', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'UYU' => ['code' => 'UYU', 'title' => 'Peso Uruguayo', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'PHP' => ['code' => 'PHP', 'title' => 'Philippine Peso', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'PLN' => ['code' => 'PLN', 'title' => 'Poland, Zloty', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ' ', 'symbolPlacement' => 'front'],
		'GBP' => ['code' => 'GBP', 'title' => 'Pound Sterling', 'symbol' => '&pound;', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'OMR' => ['code' => 'OMR', 'title' => 'Rial Omani', 'symbol' => null, 'precission' => 3, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'RON' => ['code' => 'RON', 'title' => 'Romania, New Leu', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'ROL' => ['code' => 'ROL', 'title' => 'Romania, Old Leu', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'RUB' => ['code' => 'RUB', 'title' => 'Russian Ruble', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'SAR' => ['code' => 'SAR', 'title' => 'Saudi Riyal', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'SGD' => ['code' => 'SGD', 'title' => 'Singapore Dollar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'SKK' => ['code' => 'SKK', 'title' => 'Slovak Koruna', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => ' ', 'symbolPlacement' => 'front'],
		'SIT' => ['code' => 'SIT', 'title' => 'Slovenia, Tolar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'ZAR' => ['code' => 'ZAR', 'title' => 'South Africa, Rand', 'symbol' => 'R', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ' ', 'symbolPlacement' => 'front'],
		'KRW' => ['code' => 'KRW', 'title' => 'South Korea, Won ₩', 'symbol' => '&#8361;', 'precission' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'SZL' => ['code' => 'SZL', 'title' => 'Swaziland, Lilangeni', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ', ', 'symbolPlacement' => 'front'],
		'SEK' => ['code' => 'SEK', 'title' => 'Swedish Krona', 'symbol' => 'kr', 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'after'],
		'CHF' => ['code' => 'CHF', 'title' => 'Swiss Franc', 'symbol' => 'SFr ', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => '\'', 'symbolPlacement' => 'front'],
		'TZS' => ['code' => 'TZS', 'title' => 'Tanzanian Shilling', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'THB' => ['code' => 'THB', 'title' => 'Thailand, Baht ฿', 'symbol' => '&#3647;', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'after'],
		'TOP' => ['code' => 'TOP', 'title' => 'Tonga, Paanga', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'AED' => ['code' => 'AED', 'title' => 'UAE Dirham', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'UAH' => ['code' => 'UAH', 'title' => 'Ukraine, Hryvnia', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => ' ', 'symbolPlacement' => 'front'],
		'USD' => ['code' => 'USD', 'title' => 'US Dollar', 'symbol' => '$', 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'VUV' => ['code' => 'VUV', 'title' => 'Vanuatu, Vatu', 'symbol' => null, 'precission' => 0, 'thousandSeparator' => '', 'decimalSeparator' => ',', 'symbolPlacement' => 'front'],
		'VEF' => ['code' => 'VEF', 'title' => 'Venezuela Bolivares Fuertes', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'VEB' => ['code' => 'VEB', 'title' => 'Venezuela, Bolivar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => ',', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'VND' => ['code' => 'VND', 'title' => 'Viet Nam, Dong ₫', 'symbol' => '&#x20ab;', 'precission' => 0, 'thousandSeparator' => '', 'decimalSeparator' => '.', 'symbolPlacement' => 'front'],
		'ZWD' => ['code' => 'ZWD', 'title' => 'Zimbabwe Dollar', 'symbol' => null, 'precission' => 2, 'thousandSeparator' => '.', 'decimalSeparator' => ' ', 'symbolPlacement' => 'front'],
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
	 * Get currency precission.
	 *
	 * @return int
	 */
	public function getPrecission()
	{
		return $this->precission;
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
	 * Get currency.
	 *
	 * @access protected
	 * @return array
	 */
	protected function getCurrency($code)
	{
		return $this->currencies[$code];
	}

	/**
	 * Check currency existense (within the class)
	 *
	 * @access protected
	 * @return bool
	 */
	protected function hasCurrency($code)
	{
		return isset($this->currencies[$code]);
	}
}