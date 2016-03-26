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
		$class = 'rdx\units\\' . $quantity;
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
	 * @Then I should have all:
	 */
	public function iShouldHaveAll(TableNode $target) {
		$target = $target->getRowsHash();
		$result = $this->quantity->all();
		$this->assertTables($target, $result, array_keys($target));
	}



	/**
	 * Compare 2 tables. Must be identical (after unification) to pass.
	 *
	 * @todo Better error highlighting: show only failed rows in red, don't repeat table.
	 */
	protected function assertTables($target, $result, array $order) {
		$target = $this->unifyTable($target);
		$result = $this->unifyTable($result);

		if ($result != $target) {
			$table = array();
			foreach ($order as $unit) {
				if (isset($result[$unit])) {
					$table[] = array($unit, $result[$unit]);
					unset($result[$unit]);
				}
			}
			foreach ($result as $unit => $amount) {
				$table[] = array($unit, $amount);
			}

			$table = new TableNode($table);
			throw new \Exception("Result table is wrong:\n$table");
		}
	}

	/**
	 * Compare 2 numbers. Must be identical (after unification) to pass.
	 */
	protected function assertAmounts($target, $result) {
		$target = $this->round($target);
		$result = $this->round($result);

		if ($result != $target) {
			throw new \Exception("Result should be $target, but is $result");
		}
	}

	/**
	 * Unify a single number.
	 */
	protected function round($amount) {
		return number_format($amount, 4);
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
