<?php

namespace Sensorario\Tests\Biberon;

use PHPUnit\Framework\TestCase;
use Sensorario\Biberon\Stat;


class StatShould extends TestCase
{
    public function testNotBeInitializedOnceCreated()
    {
        $stat = new Stat();
        $this->assertSame(false, $stat->alreadyInitialized());
    }

    public function testInitOnce()
    {
        $stat = new Stat();
        $stat->init([]);
        $this->assertSame(true, $stat->alreadyInitialized());
    }

    public function testDetectIsNotEndOfLineReadingPrintParameter()
    {
        $stat = new Stat();
        $stat->init([
            'column' => 0,
        ]);
        $this->assertSame(false, $stat->isEndOfLine());
    }

    public function testDetectEndOfLine()
    {
        $stat = new stat();
        $stat->init([
            'column' => 9,
            'columnsize' => 10,
        ]);
        $this->assertsame(true, $stat->isEndOfLine());
    }

    public function testDetectIsFirstLine()
    {
        $stat = new stat();
        $stat->init([
            'column' => 0,
            'columnsize' => 3,
            'print' => 2,
        ]);
        $this->assertsame(true, $stat->isFirstLine());
    }

    public function testDetectIsNoMoreFirstLine()
    {
        $stat = new stat();
        $stat->init([
            'column' => 0,
            'columnsize' => 10,
            'print' => 11,
        ]);
        $this->assertsame(false, $stat->isFirstLine());
    }

    public function testResetColumnCounterToZero()
    {
        $stat = new stat();
        $stat->init([
            'column' => 3,
            'columnsize' => 9,
            'print' => 7,
        ]);
        $this->assertEquals(3, $stat->get('column'));

        $stat->resetColumnCounter();
        $this->assertEquals(0, $stat->get('column'));
    }

    public function testUpdatePrintAndColumnCounters()
    {
        $stat = new stat();
        $stat->init([
            'column' => $column = 3,
            'print' => $print = 7,
        ]);

        $this->assertEquals(3, $stat->get('column'));
        $this->assertEquals(7, $stat->get('print'));

        $stat->updateCounters();

        $this->assertEquals(4, $stat->get('column'));
        $this->assertEquals(8, $stat->get('print'));
    }

    public function testEchoesEndOfLine()
    {
        $stat = new stat();
        $stat->init([
            'count' => 1000,
            'column' => 3,
            'print' => 7,
            'columnsize' => 42
        ]);

        ob_start();
        $stat->echoEndOfLine();
        $output = ob_get_clean();

        $this->assertEquals("  (42/1000) \n", $output);
    }

    public function testEchoesEndOfLineAfterFirstLine()
    {
        $stat = new stat();
        $stat->init([
            'count' => 1000,
            'column' => 3,
            'print' => 100,
            'columnsize' => 42
        ]);

        ob_start();
        $stat->echoEndOfLine();
        $output = ob_get_clean();

        $this->assertEquals("  (42/1000) \n", $output);
    }
}
