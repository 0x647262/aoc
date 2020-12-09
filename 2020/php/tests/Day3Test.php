<?php

declare(strict_types=1);

namespace Tests;

use AoC2020\Day3;
use PHPUnit\Framework\TestCase;

/**
 * Class Day3Test
 */
final class Day3Test extends TestCase
{
    /** @covers Day3::part1 */
    public function testExampleInputPart1(): void
    {
        Day3Test::assertEquals(
            7,
            (new Day3())->part1(__DIR__ . '/inputs/day_03_example_input.txt')
        );
    }

    /** @covers Day3::part2 */
    public function testExampleInputPart2(): void
    {
        Day3Test::assertEquals(
            336,
            (new Day3())->part2(__DIR__ . '/inputs/day_03_example_input.txt')
        );
    }

    /** @covers Day3::part1 */
    public function testRealInputPart1(): void
    {
        Day3Test::assertEquals(
            299,
            (new Day3())->part1(__DIR__ . '/inputs/day_03_input.txt')
        );
    }

    /** @covers Day3::part1 */
    public function testRealInputPart2(): void
    {
        Day3Test::assertEquals(
            3621285278,
            (new Day3())->part2(__DIR__ . '/inputs/day_03_input.txt')
        );
    }
}
