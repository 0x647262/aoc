<?php

declare(strict_types=1);

namespace Tests;

use AoC2020\Day5;
use PHPUnit\Framework\TestCase;

/**
 * Class Day5Test
 */
final class Day5Test extends TestCase
{
    /** @covers Day5::part1 */
    public function testExampleInputPart1(): void
    {
        Day5Test::assertEquals(
            820,
            (new Day5())->part1(__DIR__ . '/inputs/day_05_example_input.txt')
        );
    }

    /** @covers Day5::part1 */
    public function testRealInputPart1(): void
    {
        Day5Test::assertEquals(
            904,
            (new Day5())->part1(__DIR__ . '/inputs/day_05_input.txt')
        );
    }

    /** @covers Day5::part2 */
    public function testRealInputPart2(): void
    {
        Day5Test::assertEquals(
            669,
            (new Day5())->part2(__DIR__ . '/inputs/day_05_input.txt')
        );
    }
}
