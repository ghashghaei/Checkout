<?php

use src\Rules\Discount;
use src\Main\Checkout;

spl_autoload_register(function ($full_classified_class_name) {
    $path = str_replace('\\', '/', $full_classified_class_name);

    if (file_exists($path . '.php')) {
        include $path . '.php';
    } else {
        throw new \Exception('error');
    }
});

$prices = [
    'prices' => [
        'A' => 50,
        'B' => 30,
        'C' => 20,
        'D' => 15,
    ],
    'rule' => [
        Discount::class => [
            'A' => [
                'count' => 3,
                'price' => 130,
            ],
            'B' => [
                'count' => 2,
                'price' => 45,
            ],
        ],
    ],
];

$rules = new Discount($prices);

$co = new Checkout($rules);

echo 'Scan 1 A<br />';
$co->scan('A');

// echo "Scan 2 B<br />";
// $co->scan('B');

echo 'Scan 3 A<br />';
$co->scan('A');

echo 'Scan 4 A<br /><br />';
$co->scan('A');

echo 'Scan 5 B<br /><br />';
$co->scan('B');

echo 'Total: ';
echo $co->total();
