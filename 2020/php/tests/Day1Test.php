<?php

declare(strict_types=1);

namespace Tests;

use AoC2020\Day1;
use PHPUnit\Framework\TestCase;

/**
 * Class Day1Test
 */
final class Day1Test extends TestCase
{
    /** @covers Day1::part1 */
    public function testExampleInputPart1(): void
    {
        Day1Test::assertEquals(
            514579,
            (new Day1())->part1(__DIR__ . '/inputs/day_01_example_input.txt')
        );
    }

    /** @covers Day1::part2 */
    public function testExampleInputPart2(): void
    {
        Day1Test::assertEquals(
            241861950,
            (new Day1())->part2(__DIR__ . '/inputs/day_01_example_input.txt')
        );
    }

    /** @covers Day1::part1 */
    public function testRealInputPart1(): void
    {
        Day1Test::assertEquals(
            870331,
            (new Day1())->part1(__DIR__ . '/inputs/day_01_input.txt')
        );
    }

    /** @covers Day1::part1 */
    public function testRealInputPart2(): void
    {
        Day1Test::assertEquals(
            283025088,
            (new Day1())->part2(__DIR__ . '/inputs/day_01_input.txt')
        );
    }
}
