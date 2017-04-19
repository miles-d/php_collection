<?php
namespace Milesd\Collection\Test;

use PHPUnit\Framework\TestCase;
use function Milesd\Collection\collect;

class PredicatesTest extends TestCase
{
    public function setUp()
    {
        $this->even = function ($x) {
            return $x % 2 == 0;
        };
    }

    public function testEvery()
    {
        $this->even = function ($x) {
            return $x % 2 == 0;
        };
        $this->assertFalse(collect([1, 2, 3])->every($this->even));
        $this->assertTrue(collect([2, 4, 6])->every($this->even));
    }

    public function testSome()
    {
        $this->even = function ($x) {
            return $x % 2 == 0;
        };
        $this->assertFalse(collect([1, 3, 5])->some($this->even));
        $this->assertTrue(collect([2, 3, 5])->some($this->even));
    }

    public function testEveryOnEmptyIsTrue()
    {
        $this->assertTrue(collect([])->every(function ($x) {
            return $x % 2 == 0;
        }));
    }

    public function testSomeOnEmptyIsFalse()
    {
        $this->assertFalse(collect([])->some(function ($x) {
            return $x % 2 == 0;
        }));
    }

    public function testNone()
    {
        $this->assertTrue(collect([1, 3, 5])->none($this->even));
        $this->assertFalse(collect([2, 3, 5])->none($this->even));
    }
}
