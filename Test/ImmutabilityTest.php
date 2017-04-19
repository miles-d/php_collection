<?php
namespace Milesd\Collection\Test;

use PHPUnit\Framework\TestCase;
use function Milesd\Collection\collect;

class ImmutabilityTest extends TestCase
{
    public function setUp()
    {
        $this->even = function ($x) {
            return $x % 2 == 0;
        };
    }

    public function testRestIsNotDestructive()
    {
        $collection = collect([1, 2, 3]);
        $this->assertSame($collection->rest()->get(), $collection->rest()->get());
    }

    public function testMapIsImmutable()
    {
        $original = [1, 2, 3];
        $collection = collect($original);
        $collection->map($this->even)->first();
        $this->assertSame($original, $collection->all());
    }
        
    public function testReduceIsImmutable()
    {
        $original = [1, 2, 3];
        $collection = collect($original);
        $collection->reduce(function ($x, $y) {
            return $x * $y;
        }, 1);
        $this->assertSame($original, $collection->all());
    }
    
    public function testFilterIsImmutable()
    {
        $original = [1, 2, 3];
        $collection = collect($original);
        $collection->filter($this->even);
        $this->assertSame($original, $collection->all());
    }
}
