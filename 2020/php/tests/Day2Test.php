<?php

declare(strict_types=1);

namespace Tests;

use AoC2020\Day2;
use PHPUnit\Framework\TestCase;

/**
 * Class Day2Test
 */
final class Day2Test extends TestCase
{
    /** @covers Day2::part1 */
    public function testExampleInputPart1(): void
    {
        Day2Test::assertEquals(
            2,
            (new Day2())->part1(__DIR__ . '/inputs/day_02_example_input.txt')
        );
    }

    /** @covers Day2::part2 */
    public function testExampleInputPart2(): void
    {
        Day2Test::assertEquals(
            1,
            (new Day2())->part2(__DIR__ . '/inputs/day_02_example_input.txt')
        );
    }

    /** @covers Day2::part1 */
    public function testRealInputPart1(): void
    {
        Day2Test::assertEquals(
            500,
            (new Day2())->part1(__DIR__ . '/inputs/day_02_input.txt')
        );
    }

    /** @covers Day2::part1 */
    public function testRealInputPart2(): void
    {
        Day2Test::assertEquals(
            313,
            (new Day2())->part2(__DIR__ . '/inputs/day_02_input.txt')
        );
    }
}
