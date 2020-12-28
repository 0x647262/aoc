<?php

declare(strict_types=1);

namespace Tests;

use AoC2020\Day8;
use PHPUnit\Framework\TestCase;

/**
 * Class Day8Test
 */
final class Day8Test extends TestCase
{
    /** @covers Day8::part1 */
    public function testExampleInputPart1(): void
    {
        Day8Test::assertEquals(
            5,
            (new Day8())->part1(__DIR__ . '/inputs/day_08_example_input.txt')
        );
    }

    /** @covers Day8::part1 */
    public function testRealInputPart1(): void
    {
        Day8Test::assertEquals(
            1709,
            (new Day8())->part1(__DIR__ . '/inputs/day_08_input.txt')
        );
    }

    /** @covers Day8::part2 */
    public function testExampleInputPart2(): void
    {
        Day8Test::assertEquals(
            8,
            (new Day8())->part2(__DIR__ . '/inputs/day_08_example_input.txt')
        );
    }

    /** @covers Day8::part2 */
    public function testRealInputPart2(): void
    {
        Day8Test::assertEquals(
            1976,
            (new Day8())->part2(__DIR__ . '/inputs/day_08_input.txt')
        );
    }
}
