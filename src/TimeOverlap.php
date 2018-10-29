<?php

namespace Supertanuki\TimeOverlap;

final class TimeOverlap
{
    /**
     * [  haystack  ]
     *   [ needle ]
     *
     * or
     *
     * [  haystack  ]
     * [ needle ]
     *
     * or
     *
     * [  haystack  ]
     *     [ needle ]
     */
    public static function contains(TimeRangeInterface $needle, TimeRangeInterface $haystack): bool
    {
        return $haystack->getBegin() <= $needle->getBegin() && $needle->getEnd() <= $haystack->getEnd();
    }

    /**
     * [ haystack  ]
     *   [ needle ]
     *
     * or
     *
     * [  haystack  ]
     * [ needle ]
     *
     * or
     *
     * [  haystack  ]
     *    [   needle   ]
     */
    public static function beginIn(TimeRangeInterface $needle, TimeRangeInterface $haystack): bool
    {
        return $haystack->getBegin() <= $needle->getBegin() && $needle->getBegin() < $haystack->getEnd();
    }

    /**
     * [  haystack  ]
     *   [ needle ]
     *
     * or
     *
     *   [  haystack  ]
     * [ needle ]
     *
     * or
     *
     *   [  haystack  ]
     * [   needle     ]
     */
    public static function endIn(TimeRangeInterface $needle, TimeRangeInterface $haystack): bool
    {
        return $haystack->getBegin() < $needle->getEnd() && $needle->getEnd() <= $haystack->getEnd();
    }

    /**
     * one of the examples of beginIn, endIn or contains methods
     */
    public static function overlap(TimeRangeInterface $one, TimeRangeInterface $another): bool
    {
        return self::beginIn($one, $another)
            || self::endIn($one, $another)
            || self::contains($another, $one)
        ;
    }

    /**
     * [one]
     *     [another]
     *
     * or
     *
     * [another]
     *         [one]
     */
    public static function touch(TimeRangeInterface $one, TimeRangeInterface $another): bool
    {
        return $one->getEnd() == $another->getBegin()
            || $one->getBegin() == $another->getEnd();
    }
}
