<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use AoC2020\Day1;
use AoC2020\Day2;

echo 'Day 1 Part 1: ' . (new Day1())->part1(__DIR__ . '/tests/inputs/day_01_input.txt') . PHP_EOL;
echo 'Day 1 Part 1: ' . (new Day1())->part2(__DIR__ . '/tests/inputs/day_01_input.txt') . PHP_EOL;
echo 'Day 1 Part 2: ' . (new Day2())->part1(__DIR__ . '/tests/inputs/day_02_input.txt') . PHP_EOL;
echo 'Day 1 Part 2: ' . (new Day2())->part2(__DIR__ . '/tests/inputs/day_02_input.txt') . PHP_EOL;
