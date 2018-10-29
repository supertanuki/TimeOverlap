# TimeOverlap

Time overlap utilities

## Overlap

To test that two periods of time overlap:

```
[ one ]
   [ another ]

or

        [ one ]
[ another ]

or

[ one ]
[ another ]

or

    [ one ]
[ another ]

or

[     one     ]
  [ another ]
  

or

     [one]
  [ another ]
```

```php
use Supertanuki\TimeOverlap\TimeOverlap;
use Supertanuki\TimeOverlap\TimeRangeView;

TimeOverlap::overlap(
    new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
    new TimeRangeView(new \DateTime('2018-10-29 09:30:00'), new \DateTime('2018-10-29 11:00:00'))
);
// will return true

TimeOverlap::overlap(
    new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 11:00:00')),
    new TimeRangeView(new \DateTime('2018-10-29 10:00:00'), new \DateTime('2018-10-29 10:35:00'))
);
// will return true

TimeOverlap::overlap(
    new TimeRangeView(new \DateTime('2018-10-29 10:00:00'), new \DateTime('2018-10-29 11:00:00')),
    new TimeRangeView(new \DateTime('2018-10-29 11:05:00'), new \DateTime('2018-10-29 12:00:00'))
);
// will return false
```

## Touch

To test that two periods of time are contiguous:

```
[one]
    [another]

or

[another]
        [one]
```

```php
use Supertanuki\TimeOverlap\TimeOverlap;
use Supertanuki\TimeOverlap\TimeRangeView;

TimeOverlap::touch(
    new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00')),
    new TimeRangeView(new \DateTime('2018-10-29 10:00:00'), new \DateTime('2018-10-29 11:00:00'))
);
// will return true

TimeOverlap::touch(
    new TimeRangeView(new \DateTime('2018-10-29 10:00:00'), new \DateTime('2018-10-29 11:00:00')),
    new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00'))
);
// will return true

TimeOverlap::touch(
    new TimeRangeView(new \DateTime('2018-10-29 10:00:00'), new \DateTime('2018-10-29 11:00:00')),
    new TimeRangeView(new \DateTime('2018-10-29 11:05:00'), new \DateTime('2018-10-29 12:00:00'))
);
// will return false
```

## Create a period of time

Use TimeRangeView:

```php
use Supertanuki\TimeOverlap\TimeRangeView;

new TimeRangeView(new \DateTime('2018-10-29 09:00:00'), new \DateTime('2018-10-29 10:00:00'));
```

or create your own class implementing `Supertanuki\TimeOverlap\TimeRangeInterface`
