<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use AoC2020\Day1;
use AoC2020\Day2;
use AoC2020\Day3;
use AoC2020\Day4;
use AoC2020\Day5;
use AoC2020\Day6;
use AoC2020\Day7;
use AoC2020\Day8;

echo 'Day 1 Part 1: ' . (new Day1())->part1(__DIR__ . '/../tests/inputs/day_01_input.txt') . PHP_EOL;
echo 'Day 1 Part 2: ' . (new Day1())->part2(__DIR__ . '/../tests/inputs/day_01_input.txt') . PHP_EOL;
echo 'Day 2 Part 1: ' . (new Day2())->part1(__DIR__ . '/../tests/inputs/day_02_input.txt') . PHP_EOL;
echo 'Day 2 Part 2: ' . (new Day2())->part2(__DIR__ . '/../tests/inputs/day_02_input.txt') . PHP_EOL;
echo 'Day 3 Part 1: ' . (new Day3())->part1(__DIR__ . '/../tests/inputs/day_03_input.txt') . PHP_EOL;
echo 'Day 3 Part 2: ' . (new Day3())->part2(__DIR__ . '/../tests/inputs/day_03_input.txt') . PHP_EOL;
echo 'Day 4 Part 1: ' . (new Day4())->part1(__DIR__ . '/../tests/inputs/day_04_input.txt') . PHP_EOL;
echo 'Day 4 Part 2: ' . (new Day4())->part2(__DIR__ . '/../tests/inputs/day_04_input.txt') . PHP_EOL;
echo 'Day 5 Part 1: ' . (new Day5())->part1(__DIR__ . '/../tests/inputs/day_05_input.txt') . PHP_EOL;
echo 'Day 5 Part 2: ' . (new Day5())->part2(__DIR__ . '/../tests/inputs/day_05_input.txt') . PHP_EOL;
echo 'Day 6 Part 1: ' . (new Day6())->part1(__DIR__ . '/../tests/inputs/day_06_input.txt') . PHP_EOL;
echo 'Day 6 Part 2: ' . (new Day6())->part2(__DIR__ . '/../tests/inputs/day_06_input.txt') . PHP_EOL;
echo 'Day 7 Part 1: ' . (new Day7())->part1(__DIR__ . '/../tests/inputs/day_07_input.txt') . PHP_EOL;
echo 'Day 7 Part 2: ' . (new Day7())->part2(__DIR__ . '/../tests/inputs/day_07_input.txt') . PHP_EOL;
echo 'Day 8 Part 1: ' . (new Day8())->part1(__DIR__ . '/../tests/inputs/day_08_input.txt') . PHP_EOL;
echo 'Day 8 Part 2: ' . (new Day8())->part2(__DIR__ . '/../tests/inputs/day_08_input.txt') . PHP_EOL;
