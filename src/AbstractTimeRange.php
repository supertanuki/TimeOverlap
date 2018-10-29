<?php

namespace Supertanuki\TimeOverlap;

abstract class AbstractTimeRange implements TimeRangeInterface
{
    /** @var \DateTimeInterface */
    public $begin;

    /** @var \DateTimeInterface */
    public $end;

    public function __construct(\DateTimeInterface $begin, \DateTimeInterface $end)
    {
        $this->begin = $begin;
        $this->end = $end;
    }

    public function getBegin(): \DateTimeInterface
    {
        return $this->begin;
    }

    public function getEnd(): \DateTimeInterface
    {
        return $this->end;
    }

    public function merge(AbstractTimeRange $abstractTimeRange): void
    {
        $this->begin = TimeOverlap::floor($this->begin, $abstractTimeRange->begin);
        $this->end = TimeOverlap::ceil($this->end, $abstractTimeRange->end);

        if ($this->end < $this->begin) {
            $this->end = $this->begin;
        }
    }
}
