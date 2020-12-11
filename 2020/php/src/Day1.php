<?php

declare(strict_types=1);


namespace AoC2020;

/**
 * --- Day 1: Report Repair ---
 *
 * After saving Christmas five years in a row, you've decided to take a vacation at a nice resort on a tropical island.
 * Surely, Christmas will go on without you.
 *
 * The tropical island has its own currency and is entirely cash-only. The gold coins used there have a little picture
 * of a starfish; the locals just call them stars. None of the currency exchanges seem to have heard of them, but
 * somehow, you'll need to find fifty of these coins by the time you arrive so you can pay the deposit on your room.
 *
 * To save your vacation, you need to get all fifty stars by December 25th.
 *
 * Collect stars by solving puzzles. Two puzzles will be made available on each day in the Advent calendar; the second
 * puzzle is unlocked when you complete the first. Each puzzle grants one star. Good luck!
 *
 * @package AoC2020
 */
class Day1 extends Day
{
    /**
     * --- Part One ---
     *
     * Before you leave, the Elves in accounting just need you to fix your expense report (your puzzle input);
     * apparently, something isn't quite adding up.
     *
     * Specifically, they need you to find the two entries that sum to 2020 and then multiply those two numbers
     * together.
     *
     * For example, suppose your expense report contained the following:
     *
     *      1721
     *      979
     *      366
     *      299
     *      675
     *      1456
     *
     * In this list, the two entries that sum to 2020 are 1721 and 299. Multiplying them together produces
     * 1721 * 299 = 514579, so the correct answer is 514579.
     *
     * Of course, your expense report is much larger. Find the two entries that sum to 2020; what do you get if you
     * multiply them together?
     *
     * @param string $input
     *      The filename of the input to be processed.
     * @return int|null
     *      Returns the product of the two entries whose sum is 2020 on success, and null on failure.
     */
    public function part1(string $input): ?int
    {
        $report = $this->returnInputAsAnArrayOfIntegers($input);
        return $this->findTwo($report);
    }

    /**
     * Traverses an array of integers, attempting to find a pair of elements whose sum is 2020.
     *
     * @param array<int> $report
     *      The report (array of integers) to be processed.
     * @return int|null
     *      returns the product of the two entries whose sum is 2020 on success, and null on failure.
     */
    private function findTwo(array $report): ?int
    {
        do {
            $first_entry = array_pop($report);
            foreach ($report as $second_entry) {
                if ($first_entry + $second_entry === 2020) {
                    return $first_entry * $second_entry;
                }
            }
        } while (!empty($report));

        return null;
    }

    /**
     * --- Part Two ---
     *
     * The Elves in accounting are thankful for your help; one of them even offers you a starfish coin they had left
     * over from a past vacation. They offer you a second one if you can find three numbers in your expense report that
     * meet the same criteria.
     *
     * Using the above example again, the three entries that sum to 2020 are 979, 366, and 675. Multiplying them
     * together produces the answer, 241861950.
     *
     * In your expense report, what is the product of the three entries that sum to 2020?
     *
     * @param string $input
     *      The filename of the input to be processed.
     * @return int|null
     *      Returns the product of the three entries whose sum is 2020.
     */
    public function part2(string $input): ?int
    {
        $report = $this->returnInputAsAnArrayOfIntegers($input);
        return $this->findThree($report);
    }

    /**
     * Traverses an array of integers, attempting to find a trio of elements whose sum is 2020.
     *
     * @param array<int> $report
     *      The report (array of integers) to be processed.
     * @return int|null
     *      Returns the product of the three entries whose sum is 2020.
     */
    private function findThree(array $report): ?int
    {
        do {
            $first_entry = array_pop($report);
            $popped_report = $report;
            do {
                $second_entry = array_pop($popped_report);
                foreach ($popped_report as $third_entry) {
                    if ($first_entry + $second_entry + $third_entry === 2020) {
                        return $first_entry * $second_entry * $third_entry;
                    }
                }
            } while (!empty($popped_report));
        } while (!empty($report));

        return null;
    }
}
