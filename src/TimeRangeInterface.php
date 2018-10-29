<?php

namespace Supertanuki\TimeOverlap;

interface TimeRangeInterface
{
    /**
     * @return \DateTimeInterface
     */
    public function getBegin();

    /**
     * @return \DateTimeInterface
     */
    public function getEnd();
}
