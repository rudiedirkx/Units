<?php

namespace rdx\units;

use rdx\units\Quantity;

class Mileage extends Quantity {

	// The base unit for the `$units` conversion table
	const BASE_UNIT = 'kmpl'; // kilometer / liter

	// New objects will convert to this unit
	static public $default_unit = self::BASE_UNIT;

	// Conversion table for this Quantity
	// XpY => (X in km) / (Y in l)
	// USMpG => (1.6 / 3.8)
	static public $units = array(
		'kmpl' => 1, // base
		'lp100km' => -100, // 100 / l
		'mpusg' => 0.425144, // 1.6 / 3.8
		'mpbg' => 0.354005, // 1.6 / 4.5
	);

	/**
	 * The convertor heart, that every sub class needs
	 */
	protected function convertor( $toUnit ) {
		return $this->convertUsingTable($toUnit);
	}

}
