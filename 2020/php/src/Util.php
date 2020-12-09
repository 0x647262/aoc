<?php

declare(strict_types=1);

namespace AoC2020;

/**
 * Utility class for PHP AoC 2020
 *
 * @package AoC2020
 */
class Util
{
    /**
     * @param string $filename
     * @return string[]
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
     *
     * @return \Generator
     */
    public function readInput(string $filename): \Generator
    {
        $file = fopen($filename, 'r');

        while ($line = fgets($file)) {
            yield $line;
        }

        fclose($file);
    }

    /**
     * @param string $filename
     * @return int[]
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
