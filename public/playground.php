<?php

use Illuminate\Support\Collection;

require __DIR__ . '/../vendor/autoload.php';

$numbers = new Collection([
    1, 2, 3, 4, 5, 6, 7, 8, 9, 10
]);

//if($numbers->contains(10)) {
//    die('it contains 10');
//}

$lessOrEqualTo5 = $numbers->filter(fn($number) => $number <= 5);
var_dump($lessOrEqualTo5);

