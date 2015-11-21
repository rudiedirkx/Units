<?php

namespace rdx\units;

use rdx\units\Quantity;

class Temperature extends Quantity {

	// The base unit for the `$units` conversion table
	const BASE_UNIT = 'k'; // Kelvin

	// New objects will convert to this unit
	static public $default_unit = self::BASE_UNIT;

	/**
	 *
	 */
	protected function convertor( $toUnit ) {
		return $this->convertUsingMethods($toUnit);
	}

	/**
	 *
	 */
	protected function kToF( $amount ) {
		return ($amount - 273.15) * 9/5 + 32;
	}

	/**
	 *
	 */
	protected function fToK( $amount ) {
		return ($amount - 32) * 5/9 + 273.15;
	}

	/**
	 *
	 */
	protected function kToC( $amount ) {
		return $amount - 273.15;
	}

	/**
	 *
	 */
	protected function cToK( $amount ) {
		return $amount + 273.15;
	}

}
