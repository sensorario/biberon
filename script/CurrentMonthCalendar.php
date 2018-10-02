<?php

require_once __DIR__ . '/../vendor/autoload.php';

passthru("clear");

echo "\n";

/** @todo SHOW MUST RECEIVE JUST STRATEGY AND NO STEP */
$show = new Sensorario\Biberon\Show(
    (new Sensorario\Biberon\Detector())->addRules([
        'M' => function ($input, Sensorario\Biberon\Strategy\StepStrategy $strategy) {
            $day = $strategy->getCurrent()->format('D');
            return 'Mon' == $day;
        },
        'T' => function ($input, Sensorario\Biberon\Strategy\StepStrategy $strategy) {
            $day = $strategy->getCurrent()->format('D');
            return 'Tue' == $day || 'Thu' == $day;
        },
        'W' => function ($input, Sensorario\Biberon\Strategy\StepStrategy $strategy) {
            $day = $strategy->getCurrent()->format('D');
            return 'Wed' == $day;
        },
        'D' => function ($input, Sensorario\Biberon\Strategy\StepStrategy $strategy) {
            $day = $strategy->getCurrent()->format('D');
            return 'Sun' == $day;
        },
        'F' => function ($input, Sensorario\Biberon\Strategy\StepStrategy $strategy) {
            $day = $strategy->getCurrent()->format('D');
            return 'Fri' == $day;
        },
        'S' => function ($input, Sensorario\Biberon\Strategy\StepStrategy $strategy) {
            $day = $strategy->getCurrent()->format('D');
            return 'Sat' == $day;
        },
    ])->setColors([
        'S' => Sensorario\Biberon\Detector::COLOR_YELLOW,
        'D' => Sensorario\Biberon\Detector::COLOR_RED,
    ]),
    new Sensorario\Biberon\Strategy\DayIncrement(
        (new Sensorario\Biberon\Stat())->init([
            'count' => 4,
            'columnsize' => 7,
        ]),
        new \DateTime('-2 days'),
        new \DateTime('31 octo')
    )
);

while ($show->mustGoOn()) {
    $show->next(function() {
        return rand(1, 10);
    });
}

echo "\n";

