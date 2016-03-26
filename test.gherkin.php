<?php

use Behat\Gherkin\Node\OutlineNode;
use Behat\Gherkin\Node\ScenarioNode;
use Behat\Gherkin\Node\TableNode;

require 'vendor/autoload.php';

//
// Padding to make Feature line 1 = Line 11
//
//

$feature = <<<FEATURE
Feature: All quantities and units
	Test all metadata and conversions between all units in all quantities

	Scenario Outline: Available units per quantity
		Then I should have "<Number>" "<Quantity>" units

		Examples:
			| Quantity    | Number |oele|
			| Temperature |   3    | boele |
			| Volume      |  13    |  tra |
            | Mileage     | 400    |lalala   |

    Scenario: Users
        Given I create these users:
            | name | age |
            | jeff | 101 |
            | jaap |  16 |
            | john |   3 |
FEATURE;

header('Content-type: text/plain');

$keywords = new Behat\Gherkin\Keywords\ArrayKeywords(array(
    'en' => array(
        'feature'          => 'Feature',
        'background'       => 'Background',
        'scenario'         => 'Scenario',
        'scenario_outline' => 'Scenario Outline',
        'examples'         => 'Examples',
        'given'            => 'Given',
        'when'             => 'When',
        'then'             => 'Then',
        'and'              => 'And',
        'but'              => 'But'
    ),
));
$lexer  = new Behat\Gherkin\Lexer($keywords);
$parser = new Behat\Gherkin\Parser($lexer);

try {
	$feature = $parser->parse($feature);
}
catch (Exception $ex) {
	echo $ex->getMessage() . "\n";
    exit;
}

foreach ($feature->getScenarios() as $scenario) {
    if ($scenario instanceof OutlineNode) {
        echo $scenario->getExampleTable() . "\n\n";
    }
    elseif ($scenario instanceof ScenarioNode) {
        foreach ($scenario->getSteps() as $step) {
            foreach ($step->getArguments() as $argument) {
                if ($argument instanceof TableNode) {
                    echo $argument . "\n\n";
                }
            }
            // print_r($step);
        }
    }
}

print_r($feature);
