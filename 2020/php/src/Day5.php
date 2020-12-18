<?php

declare(strict_types=1);

namespace AoC2020;

/**
 * Class Day5
 * @package AoC2020
 */
class Day5 extends Day
{
    /**
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
