<?php

namespace Sensorario\Biberon\Strategy;

use Sensorario\Biberon\Stat;

class CounterIncrement implements StepStrategy
{
    private $started = false;

    private $couter = 0;

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
        $this->couter = 0;
        $this->started = true;
    }

    public function step()
    {
        $this->couter++;
    }

    public function wasLastStep()
    {
        return $this->couter < $this->stat->get('count');
    }
}
