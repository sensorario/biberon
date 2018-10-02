<?php

namespace Sensorario\Biberon;

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

    public function echoDetection($item)
    {
        echo $this->dot($item);
    }

    public function dot($item)
    {
        foreach ($this->dictionary as $echo => $check) {
            $foo = is_callable($item)
                ? $item()
                : $item;

            if ($check($foo)) {
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

