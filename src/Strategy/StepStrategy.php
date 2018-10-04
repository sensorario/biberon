<?php

namespace Sensorario\Biberon\Strategy;

interface StepStrategy
{
    public function isFirstStep();
    public function init();
    public function step();
    public function wasLastStep();
    public function getStat();
}
