<?php

namespace Sensorario\Biberon;

class Detector
{
    const COLOR_GREEN = "\033[0;32m";
    const COLOR_RED = "\033[0;31m";
    const COLOR_VIOLET = "\033[0;36m";
    const COLOR_RESET = "\033[0m";

    private $dictionary = [];

    private $colors = [];

    public function setColors(array $colors)
    {
        $this->colors = $colors;
    }

    public function setDictionary(array $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function echoDetection($item)
    {
        foreach ($this->dictionary as $echo => $check) {
            if ($check($item)) {
                if (isset($this->colors[$echo])) {
                    echo $this->colors[$echo] . $echo . "\033[0m";
                } else {
                    echo $echo;
                }
                return;
            }
        }

        echo '.';
    }

    public function addRules(array $dictionary)
    {
        $this->dictionary = $dictionary;

        return $this;
    }
}

