<?php
namespace Milesd\Collection;

class Collection
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function map($callback)
    {
        $result = array_map($callback, $this->items);
        return new self($result);
    }

    public function filter($callback)
    {
        $filtered = array_values(array_filter($this->items, $callback));
        return new self($filtered);
    }

    public function reduce($callback, $initial = 0)
    {
        return array_reduce($this->items, $callback, $initial);
    }



    // zero-based
    public function nth($index)
    {
        if (!isset($this->items[$index])) {
            return null;
        }
        return $this->items[$index];
    }

    public function get()
    {
        return $this->items;
    }

    public function all()
    {
        if (empty($this->items)) {
            return null;
        }
        return $this->get();
    }

    public function first()
    {
        return $this->nth(0);
    }

    public function second()
    {
        return $this->nth(1);
    }

    public function rest()
    {
        $rest = $this->items;
        array_shift($rest);
        return collect($rest);
    }

    public function last()
    {
        return $this->nth(count($this->items) - 1);
    }


    public function every($callback)
    {
        foreach ($this->items as $item) {
            if (!$callback($item)) {
                return false;
            }
        }
        return true;
    }

    public function some($callback)
    {
        foreach ($this->items as $item) {
            if ($callback($item)) {
                return true;
            }
        }
        return false;
    }

    public function none($callback)
    {
        return !$this->some($callback);
    }


    public function each($callback)
    {
        $this->step($callback, 1);
    }

    public function step($callback, $step, $initialStep = 0)
    {
        for ($i = $initialStep; $i < count($this->items); $i += $step) {
            $callback($this->items[$i]);
        }
    }
}

function collect($ary)
{
    return new Collection($ary);
}
