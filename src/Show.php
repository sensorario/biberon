<?php

namespace Sensorario\Biberon;

class Show
{
    private $detector;

    private $stat;

    private $started = false;

    private $couter = 0;

    public function __construct(
        Detector $detector,
        Stat $stat
    ) {
        $this->detector = $detector;
        $this->stat = $stat;
    }

    public function next($item)
    {
        echo $this->detector->dot($item);
        $this->stat->step();
    }

    public function mustGoOn()
    {
        if ($this->started == false) {
            $this->couter = 0;
            $this->started = true;
        }

        $this->couter++;

        return $this->couter < $this->stat->get('count');
    }
}
