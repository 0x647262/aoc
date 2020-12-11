<?php

declare(strict_types=1);

namespace AoC2020;

/**
 * Utility class for PHP AoC 2020
 *
 * @package AoC2020
 */
class Day
{
    /**
     * @param string $filename
     *      Name of the file to be read.
     * @return string[]
     *      Returns an array of strings extracted from $filename.
     */
    public function returnInputAsAnArrayOfStrings(string $filename): array
    {
        return array_map(
            function (string $element) {
                return trim(
                    strval($element)
                );
            },
            iterator_to_array(
                $this->readInput($filename)
            )
        );
    }

    /**
     * @param string $filename
     *      Name of the file to be read.
     * @return \Traversable<string>
     *     Yields one line of the file (as a string) at a time.
     */
    private function readInput(string $filename): \Traversable
    {
        $file = fopen($filename, 'r');
        if ($file === false) {
            return;
        }

        while ($line = fgets($file)) {
            yield $line;
        }

        fclose($file);
    }

    /**
     * @param string $filename
     *      Name of the file to be read.
     * @return int[]
     *      Returns an array of integers extracted from $filename.
     */
    public function returnInputAsAnArrayOfIntegers(string $filename): array
    {
        return array_map(
            'intval',
            iterator_to_array(
                $this->readInput($filename)
            )
        );
    }
}
