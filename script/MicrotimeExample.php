<?php

require_once __DIR__ . '/../vendor/autoload.php';

passthru("clear");
passthru("figlet microtime");

use Sensorario\Biberon\Detector;

$detector = new Detector();
$detector->setColors([
    'B' => Cli::blue,
    'p' => Cli::red,
    'L' => Cli::violet,
]);
$detector->addRules([
    'L' => function ($input) { return $input < 30000; },
    'B' => function ($input) { return $input > 70000; },
    'p' => function ($input) { return $input % 2 == 0; },
    'd' => function ($input) { return $input % 2 == 1; },
]);

$data = [];
for ($i = 0; $i < 666; $i++) {
    $data[] = rand(1, 99999);
}

$show = new Sensorario\Biberon\Show(
    $detector,
    new Sensorario\Biberon\Strategy\CounterIncrement(
        (new Sensorario\Biberon\Stat())->init([
            'count' => count($data),
            'column' => 0,
            'print' => 0,
            'columnsize' => 48,
        ])
    )
);

while ($show->mustGoOn()) {
    $show->next(function() {
        return rand(11111, 99999);
    });
}

echo "\n";
