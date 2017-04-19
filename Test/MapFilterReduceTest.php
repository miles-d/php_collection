<?php
namespace Milesd\Collection\Test;

use PHPUnit\Framework\TestCase;
use function Milesd\Collection\collect;

class MapFilterReduceTest extends TestCase
{
    public function testMap()
    {
        $ary = [1, 2, 3];
        $result = collect($ary)->map(function ($a) {
            return $a * 10;
        })->get();
        $this->assertSame([10, 20, 30], $result);
    }

    public function testFilter()
    {
        $ary = [1, 2, 3, 4];
        $odds = collect($ary)->filter(function ($a) {
            return $a % 2 != 0;
        })->get();
        $this->assertSame([1, 3], $odds);
    }

    public function testReduceSum()
    {
        $ary = [1, 2, 3];
        $sum = collect($ary)->reduce(function ($a, $b) {
            return $a + $b;
        });
        $this->assertSame(6, $sum);
    }

    public function testReduceProduct()
    {
        $ary = [1, 2, 3, 4];
        $product = collect($ary)->reduce(function ($a, $b) {
            return $a * $b;
        }, 1);
        $this->assertSame(24, $product);
    }

    public function testChaining()
    {
        $result = collect([1, 2, 3, 4, 5])
            ->filter(function ($x) {
                return $x < 4;
            })
            ->map(function ($x) {
                return $x * 10;
            })
            ->reduce(function ($x, $y) {
                return $x * $y;
            }, 1);

        $this->assertSame(10 * 20 * 30, $result);
    }
}
