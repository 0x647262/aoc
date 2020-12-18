<?php

declare(strict_types=1);

namespace Tests;

use AoC2020\Day4;
use PHPUnit\Framework\TestCase;

/**
 * Class Day4Test
 */
final class Day4Test extends TestCase
{
    /** @covers Day4::part1 */
    public function testExampleInputPart1(): void
    {
        Day4Test::assertEquals(
            2,
            (new Day4())->part1(__DIR__ . '/inputs/day_04_example_input_part1.txt')
        );
    }

    /** @covers Day4::part2 */
    public function testExampleInputPart2(): void
    {
        Day4Test::assertEquals(
            4,
            (new Day4())->part2(__DIR__ . '/inputs/day_04_example_input_part2.txt')
        );
    }

    /** @covers Day4::part1 */
    public function testRealInputPart1(): void
    {
        Day4Test::assertEquals(
            254,
            (new Day4())->part1(__DIR__ . '/inputs/day_04_input.txt')
        );
    }

    /** @covers Day4::part2 */
    public function testRealInputPart2(): void
    {
        Day4Test::assertEquals(
            184,
            (new Day4())->part2(__DIR__ . '/inputs/day_04_input.txt')
        );
    }
}
