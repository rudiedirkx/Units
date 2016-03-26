<?php

use Behat\Gherkin\Node\TableNode;

require 'vendor/autoload.php';

header('Content-type: text/plain');

echo "No white space:\n\n";

$table = new TableNode([
	[1, 23, 456],
	[456, 23, 1],
]);
echo $table . "\n\n";
print_r($table);

echo "\n\n\n\n";

echo "Manual white space:\n\n";

$table = new TableNode([
	['  1', '23', '456'],
	['456', '23', '  1'],
]);
echo $table . "\n\n";
print_r($table);

echo "\n\n\n\n";
