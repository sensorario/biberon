<?php

require_once __DIR__ . '/../vendor/autoload.php';

passthru("clear");
passthru("figlet without progress");

use Sensorario\Progress\Stat;
use Sensorario\Progress\Progress;
use Sensorario\Progress\Detector;

$detector = new Detector();
$detector->addRules([
    'D' => function ($input) {
        return is_dir($input);
    },
]);

$data = scandir('/usr/local/bin');

$stat = new Stat();

$stat->init([
    'count' => count($data),
    'column' => 0,
    'print' => 0,
    'columnsize' => 100,
]);

foreach ($data as $item) {
    usleep(1000);
    $detector->echoDetection($item);

    if ($stat->isEndOfLine()) {
        $stat->echoEndOfLine();
        $stat->resetColumnCounter();
    } else {
        $stat->updateCounters();
    }
}
