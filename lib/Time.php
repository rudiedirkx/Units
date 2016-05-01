<?php

namespace rdx\units;

use rdx\units\Quantity;

class Time extends Quantity {

	// The base unit for the `$units` conversion table
	const BASE_UNIT = 's';

	// New objects will convert to this unit
	static public $default_unit = self::BASE_UNIT;

	// Conversion table for this Quantity
	static public $units = array(
		'ms' => .001,
		's' => 1,
		'm' => 60,
		'h' => 3600,
		'd' => 86400,
		'w' => 604800,
	);

	/**
	 * The convertor heart, that every sub class needs
	 */
	protected function convertor( $toUnit ) {
		return $this->convertUsingTable($toUnit);
	}

}
