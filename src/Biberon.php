<?php

namespace Sensorario\Biberon;

class Biberon
{
    private $data = [];

    private $detector;

    private $stat;

    public function __construct(
        array $data = [],
        Detector $detector,
        Stat $stat
    ) {
        $this->data = $data;
        $this->detector = $detector;
        $this->stat = $stat;

        $this->stat->init([
            'count' => count($this->data),
            'column' => 0,
            'print' => 0,
            'columnsize' => 100,
        ]);
    }

    private function getData()
    {
        return $this->data;
    }

    public function bar()
    {
        foreach ($this->getData() as $item) {
            usleep(1000);
            $this->detector->echoDetection($item);

            if ($this->stat->isEndOfLine()) {
                $this->stat->echoEndOfLine();
                $this->stat->resetColumnCounter();
            } else {
                $this->stat->updateCounters();
            }
        }
    }
}

