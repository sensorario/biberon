<?php

namespace Sensorario\Biberon;

use Sensorario\Biberon\Strategy\StepStrategy;

class Detector
{
    private $dictionary = [];

    private $colors = [];

    public function setColors(array $colors)
    {
        $this->colors = $colors;

        return $this;
    }

    public function setDictionary(array $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function echoDetection($item, Strategy\StepStrategy $strategy)
    {
        echo $this->dot($item, $strategy);
    }

    public function dot($item, Strategy\StepStrategy $strategy)
    {
        foreach ($this->dictionary as $echo => $check) {
            $foo = is_callable($item)
                ? $item()
                : $item;

            if ($check($foo, $strategy)) {
                if (isset($this->colors[$echo])) {
                    return $this->colors[$echo] . $echo . "\033[0m";
                } else {
                    return $echo;
                }
                return;
            }
        }

        return '.';
    }

    public function addRules(array $dictionary)
    {
        $this->dictionary = $dictionary;

        return $this;
    }
}

