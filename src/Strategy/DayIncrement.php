<?php

namespace Sensorario\Biberon\Strategy;

use Sensorario\Biberon\Stat;

class DayIncrement implements StepStrategy
{
    private $started = false;

    private $start;

    private $end;

    private $current;

    public function __construct(
        Stat $stat,
        \DateTime $start,
        \DateTime $end
    ) {
        $this->stat = $stat;
        $this->start = $start;
        $this->end = $end;
    }

    public function isFirstStep()
    {
        return $this->started == false;
    }

    public function init()
    {
        $this->current = $this->start;
        $this->started = true;
    }

    public function step()
    {
        $this->current->add(new \DateInterval('P1D'));
    }

    public function wasLastStep()
    {
        return $this->current->getTimestamp() < $this->end->getTimestamp();
    }

    public function getStat()
    {
        return $this->stat;
    }

    public function getCurrent()
    {
        return $this->current;
    }
}
