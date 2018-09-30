# Biberon

[![Build Status](https://travis-ci.org/sensorario/biberon.svg?branch=master)](https://travis-ci.org/sensorario/biberon)

![biberon_microtime.png](biberon_microtime.png)
![biberon2.png](biberon2.png)

## Example

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
