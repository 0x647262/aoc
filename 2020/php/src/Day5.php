<?php

declare(strict_types=1);

namespace AoC2020;

/**
 * --- Day 5: Binary Boarding ---
 *
 * You board your plane only to discover a new problem: you dropped your boarding pass! You aren't sure which seat is
 * yours, and all of the flight attendants are busy with the flood of people that suddenly made it through passport
 * control.
 *
 * You write a quick program to use your phone's camera to scan all of the nearby boarding passes (your puzzle input);
 * perhaps you can find your seat through process of elimination.
 *
 * Class Day5
 * @package AoC2020
 */
class Day5 extends Day
{
    /**
     * --- Part One ---
     *
     * Instead of zones or groups, this airline uses binary space partitioning to seat people. A seat might be specified
     * like FBFBBFFRLR, where F means "front", B means "back", L means "left", and R means "right".
     *
     * The first 7 characters will either be F or B; these specify exactly one of the 128 rows on the plane (numbered 0
     * through 127). Each letter tells you which half of a region the given seat is in. Start with the whole list of
     * rows; the first letter indicates whether the seat is in the front (0 through 63) or the back (64 through 127).
     * The next letter indicates which half of that region the seat is in, and so on until you're left with exactly one
     * row.
     *
     * For example, consider just the first seven characters of FBFBBFFRLR:
     *
     *      Start by considering the whole range, rows 0 through 127.
     *      F means to take the lower half, keeping rows 0 through 63.
     *      B means to take the upper half, keeping rows 32 through 63.
     *      F means to take the lower half, keeping rows 32 through 47.
     *      B means to take the upper half, keeping rows 40 through 47.
     *      B keeps rows 44 through 47.
     *      F keeps rows 44 through 45.
     *      The final F keeps the lower of the two, row 44.
     *
     * The last three characters will be either L or R; these specify exactly one of the 8 columns of seats on the plane
     * (numbered 0 through 7). The same process as above proceeds again, this time with only three steps. L means to
     * keep the lower half, while R means to keep the upper half.
     *
     * For example, consider just the last 3 characters of FBFBBFFRLR:
     *
     *      Start by considering the whole range, columns 0 through 7.
     *      R means to take the upper half, keeping columns 4 through 7.
     *      L means to take the lower half, keeping columns 4 through 5.
     *      The final R keeps the upper of the two, column 5.
     *
     * So, decoding FBFBBFFRLR reveals that it is the seat at row 44, column 5.
     *
     * Every seat also has a unique seat ID: multiply the row by 8, then add the column. In this example, the seat has
     * ID 44 * 8 + 5 = 357.
     *
     * Here are some other boarding passes:
     *
     *      BFFFBBFRRR: row 70, column 7, seat ID 567.
     *      FFFBBBFRRR: row 14, column 7, seat ID 119.
     *      BBFFBBFRLL: row 102, column 4, seat ID 820.
     *
     * As a sanity check, look through your list of boarding passes. What is the highest seat ID on a boarding pass?
     *
     * @param string $input
     *      The name of the file to be processed.
     * @return int
     *      Returns the number of valid passwords contained in $input.
     */
    public function part1(string $input): int
    {
        $seatIDs = $this->processBoardingPasses($input);

        $max = 0;
        if (!empty($seatIDs)) {
            $max = max($seatIDs);
        }
        return intval($max);
    }

    /**
     * @param string $input
     * @return array<int>
     */
    private function processBoardingPasses(string $input): array
    {
        $rawBoardingPasses = $this->returnInputAsAnArrayOfStrings($input);
        $seatIDs = [];
        foreach ($rawBoardingPasses as $rawBoardingPass) {
            $parsedBoardingPass = $this->parseBoardingPass($rawBoardingPass);
            $row = $this->calculateRow($parsedBoardingPass['rowCode']);
            $column = $this->calculateColumn($parsedBoardingPass['columnCode']);
            array_push($seatIDs, ($row * 8) + $column);
        }

        sort($seatIDs);
        return $seatIDs;
    }

    /**
     * @param string $rawBoardingPass
     * @return array<string>
     */
    private function parseBoardingPass(string $rawBoardingPass): array
    {
        $matches = preg_match('/([F,B]+)([L,R]+)/', $rawBoardingPass, $parsedBoardingPass);
        if ($matches === 0) {
            die;
        }

        return [
            'rowCode' => $parsedBoardingPass[1],
            'columnCode' => $parsedBoardingPass[2]
        ];
    }

    /**
     * @param string $rowCode
     * @param int $rows
     * @return int
     */
    private function calculateRow(string $rowCode, int $rows = 127): int
    {
        $rowsArray = range(1, $rows);
        foreach (str_split($rowCode) as $take) {
            switch ($take) {
                case 'F':
                    $rowsArray = $this->takeLowerHalf($rowsArray);
                    break;
                case 'B':
                    $rowsArray = $this->takeUpperHalf($rowsArray);
                    break;
                default:
                    break;
            }
        }

        return intval($rowsArray[0]);
    }

    /**
     * @param array<int> $array
     * @return array<int>
     */
    private function takeLowerHalf(array $array): array
    {
        $midPoint = intval(sizeof($array) / 2);
        return array_slice($array, 0, $midPoint);
    }

    /**
     * @param array<int> $array
     * @return array<int>
     */
    private function takeUpperHalf(array $array): array
    {
        $midPoint = intval(sizeof($array) / 2);
        return array_slice($array, $midPoint, $midPoint + 1);
    }

    /**
     * @param string $columnCode
     * @param int $columns
     * @return int
     */
    private function calculateColumn(string $columnCode, int $columns = 7): int
    {
        $columnsArray = range(0, $columns);
        foreach (str_split($columnCode) as $take) {
            switch ($take) {
                case 'L':
                    $columnsArray = $this->takeLowerHalf($columnsArray);
                    break;
                case 'R':
                    $columnsArray = $this->takeUpperHalf($columnsArray);
                    break;
                default:
                    break;
            }
        }

        return intval($columnsArray[0]);
    }

    /**
     * --- Part Two ---
     *
     * Ding! The "fasten seat belt" signs have turned on. Time to find your seat.
     *
     * It's a completely full flight, so your seat should be the only missing boarding pass in your list. However,
     * there's a catch: some of the seats at the very front and back of the plane don't exist on this aircraft, so
     * they'll be missing from your list as well.
     *
     * Your seat wasn't at the very front or back, though; the seats with IDs +1 and -1 from yours will be in your list.
     *
     * What is the ID of your seat?
     *
     * @param string $input
     *      The filename of the input to be processed.
     * @return int
     *      Returns the number of valid passwords contained in $input.
     */
    public function part2(string $input): int
    {
        $seatIDs = $this->processBoardingPasses($input);
        for ($index = 0; $index < sizeof($seatIDs); $index += 1) {
            $currentSeatID = $seatIDs[$index];
            $nextSeatID = $seatIDs[$index + 1];
            if ($currentSeatID !== $nextSeatID - 1) {
                return $currentSeatID + 1;
            }
        }
        return 0;
    }
}
