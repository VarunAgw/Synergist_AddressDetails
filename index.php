<?php

require 'vendor/autoload.php';

use VarunAgw\Maps;

$maps = new Maps\Maps();

try {
    $addressDetails = $maps->getAddressDetails('Köpenicker Str. 126');
    var_dump($addressDetails);

} catch (Maps\MapsException $e) {
    var_dump($e->getMessage());
}
