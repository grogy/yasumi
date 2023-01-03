<?php

declare(strict_types=1);

namespace spec\Yasumi;

use PhpSpec\ObjectBehavior;
use Yasumi\DateTimeSpan;
use Yasumi\Exception\InvalidDateTimeSpanException;

final class DateTimeSpanSpec extends ObjectBehavior
{
    private const FORMAT = 'c';

    public function let(): void
    {
        $this->beConstructedWith(new \DateTimeImmutable('2000-01-01'), new \DateTimeImmutable('2023-12-31'));
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DateTimeSpan::class);
    }

    public function it_can_be_representated_as_a_string(): void
    {
        $this->shouldImplement(\Stringable::class);
        $this->__toString()->shouldBe('2000-01-01T00:00:00+00:00 - 2023-12-31T00:00:00+00:00');
    }

    public function it_can_be_representated_as_an_array(): void
    {
        $this->toArray()->shouldBe(
            [
              'start' => '2000-01-01T00:00:00+00:00',
              'end' => '2023-12-31T00:00:00+00:00',
            ]
        );
    }

    public function it_can_get_the_start_date(): void
    {
        $this->getStart()->shouldBeLike(new \DateTimeImmutable('2000-01-01 00:00:00'));
    }

    public function it_can_get_the_end_date(): void
    {
        $this->getEnd()->shouldBeLike(new \DateTimeImmutable('2023-12-31 00:00:00'));
    }

    public function it_should_throw_an_exception_when_start_date_preceeds_lower_bound(): void
    {
        $start = new \DateTimeImmutable('843-01-01');
        $this->beConstructedWith($start, new \DateTimeImmutable('2024-12-05'));

        $this->shouldThrow(
            new InvalidDateTimeSpanException(sprintf('start date needs to be 1000-01-01 or later (%s given)', $start->format(self::FORMAT)))
        )->duringInstantiation();
    }

    public function it_should_throw_an_exception_when_end_date_exceeds_upper_bound(): void
    {
        $end = (new \DateTimeImmutable('9999-12-31'))->add(new \DateInterval('P5D'));

        $this->beConstructedWith(new \DateTimeImmutable('2019-01-01'), $end);

        $this->shouldThrow(
            new InvalidDateTimeSpanException(sprintf('end date needs to be 9999-12-31 or earlier (%s given)', $end->format(self::FORMAT)))
        )->duringInstantiation();
    }

    public function it_should_throw_an_exception_when_start_date_exceeds_end_date()
    {
        $this->beConstructedWith(new \DateTimeImmutable('3022-08-12'), new \DateTimeImmutable('2089-02-22'));

        $this->shouldThrow(
            new InvalidDateTimeSpanException('end date must be after start date')
        )->duringInstantiation();
    }
}
