<?php

$community = $argv[1] ?? "pugromagna";
$columnsize = $argv[2] ?? "10";

require_once __DIR__ . '/../vendor/autoload.php';

passthru("clear");
passthru("figlet " . $community);

use Sensorario\Biberon\Biberon;
use Sensorario\Biberon\Detector;
use Sensorario\Biberon\Github\IssueLoader;
use Sensorario\Biberon\Stat;

$detector = new Detector();
$detector->setColors([
    'c' => Cli::green,
    'o' => Cli::red,
]);
$detector->addRules([
    'c' => function ($input) { return $input['state'] == 'closed'; },
    'o' => function ($input) { return $input['state'] == 'open'; },
]);

$issues = (new IssueLoader([
    'community' => $community,
]))->load();

echo "\n";
echo "\n";

$data = $issues;


$stat = new Stat();

$stat->init([
    'count' => count($data),
    'column' => 0,
    'print' => 0,
    'columnsize' => $columnsize,
]);

foreach ($data as $item) {
    usleep(1000);
    $detector->echoDetection($item);
    $stat->step();
}

echo "\n";
echo "\n";
