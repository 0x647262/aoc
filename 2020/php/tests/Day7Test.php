<?php

declare(strict_types=1);

namespace Tests;

use AoC2020\Day7;
use PHPUnit\Framework\TestCase;

/**
 * Class Day7Test
 */
final class Day7Test extends TestCase
{
    /** @covers Day7::part1 */
    public function testExampleInputPart1(): void
    {
        Day7Test::assertEquals(
            4,
            (new Day7())->part1(__DIR__ . '/inputs/day_07_example_input_part1.txt')
        );
        Day7Test::assertEquals(
            0,
            (new Day7())->part1(__DIR__ . '/inputs/day_07_example_input_part2.txt')
        );
    }

    /** @covers Day7::part1 */
    public function testRealInputPart1(): void
    {
        Day7Test::assertEquals(
            224,
            (new Day7())->part1(__DIR__ . '/inputs/day_07_input.txt')
        );
    }

    /** @covers Day7::part2 */
    public function testExampleInputPart2(): void
    {
        Day7Test::assertEquals(
            32,
            (new Day7())->part2(__DIR__ . '/inputs/day_07_example_input_part1.txt')
        );
        Day7Test::assertEquals(
            126,
            (new Day7())->part2(__DIR__ . '/inputs/day_07_example_input_part2.txt')
        );
    }

    /** @covers Day7::part2 */
    public function testRealInputPart2(): void
    {
        Day7Test::assertEquals(
            1488,
            (new Day7())->part2(__DIR__ . '/inputs/day_07_input.txt')
        );
    }
}
