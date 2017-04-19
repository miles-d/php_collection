<?php
namespace Milesd\Collection\Test;

use PHPUnit\Framework\TestCase;
use function Milesd\Collection\collect;

class SideEffectsTest extends TestCase
{
    public function testEach()
    {
        $affected = 1;
        collect([1, 2, 3])->each(function ($x) use (&$affected) {
            $affected += $x;
        });
        $this->assertSame(7, $affected);
    }

    public function testStep()
    {
        $affected = 1;
        collect([1, 2, 3, 4, 5, 6])->step(function ($x) use (&$affected) {
            $affected += $x;
        }, 2);
        $this->assertSame(10, $affected);

        $affected = 1;
        collect([1, 2, 3, 4, 5, 6])->step(function ($x) use (&$affected) {
            $affected += $x;
        }, 3);
        $this->assertSame(6, $affected);
    }

    public function testStepWithInitialStep()
    {
        $affected = 1;
        collect([1, 2, 3, 4, 5, 6])->step(function ($x) use (&$affected) {
            $affected += $x;
        }, 2, 1);
        $this->assertSame(13, $affected);
    }
}
