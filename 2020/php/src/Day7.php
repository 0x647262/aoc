<?php

// Note: This problem is an example of a https://en.wikipedia.org/wiki/Directed_acyclic_graph

declare(strict_types=1);

namespace AoC2020;

/**
 * --- Day 7: Handy Haversacks ---
 *
 * You land at the regional airport in time for your next flight. In fact, it looks like you'll even have time to grab
 * some food: all flights are currently delayed due to issues in luggage processing.
 *
 * Class Day7
 * @package AoC2020
 */
class Day7 extends Day
{
    /**
     * --- Part One ---
     *
     * Due to recent aviation regulations, many rules (your puzzle input) are being enforced about bags and their
     * contents; bags must be color-coded and must contain specific quantities of other color-coded bags. Apparently,
     * nobody responsible for these regulations considered how long they would take to enforce!
     *
     * For example, consider the following rules:
     *
     *      light red bags contain 1 bright white bag, 2 muted yellow bags.
     *      dark orange bags contain 3 bright white bags, 4 muted yellow bags.
     *      bright white bags contain 1 shiny gold bag.
     *      muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
     *      shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
     *      dark olive bags contain 3 faded blue bags, 4 dotted black bags.
     *      vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
     *      faded blue bags contain no other bags.
     *      dotted black bags contain no other bags.
     *
     * These rules specify the required contents for 9 bag types. In this example, every faded blue bag is empty, every
     * vibrant plum bag contains 11 bags (5 faded blue and 6 dotted black), and so on.
     *
     * You have a shiny gold bag. If you wanted to carry it in at least one other bag, how many different bag colors
     * would be valid for the outermost bag? (In other words: how many colors can, eventually, contain at least one
     * shiny gold bag?)
     *
     * In the above rules, the following options would be available to you:
     *
     *      - A bright white bag, which can hold your shiny gold bag directly.
     *      - A muted yellow bag, which can hold your shiny gold bag directly, plus some other bags.
     *      - A dark orange bag, which can hold bright white and muted yellow bags, either of which could then hold your
     *        shiny gold bag.
     *      - A light red bag, which can hold bright white and muted yellow bags, either of which could then hold your
     *        shiny gold bag.
     *
     * So, in this example, the number of bag colors that can eventually contain at least one shiny gold bag is 4.
     *
     * How many bag colors can eventually contain at least one shiny gold bag? (The list of rules is quite long; make
     * sure you get all of it.)
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
     * @param array<string, array> $bagRules
     * @param string $bagType
     * @return array<string>
     */
    private function canBeContainedBy(array $bagRules, string $bagType = 'shiny gold'): array
    {
        $validContainers = [];
        foreach ($bagRules as $bag => $rule) {
            if (!key_exists($bagType, $rule)) {
                continue;
            }
            $validContainers[] = $bag;
            $validContainers = array_merge($validContainers, $this->canBeContainedBy($bagRules, $bag));
        }

        return array_unique($validContainers);
    }

    /**
     * --- Part Two ---
     *
     * It's getting pretty expensive to fly these days - not because of ticket prices, but because of the ridiculous
     * number of bags you need to buy!
     *
     * Consider again your shiny gold bag and the rules from the above example:
     *
     *      faded blue bags contain 0 other bags.
     *      dotted black bags contain 0 other bags.
     *      vibrant plum bags contain 11 other bags: 5 faded blue bags and 6 dotted black bags.
     *      dark olive bags contain 7 other bags: 3 faded blue bags and 4 dotted black bags.
     *
     * So, a single shiny gold bag must contain 1 dark olive bag (and the 7 bags within it) plus 2 vibrant plum bags
     * (and the 11 bags within each of those): 1 + 1*7 + 2 + 2*11 = 32 bags!
     *
     * Of course, the actual rules have a small chance of going several levels deeper than this example; be sure to
     * count all of the bags, even if the nesting becomes topologically impractical!
     *
     * Here's another example:
     *
     *      shiny gold bags contain 2 dark red bags.
     *      dark red bags contain 2 dark orange bags.
     *      dark orange bags contain 2 dark yellow bags.
     *      dark yellow bags contain 2 dark green bags.
     *      dark green bags contain 2 dark blue bags.
     *      dark blue bags contain 2 dark violet bags.
     *      dark violet bags contain no other bags.
     *
     * In this example, a single shiny gold bag must contain 126 other bags.
     *
     * How many individual bags are required inside your single shiny gold bag?
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
