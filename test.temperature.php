<?php

require 'Quantity.php';
require 'Temperature.php';

use rdx\units\Temperature;

header('Content-type: text/plain');

$q = new Temperature(100);
print_r($q);

$q = new Temperature(100, 'c');
print_r($q);

$q = new Temperature(100, 'f');
print_r($q);

var_dump(Temperature::convert(100, 'f', 'c'));
var_dump(Temperature::convert(100, 'c', 'f'));
