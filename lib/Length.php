<?php

namespace rdx\units;

use rdx\units\Quantity;

class Length extends Quantity {

	// The base unit for the `$units` conversion table
	const BASE_UNIT = 'm';

	// New objects will convert to this unit
	static public $default_unit = self::BASE_UNIT;

	// Conversion table for this Quantity
	static public $units = array(
		'm' => 1, // base
		'km' => 1000,
		'ml' => 1609.344,
		'yd' => 0.9144,
		'ft' => 0.3048,
		'in' => 25.4,
	);

	/**
	 * The convertor heart, that every sub class needs
	 */
	protected function convertor( $toUnit ) {
		return $this->convertUsingTable($toUnit);
	}

}
