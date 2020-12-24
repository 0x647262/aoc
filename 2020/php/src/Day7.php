<?php

declare(strict_types=1);

namespace AoC2020;

/**
 * Class Day7
 * @package AoC2020
 */
class Day7 extends Day
{
    /**
     *
     * @param string $input
     *      The name of the file to be processed.
     * @return int
     */
    public function part1(string $input): int
    {
        $rawBagRules = $this->returnInputAsAnArrayOfStrings($input);
        $processedBagRules = $this->processBagRules($rawBagRules);
        $containGoldBags = $this->canBeContainedBy($processedBagRules);
        return count($containGoldBags);
    }

    /**
     * @param array<string> $rawBagRules
     * @return array<string, array>
     */
    private function processBagRules(array $rawBagRules): array
    {
        $rules = [];
        foreach ($rawBagRules as $rawBagRule) {
            /** @var array<string> $initialSplit */
            $initialSplit = preg_split('/bags contain/', $rawBagRule);
            $bagType = trim($initialSplit[0]);
            /** @var array<string> $rawBagContents */
            $rawBagContents = preg_split('/,/', $initialSplit[1]);
            $bagRule = [];
            /** @var string $rawBagContent */
            foreach ($rawBagContents as $rawBagContent) {
                if (preg_match('/no other bags./', $rawBagContent)) {
                    $rules[$bagType] = [];
                    continue;
                }
                $rules[$bagType] = [];
                preg_match('/([0-9]+) ([a-z]+ [a-z]+)/', $rawBagContent, $matches);
                $bagRule[$matches[2]] = intval($matches[1]);
                $rules[$bagType] = $bagRule;
            }
        }
        return $rules;
    }

    /**
     * TODO: This function can be optimized!
     *
     * @param array<string, array> $bagRules
     * @param string $bagType
     * @return array<string, array>
     */
    private function canBeContainedBy(array $bagRules, string $bagType = 'shiny gold'): array
    {
        $validContainers = [];
        foreach ($bagRules as $type => $rules) {
            if (!key_exists($bagType, $rules)) {
                continue;
            }
            $validContainers[$type] = $rules;
        }

        do {
            $found = 0;
            foreach ($bagRules as $type => $rules) {
                foreach ($validContainers as $validContainer => $unused) {
                    if (!key_exists($validContainer, $rules)) {
                        continue;
                    }
                    $found += 1;
                    $validContainers[$type] = $rules;
                    unset($bagRules[$type]);
                }
            }
        } while ($found !== 0);

        return $validContainers;
    }

    /**
     *
     * @param string $input
     *      The name of the file to be processed.
     * @return int
     *      Returns the number of valid passwords contained in $input.
     */
    public function part2(string $input): int
    {
        $rawBagRules = $this->returnInputAsAnArrayOfStrings($input);
        $processedBagRules = $this->processBagRules($rawBagRules);
        return $this->contains($processedBagRules);
    }

    /**
     * @param array<string, array> $bagRules
     * @param string $bagType
     * @return int
     */
    private function contains(array $bagRules, string $bagType = 'shiny gold'): int
    {
        $total = 0;
        /**
         * @var string $bag
         * @var int $count
         */
        foreach ($bagRules[$bagType] as $bag => $count) {
            $total += $count;
            if (!empty($bagRules[$bagType])) {
                $total += $count * $this->contains($bagRules, $bag);
            }
        }

        return intval($total);
    }
}
