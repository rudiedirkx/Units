<?php

namespace rdx\units;

use rdx\units\Quantity;

class Temperature extends Quantity {

	// The base unit for the `$units` conversion table
	const BASE_UNIT = 'k'; // Kelvin

	// New objects will convert to this unit
	static public $default_unit = self::BASE_UNIT;

	// @todo Implement convertor() for conversion
	// Fahrenheit <> Kelvin can't use a simple conversion table...

}
