# Biberon

[![Build Status](https://travis-ci.org/sensorario/biberon.svg?branch=master)](https://travis-ci.org/sensorario/biberon)

## Example

![biberon2.png](biberon2.png)

```php
use Sensorario\Biberon\Biberon;
use Sensorario\Biberon\Detector;
use Sensorario\Biberon\Stat;

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
```

## Change dot with letter and color output

![biberon_microtime.png](biberon_microtime.png)

```php
use Sensorario\Biberon\Detector;

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

$show = new Sensorario\Biberon\Show(
    $detector,
    (new Sensorario\Biberon\Stat())->init([
        'count' => count($data),
        'column' => 0,
        'print' => 0,
        'columnsize' => 48,
    ])
);

while ($show->mustGoOn()) {
    $show->next(function() {
        return rand(11111, 99999);
    });
}
```
