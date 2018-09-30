<?php

require_once __DIR__ . '/../vendor/autoload.php';

passthru("clear");

echo "\n";

$show = new Sensorario\Biberon\Show(
    (new Sensorario\Biberon\Detector())->addRules([
        'X' => function ($input) { return $input == 10; },
        'I' => function ($input) { return $input == 1; },
    ])->setColors([
        'X' => Sensorario\Biberon\Detector::COLOR_RED,
        'I' => Sensorario\Biberon\Detector::COLOR_GREEN,
    ]),
    (new Sensorario\Biberon\Stat())->init([
        'count' => 100,
        'columnsize' => 33,
    ])
);

while ($show->mustGoOn()) {
    $show->next(function() {
        return rand(1, 10);
    });
}

echo "\n";
