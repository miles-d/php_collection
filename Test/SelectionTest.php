<?php
namespace Milesd\Collection\Test;

use PHPUnit\Framework\TestCase;
use function Milesd\Collection\collect;

class SelectionTest extends TestCase
{
    public function testAllIsLikeGet()
    {
        $result = collect([1, 2, 3])
            ->map(function ($x) {
                return $x * 10;
            });
        $this->assertSame([10, 20, 30], $result->all());
        $this->assertSame($result->get(), $result->all());
    }

    public function testFirst()
    {
        $first = collect([1, 2, 3])->first();
        $this->assertSame(1, $first);
    }

    public function testRest()
    {
        $rest = collect([1, 2, 3])->rest();
        $this->assertSame([2, 3], $rest->get());
    }

    public function testLast()
    {
        $this->assertSame(3, collect([1, 2, 3])->last());
    }

    public function testLastOnEmptyIsNull()
    {
        $this->assertNull(collect([])->last());
    }

    public function testFirstOnEmptyIsNull()
    {
        $this->assertNull(collect([])->first());
    }

    public function testAllOnEmptyIsNull()
    {
        $this->assertNull(collect([])->all());
    }

    public function testChainingMethods()
    {
        $result = collect([1, 2, 3, 4])
            ->rest()
            ->rest()
            ->first();
        $this->assertSame(3, $result);
    }

    public function testNth()
    {
        $this->assertSame(3, collect([1, 2, 3, 4])->nth(2));
    }

    public function testNthOnNotExistingIsNull()
    {
        $this->assertNull(collect([])->nth(0));
    }

    public function testSecond()
    {
        $this->assertSame(2, collect([1, 2, 3])->second());
    }
}
