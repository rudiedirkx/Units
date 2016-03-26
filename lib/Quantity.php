<?php

namespace rdx\units;

use rdx\units\exceptions\ConversionException;

abstract class Quantity {

	// The sub class must set these, since every Quantity has different units
	// const BASE_UNIT = 'l';

	// static public $default_unit = self::BASE_UNIT;
	// static public $units = array();

	/**
	 *
	 */
	static public function convert( $amount, $fromUnit, $toUnit ) {
		$quantity = new static($amount, $fromUnit);
		return $quantity->to($toUnit);
	}



	public $original_unit = '';
	public $unit = '';
	public $amount = 0;

	/**
	 *
	 */
	public function __construct( $amount, $unit = null, $convertToDefault = true ) {
		$this->amount = $amount;
		$this->unit = $unit ?: $this::$default_unit;

		$this->original_unit = $this->unit;

		// Convert incoming unit into storage unit
		if ( $convertToDefault && $this->unit != $this::$default_unit ) {
			$this->amount = $this->to($this::$default_unit);
			$this->unit = $this::$default_unit;
		}
	}

	/**
	 * Convert object amount to another unit, and return, don't save
	 */
	public function to( $toUnit ) {
		return $this->convertor($toUnit);
	}

	/**
	 * The convertor heart, that every sub class needs
	 */
	abstract protected function convertor( $toUnit );

	/**
	 * The default convertor, using the Quantity's conversion table
	 */
	protected function convertUsingTable( $toUnit ) {
		if (!isset($this::$units[$toUnit])) {
			$quantity = (new \ReflectionClass($this))->getShortName();
			throw new ConversionException("Can't convert '$quantity' to '$toUnit'.");
		}

		$amount = $this->amount;

		// First convert from `$this->unit` to `BASE_UNIT`
		$factor = $this::$units[$this->unit];
		$amount = $factor < 0 ? abs($factor) / $amount : $amount * $factor;

		// Then convert from `BASE_UNIT` to `$toUnit`
		$factor = $this::$units[$toUnit];
		$amount = $factor < 0 ? $factor * $amount : $amount / abs($factor);

		return $amount;
	}

	/**
	 * Advanded convertor, using unit-base-unit methods
	 */
	protected function convertUsingMethods( $toUnit ) {
		$amount = $this->amount;

		if ($this->unit != $this::BASE_UNIT) {
			$amount = call_user_func(array($this, $this->unit . 'to' . $this::BASE_UNIT), $amount);
		}

		if ($this::BASE_UNIT != $toUnit) {
			$amount = call_user_func(array($this, $this::BASE_UNIT . 'to' . $toUnit), $amount);
		}

		return $amount;
	}

	/**
	 * Convert the object to another standard unit
	 */
	public function convertTo( $unit ) {
		$this->amount = $this->to($unit);
		$this->unit = $unit;
	}

	/**
	 * Return this quantity in all known units.
	 */
	public function all() {
		$all = array();
		foreach ($this::$units as $unit => $conversion) {
			if (is_int($unit)) {
				$unit = $conversion;
			}

			$all[$unit] = $this->to($unit);
		}

		return $all;
	}

}
