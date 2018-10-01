<?php

namespace Sensorario\Biberon\Strategy;

use Sensorario\Biberon\Stat;

class CounterIncrement implements StepStrategy
{
    private $started = false;

    private $counter = 0;

    public function __construct(Stat $stat)
    {
        $this->stat = $stat;
    }

    public function isFirstStep()
    {
        $this->started == false;
    }

    public function init()
    {
        $this->counter = 0;
        $this->started = true;
    }

    public function step()
    {
        $this->counter++;
    }

    public function wasLastStep()
    {
        return $this->counter < $this->stat->get('count');
    }

    public function getCurrent()
    {
        return $this->counter;
    }
}
