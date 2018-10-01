<?php

namespace Sensorario\Biberon;

class Show
{
    private $detector;

    private $stat;

    private $strategy;

    public function __construct(
        Detector $detector,
        /** @todo remove stat */
        Stat $stat
        /** @todo pass strategy */
    ) {
        $this->detector = $detector;
        $this->stat = $stat;
        $this->strategy = new Strategy\CounterIncrement($this->stat);
        //$this->strategy = new Strategy\DayIncrement(
            //$this->stat,
            //new \DateTime('-40 days'),
            //new \DateTime('yesterday')
        //);

        /** @todo extract stat from the strategy */
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
