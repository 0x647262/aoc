<?php

declare(strict_types=1);

namespace AoC2020;

/**
 * --- Day 2: Password Philosophy ---
 *
 * Your flight departs in a few days from the coastal airport; the easiest way down to the coast from here is via
 * toboggan.
 *
 * The shopkeeper at the North Pole Toboggan Rental Shop is having a bad day. "Something's wrong with our computers; we
 * can't log in!" You ask if you can take a look.
 *
 * @package AoC2020
 */
class Day2 extends Util
{
    /*
     * Notes:
     *     * Psalm is unable to infer the type of these constants, so we cast them to make Psalm happy
     *     * Idea (again) thinks these constants are unused...
     */

    /**
     * @var int
     *      Index of the password rule array that contains the number corresponding to the minimum allowable occurrences
     *      of LETTER in the password.
     */
    private const COUNT_MIN = 1;
    /**
     * @var int
     *      Index of the password rule array that contains the number corresponding to the maximum allowable occurrences
     *      of LETTER in the password.
     */
    private const COUNT_MAX = 2;
    /**
     * @var int
     *      Index of the password rule array that contains the character to be counted.
     */
    private const LETTER = 3;
    /**
     * @var int
     *      Index of the password rule array that corresponds to the password to be verified.
     */
    private const PASSWORD = 4;
    /**
     * @var int
     *      Index of the password rule array that corresponds to the first index of the password to be checked for
     *      LETTER.
     */
    private const FIRST_INDEX = 1;
    /**
     * @var int
     *      Index of the password rule array that corresponds to the second index of the password to be checked for
     *      LETTER.
     */
    private const SECOND_INDEX = 2;

    /**
     * --- Part One ---
     *
     * Their password database seems to be a little corrupted: some of the passwords wouldn't have been allowed by the
     * Official Toboggan Corporate Policy that was in effect when they were chosen.
     *
     * To try to debug the problem, they have created a list (your puzzle input) of passwords (according to the
     * corrupted database) and the corporate policy when that password was set.
     *
     * For example, suppose you have the following list:
     *
     *      1-3 a: abcde
     *      1-3 b: cdefg
     *      2-9 c: ccccccccc
     *
     * Each line gives the password policy and then the password. The password policy indicates the lowest and highest
     * number of times a given letter must appear for the password to be valid. For example, 1-3 a means that the
     * password must contain a at least 1 time and at most 3 times.
     *
     * In the above example, 2 passwords are valid. The middle password, cdefg, is not; it contains no instances of b,
     * but needs at least 1. The first and third passwords are valid: they contain one a or nine c, both within the
     * limits of their respective policies.
     *
     * How many passwords are valid according to their policies?
     *
     * @param string $input
     * @return int
     */
    public function part1(string $input): int
    {
        $entries = $this->returnInputAsAnArrayOfStrings($input);
        $validPasswords = 0;
        foreach ($entries as $entry) {
            $processedEntry = $this->splitEntry($entry);
            if (empty($processedEntry)) {
                continue;
            }

            if ($this->validateEntry(
                (int)$processedEntry[(int)$this::COUNT_MIN],
                (int)$processedEntry[(int)$this::COUNT_MAX],
                $processedEntry[(int)$this::LETTER],
                $processedEntry[(int)$this::PASSWORD]
            )) {
                $validPasswords += 1;
            }
        }

        return $validPasswords;
    }

    /**
     * TODO: DOCUMENT ME!
     * @param string $entry
     * @return string[]
     */
    private function splitEntry(string $entry): array
    {
        preg_match(
            '/([0-9]+)-([0-9]+) ([a-z]): ([a-z]+)/',
            $entry,
            $matches
        );

        return $matches;
    }

    /**
     * TODO: DOCUMENT ME!
     * @param int $min
     * @param int $max
     * @param string $letter
     * @param string $password
     * @return bool
     */
    private function validateEntry(int $min, int $max, string $letter, string $password): bool
    {
        $count = substr_count($password, $letter);
        return ($count <= $max) && ($min <= $count);
    }

    /**
     * --- Part Two ---
     *
     * While it appears you validated the passwords correctly, they don't seem to be what the Official Toboggan
     * Corporate Authentication System is expecting.
     *
     * The shopkeeper suddenly realizes that he just accidentally explained the password policy rules from his old job
     * at the sled rental place down the street! The Official Toboggan Corporate Policy actually works a little
     * differently.
     *
     * Each policy actually describes two positions in the password, where 1 means the first character, 2 means the
     * second character, and so on. (Be careful; Toboggan Corporate Policies have no concept of "index zero"!) Exactly
     * one of these positions must contain the given letter. Other occurrences of the letter are irrelevant for the
     * purposes of policy enforcement.
     *
     * Given the same example list from above:
     *
     * 1-3 a: abcde is valid: position 1 contains a and position 3 does not.
     * 1-3 b: cdefg is invalid: neither position 1 nor position 3 contains b.
     * 2-9 c: ccccccccc is invalid: both position 2 and position 9 contain c.
     *
     * How many passwords are valid according to the new interpretation of the policies?
     *
     * @param string $input
     * @return int
     */
    public function part2(string $input): int
    {
        $entries = $this->returnInputAsAnArrayOfStrings($input);
        $validPasswords = 0;
        foreach ($entries as $entry) {
            $processedEntry = $this->splitEntry($entry);
            if (empty($processedEntry)) {
                continue;
            }

            if ($this->validateCorporateEntry(
                (int)$processedEntry[(int)$this::FIRST_INDEX],
                (int)$processedEntry[(int)$this::SECOND_INDEX],
                $processedEntry[(int)$this::LETTER],
                $processedEntry[(int)$this::PASSWORD]
            )) {
                $validPasswords += 1;
            }
        }

        return $validPasswords;
    }

    /**
     * TODO: DOCUMENT ME!
     * @param int $firstIndex
     * @param int $secondIndex
     * @param string $letter
     * @param string $password
     * @return bool
     */
    private function validateCorporateEntry(int $firstIndex, int $secondIndex, string $letter, string $password): bool
    {
        $occurrences = 0;
        $splitPassword = str_split($password);

        // Corporate indexing starts at 1 while PHP's starts at 0. Normalize the index:
        $firstIndex -= 1;
        if (array_key_exists($firstIndex, $splitPassword) && $splitPassword[$firstIndex] === $letter) {
            $occurrences += 1;
        }

        // Corporate indexing starts at 1 while PHP's starts at 0. Normalize the index:
        $secondIndex -= 1;
        if (array_key_exists($secondIndex, $splitPassword) && $splitPassword[$secondIndex] === $letter) {
            $occurrences += 1;
        }

        return $occurrences === 1;
    }
}
