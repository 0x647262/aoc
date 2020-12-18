<?php

declare(strict_types=1);

namespace Tests;

use AoC2020\Day6;
use PHPUnit\Framework\TestCase;

/**
 * Class Day4Test
 */
final class Day6Test extends TestCase
{
    /** @covers Day4::part1 */
    public function testExampleInputPart1(): void
    {
        Day6Test::assertEquals(
            11,
            (new Day6())->part1(__DIR__ . '/inputs/day_06_example_input.txt')
        );
    }

    /** @covers Day6::part1 */
    public function testRealInputPart1(): void
    {
        Day6Test::assertEquals(
            6809,
            (new Day6())->part1(__DIR__ . '/inputs/day_06_input.txt')
        );
    }

    /** @covers Day4::part2 */
    public function testExampleInputPart2(): void
    {
        Day6Test::assertEquals(
            6,
            (new Day6())->part2(__DIR__ . '/inputs/day_06_example_input.txt')
        );
    }

    /** @covers Day6::part2 */
    public function testRealInputPart2(): void
    {
        Day6Test::assertEquals(
            3394,
            (new Day6())->part2(__DIR__ . '/inputs/day_06_input.txt')
        );
    }
}
