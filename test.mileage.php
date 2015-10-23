<?php

require 'Quantity.php';
require 'Mileage.php';

use rdx\units\Mileage;

header('Content-type: text/plain');

$q = new Mileage(40);
print_r($q);

$q = new Mileage(40, 'lp100km');
print_r($q);

$q = new Mileage(40, 'mpusg');
print_r($q);

$q = new Mileage(40, 'mpbg');
print_r($q);

var_dump(Mileage::convert(40, 'mpbg', 'kmpl'));
