<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

class FeatureContext implements Context, SnippetAcceptingContext {

	/** @var $quantity rdx\units\Quantity */
	protected $quantity;



	/**
	 * Initializes context.
	 */
	public function __construct() {

	}



	/**
	 * @Given I start with :amount :unit of :quantity
	 */
	public function iStartWithAmountUnitOfQuantity($amount, $unit, $quantity) {
		$class = $this->getClass($quantity);
		$this->quantity = new $class($amount, $unit);
	}



	/**
	 * @When I convert it to :unit
	 */
	public function iConvertItToUnit($unit) {
		$this->quantity->convertTo($unit);
	}



	/**
	 * @Then I should have :amount
	 */
	public function iShouldHaveAmount($amount) {
		$this->assertAmounts($amount, $this->quantity->amount);
	}

	/**
	 * @Then I should have :amount :unit
	 */
	public function iShouldHave2AmountUnit($amount, $unit) {
		$this->assertAmounts($amount, $this->quantity->to($unit));
	}

	/**
	 * @Then I should have :number :quantity units
	 */
	public function iShouldHaveUnits($number, $quantity) {
		$class = $this->getClass($quantity);
		$units = $class::$units;

		if (count($units) != $number) {
			$units = count($units);
			throw new \Exception("'$quantity' should have $number units, but has $units");
		}
	}



	/**
	 *
	 */
	protected function getClass($quantity) {
		return 'rdx\units\\' . $quantity;
	}

	/**
	 * Compare 2 numbers. Must be identical (after unification) to pass.
	 */
	protected function assertAmounts($target, $result) {
		$target = $this->round($target);
		$result = $this->round($result);

		if ($result !== $target) {
			if ($result === false) {
				$result = '<invalid>';
			}

			throw new \Exception("Result should be $target, but is $result");
		}
	}

	/**
	 * Unify a single number.
	 */
	protected function round($amount) {
		if ($amount === false) {
			return $amount;
		}

		return number_format((float) $amount, 4);
	}

	/**
	 * Unify a table of numbers.
	 */
	protected function unifyTable($table) {
		$table = array_map(array($this, 'round'), $table);
		ksort($table);
		return $table;
	}

}
