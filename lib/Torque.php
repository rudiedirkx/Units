<?php

namespace rdx\units;

use rdx\units\Quantity;

class Torque extends Quantity {

	// The base unit for the `$units` conversion table
	const BASE_UNIT = 'nm';

	// New objects will convert to this unit
	static public $default_unit = self::BASE_UNIT;

	// Conversion table for this Quantity
	static public $units = array(

	);

}
