<?php

namespace rdx\units;

use rdx\units\Quantity;

class Pressure extends Quantity {

	// The base unit for the `$units` conversion table
	const BASE_UNIT = 'pa';

	// New objects will convert to this unit
	static public $default_unit = self::BASE_UNIT;

	// Conversion table for this Quantity
	static public $units = array(

	);

}
