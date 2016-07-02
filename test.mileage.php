<?php

require 'autoload.php';

use rdx\units\Mileage;

header('Content-type: text/plain');

$q = new Mileage(40);
print_r($q);
echo "\n";

Mileage::$default_unit = 'mpusg';
echo "Changed default to " . Mileage::$default_unit . "\n\n";

$q = new Mileage(40);
print_r($q);
echo "\n";

$q = new Mileage(40, 'base');
print_r($q);
echo "\n";

$q = new Mileage(40, 'lp100km');
print_r($q);
echo "\n";

$q = new Mileage(40, 'mpusg');
print_r($q);
echo "\n";

$q = new Mileage(40, 'mpbg');
print_r($q);
echo "\n";

var_dump(Mileage::convert(40, 'mpbg', 'kmpl'));
