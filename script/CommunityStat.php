<?php

$community = $argv[1] ?? "pugromagna";
$columnsize = $argv[2] ?? "10";

require_once __DIR__ . '/../vendor/autoload.php';

passthru("clear");
passthru("figlet " . $community);

use Sensorario\Progress\Stat;
use Sensorario\Progress\Progress;
use Sensorario\Progress\Detector;

$detector = new Detector();
$detector->setColors([
    'c' => Detector::COLOR_GREEN,
    'o' => Detector::COLOR_RED,
]);
$detector->addRules([
    'c' => function ($input) {
        return $input['state'] == 'closed';
    },
    'o' => function ($input) {
        return $input['state'] == 'open';
    },
]);

$issues = [];
$finished = false;
$page = 1;
while(!$finished) {
    echo "\n > scarico pagina " . $page;
    $url = "https://api.github.com/repos/" . $community . "/eventi/issues?state=all&page=" . $page;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    $output = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($output, true);
    if ($data == json_decode('[]', true)) {
        $finished = true;
    } else {
        if (isset($data['message'])) {
            echo "\n\n";
            echo json_encode($data, JSON_PRETTY_PRINT);
            echo "\n\n";
            die;
        }
        $issues = array_merge($issues, $data);
        $page++;
    }
}

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

    if ($stat->isEndOfLine()) {
        $stat->echoEndOfLine();
        $stat->resetColumnCounter();
    } else {
        $stat->updateCounters();
    }
}

echo "\n";
echo "\n";
