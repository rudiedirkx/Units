<?php

namespace rdx\units;

use rdx\units\Quantity;

class Volume extends Quantity {

	// The base unit for the `$units` conversion table
	const BASE_UNIT = 'l'; // liter

	// New objects will convert to this unit
	static public $default_unit = self::BASE_UNIT;

	// Conversion table for this Quantity
	static public $units = array(
		'l' => 1, // base
		'usg' => 3.78541,
		'bg' => 4.54609,
	);

	/**
	 * The convertor heart, that every sub class needs
	 */
	protected function convertor( $toUnit ) {
		return $this->convertUsingTable($toUnit);
	}

}
