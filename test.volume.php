<?php

require 'lib/Quantity.php';
require 'lib/Volume.php';

use rdx\units\Volume;

header('Content-type: text/plain');

$q = new Volume(1000);
print_r($q);

$q = new Volume(1000, 'usg');
print_r($q);

$q = new Volume(1000, 'bg');
print_r($q);

var_dump(Volume::convert(1000, 'bg', 'l'));
