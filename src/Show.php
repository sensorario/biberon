<?php

namespace Sensorario\Biberon;

class Show
{
    private $detector;

    private $stat;

    private $strategy;

    public function __construct(
        Detector $detector,
        Strategy\StepStrategy $strategy
    ) {
        $this->detector = $detector;
        $this->strategy = $strategy;
        $this->stat = $this->strategy->getStat();
    }

    public function next($item)
    {
        $this->ensureStrategyIsDefined();

        echo $this->detector->dot(
            $item,
            $this->strategy
        );

        $this->stat->step();
    }

    public function mustGoOn()
    {
        $this->ensureStrategyIsDefined();

        if ($this->strategy->isFirstStep()) {
            $this->strategy->init();
        }

        $this->strategy->step();

        return $this->strategy->wasLastStep();
    }

    private function ensureStrategyIsDefined()
    {
        if (!$this->strategy) {
            throw new \RuntimeException(
                'Oops! Missing strategy'
            );
        }
    }
}
