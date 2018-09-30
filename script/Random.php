<?php

require_once __DIR__ . '/../vendor/autoload.php';

passthru("clear");

echo "\n";

$show = new Sensorario\Biberon\Show(
    new Sensorario\Biberon\Detector(),
    (new Sensorario\Biberon\Stat())->init([
        'count' => 100,
        'columnsize' => 33,
    ])
);

while ($show->mustGoOn()) {
    $show->next(function() {
        return rand(11111, 99999);
    });
}

echo "\n";
