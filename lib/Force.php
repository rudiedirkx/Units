<?php

namespace rdx\units;

use rdx\units\Quantity;

class Force extends Quantity {

	// The base unit for the `$units` conversion table
	const BASE_UNIT = 'n';

	// New objects will convert to this unit
	static public $default_unit = self::BASE_UNIT;

	// Conversion table for this Quantity
	static public $units = array(

	);

}
