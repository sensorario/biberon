<?php

require_once __DIR__ . '/../vendor/autoload.php';

passthru("clear");
passthru("figlet microtime");

use Sensorario\Progress\Stat;
use Sensorario\Progress\Progress;
use Sensorario\Progress\Detector;

$detector = new Detector();
$detector->setColors([
    'B' => Detector::COLOR_GREEN,
    'p' => Detector::COLOR_RED,
    'L' => Detector::COLOR_VIOLET,
]);
$detector->addRules([
    'L' => function ($input) { return $input < 10000; },
    'B' => function ($input) { return $input > 70000; },
    'p' => function ($input) { return $input % 2 == 0; },
    'd' => function ($input) { return $input % 2 == 1; },
]);

$data = [];
for ($i = 0; $i < 666; $i++) {
    $data[] = rand(1, 99999);
}

$stat = new Stat();

$stat->init([
    'count' => count($data),
    'column' => 0,
    'print' => 0,
    'columnsize' => 48,
]);

foreach ($data as $item) {
    usleep(4000);
    $detector->echoDetection($item);

    if ($stat->isEndOfLine()) {
        $stat->echoEndOfLine();
        $stat->resetColumnCounter();
    } else {
        $stat->updateCounters();
    }
}

echo "\n";
