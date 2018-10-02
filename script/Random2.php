<?php

require_once __DIR__ . '/../vendor/autoload.php';

passthru("clear");

echo "\n";

/** @todo SHOW MUST RECEIVE JUST STRATEGY AND NO STEP */
$show = new Sensorario\Biberon\Show(
    (new Sensorario\Biberon\Detector())->addRules([
        'D' => function ($input, Sensorario\Biberon\Strategy\StepStrategy $strategy) {
            return $strategy->getCurrent() == 7;
            $day = $strategy->getCurrent()->format('D');
            return 'Sun' == $day;
        },
        'S' => function ($input, Sensorario\Biberon\Strategy\StepStrategy $strategy) {
            return $strategy->getCurrent() == 8;
            $day = $strategy->getCurrent()->format('D');
            return 'Sat' == $day;
        },
    ])->setColors([
        'S' => Sensorario\Biberon\Detector::COLOR_YELLOW,
        'D' => Sensorario\Biberon\Detector::COLOR_RED,
    ]),
    (new Sensorario\Biberon\Stat())->init([
        'count' => 100,
        'columnsize' => 20,
    ])
);

while ($show->mustGoOn()) {
    $show->next(function() {
        return rand(1, 10);
    });
}

echo "\n";
