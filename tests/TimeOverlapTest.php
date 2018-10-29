<?php

namespace Supertanuki\TimeOverlap\Tests;

use PHPUnit\Framework\TestCase;
use Supertanuki\TimeOverlap\TimeOverlap;
use Supertanuki\TimeOverlap\TimeRangeView;

class TimeOverlapTest extends TestCase
{
    public function test_contains()
    {
        $this->assertTrue(TimeOverlap::contains(
            new TimeRangeView(new \DateTime('2018-10-29 16:52:00'), new \DateTime('2018-10-29 16:53:00')),
            new TimeRangeView(new \DateTime('2018-10-29 16:50:00'), new \DateTime('2018-10-29 17:00:00'))
        ));

        $this->assertTrue(TimeOverlap::contains(
            new TimeRangeView(new \DateTime('2018-10-29 16:52:00'), new \DateTime('2018-10-29 16:53:00')),
            new TimeRangeView(new \DateTime('2018-10-29 16:52:00'), new \DateTime('2018-10-29 16:53:00'))
        ));

        $this->assertFalse(TimeOverlap::contains(
            new TimeRangeView(new \DateTime('2018-10-29 16:00:00'), new \DateTime('2018-10-29 16:55:00')),
            new TimeRangeView(new \DateTime('2018-10-29 16:50:00'), new \DateTime('2018-10-29 17:00:00'))
        ));
    }

    public function test_begin_in()
    {
        $this->assertTrue(TimeOverlap::beginIn(
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
            new TimeRangeView(new \DateTime('2018-10-29 08:55:00'), new \DateTime('2018-10-29 09:30:00'))
        ));

        $this->assertTrue(TimeOverlap::beginIn(
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
            new TimeRangeView(new \DateTime('2018-10-29 08:55:00'), new \DateTime('2018-10-29 11:00:00'))
        ));

        $this->assertTrue(TimeOverlap::beginIn(
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 11:00:00'))
        ));

        $this->assertTrue(TimeOverlap::beginIn(
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00'))
        ));

        $this->assertFalse(TimeOverlap::beginIn(
            new TimeRangeView(new \DateTime('2018-10-29 08:55:00'), new \DateTime('2018-10-29 09:30:00')),
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00'))
        ));
    }

    public function test_end_in()
    {
        $this->assertTrue(TimeOverlap::endIn(
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
            new TimeRangeView(new \DateTime('2018-10-29 08:55:00'), new \DateTime('2018-10-29 11:00:00'))
        ));

        $this->assertTrue(TimeOverlap::endIn(
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 11:00:00'))
        ));

        $this->assertTrue(TimeOverlap::endIn(
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00'))
        ));

        $this->assertTrue(TimeOverlap::endIn(
            new TimeRangeView(new \DateTime('2018-10-29 08:55:00'), new \DateTime('2018-10-29 09:30:00')),
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00'))
        ));

        $this->assertFalse(TimeOverlap::endIn(
            new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
            new TimeRangeView(new \DateTime('2018-10-29 08:55:00'), new \DateTime('2018-10-29 09:30:00'))
        ));
    }

    public function test_overlap()
    {
        $this->assertTrue(
            TimeOverlap::overlap(
                new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
                new TimeRangeView(new \DateTime('2018-10-29 09:20:00'), new \DateTime('2018-10-29 09:40:00'))
            )
        );

        $this->assertTrue(
            TimeOverlap::overlap(
                new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
                new TimeRangeView(new \DateTime('2018-10-29 08:00:00'), new \DateTime('2018-10-29 11:00:00'))
            )
        );

        $this->assertTrue(
            TimeOverlap::overlap(
                new TimeRangeView(new \DateTime('2018-10-29 08:00:00'), new \DateTime('2018-10-29 11:00:00')),
                new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00'))
            )
        );

        $this->assertTrue(
            TimeOverlap::overlap(
                new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
                new TimeRangeView(new \DateTime('2018-10-29 08:30:00'), new \DateTime('2018-10-29 09:05:00'))
            )
        );

        $this->assertFalse(
            TimeOverlap::overlap(
                new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
                new TimeRangeView(new \DateTime('2018-10-29 10:00:00'), new \DateTime('2018-10-29 11:00:00'))
            )
        );

        $this->assertFalse(
            TimeOverlap::overlap(
                new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
                new TimeRangeView(new \DateTime('2018-10-29 10:01:00'), new \DateTime('2018-10-29 11:00:00'))
            )
        );
    }

    public function test_touch()
    {
        $this->assertTrue(
            TimeOverlap::touch(
                new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
                new TimeRangeView(new \DateTime('2018-10-29 10:00:00'), new \DateTime('2018-10-29 11:00:00'))
            )
        );

        $this->assertTrue(
            TimeOverlap::touch(
                new TimeRangeView(new \DateTime('2018-10-29 10:00:00'), new \DateTime('2018-10-29 11:00:00')),
                new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00'))
            )
        );

        $this->assertFalse(
            TimeOverlap::touch(
                new TimeRangeView(new \DateTime('2018-10-29 10:00:00'), new \DateTime('2018-10-29 11:00:00')),
                new TimeRangeView(new \DateTime('2018-10-29 11:05:00'), new \DateTime('2018-10-29 12:00:00'))
            )
        );
    }
}
