<?php

namespace Sensorario\Biberon;

class Stat
{
    private $alreadyInitialized = false;

    private $params;

    public function init($params)
    {
        if (!$this->alreadyInitialized) {
            $this->params = $params;
        }

        $this->alreadyInitialized = !$this->alreadyInitialized;
    }

    public function alreadyInitialized()
    {
        return $this->alreadyInitialized;
    }

    public function isEndOfLine()
    {
        return
            $this->params['column'] > 0
            && $this->params['column'] % $this->params['columnsize'] == 0;
    }

    public function isFirstLine()
    {
        return $this->params['print'] <= $this->params['columnsize'];
    }

    public function resetColumnCounter()
    {
        $this->params['column'] = 0;
    }

    public function updateCounters()
    {
        $this->params['print']++;
        $this->params['column']++;
    }

    public function get($key)
    {
        return $this->params[$key];
    }

    public function echoEndOfLine()
    {
        $output = "(" . $this->get('print') . "/" . $this->get('count') . ") \n";
        echo str_pad($output, 13, " ", STR_PAD_LEFT);
    }

    public function step()
    {
        if ($this->isEndOfLine()) {
            $this->echoEndOfLine();
            $this->resetColumnCounter();
        } else {
            $this->updateCounters();
        }
    }
}
