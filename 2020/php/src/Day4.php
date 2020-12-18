<?php

declare(strict_types=1);

namespace AoC2020;

/**
 * --- Day 4: Passport Processing ---
 *
 * You arrive at the airport only to realize that you grabbed your North Pole Credentials instead of your passport.
 * While these documents are extremely similar, North Pole Credentials aren't issued by a country and therefore aren't
 * actually valid documentation for travel in most of the world.
 *
 * It seems like you're not the only one having problems, though; a very long line has formed for the automatic passport
 * scanners, and the delay could upset your travel itinerary.
 *
 * Due to some questionable network security, you realize you might be able to solve both of these problems at the same
 * time.
 *
 * Class Day4
 * @package AoC2020
 */
class Day4 extends Day
{
    /**
     * The automatic passport scanners are slow because they're having trouble detecting which passports have all
     * required fields. The expected fields are as follows:
     *
     * byr (Birth Year)
     * iyr (Issue Year)
     * eyr (Expiration Year)
     * hgt (Height)
     * hcl (Hair Color)
     * ecl (Eye Color)
     * pid (Passport ID)
     * cid (Country ID)
     *
     * Passport data is validated in batch files (your puzzle input). Each passport is represented as a sequence of
     * key:value pairs separated by spaces or newlines. Passports are separated by blank lines.
     *
     * Here is an example batch file containing four passports:
     *
     *      ecl:gry pid:860033327 eyr:2020 hcl:#fffffd
     *      byr:1937 iyr:2017 cid:147 hgt:183cm
     *
     *      iyr:2013 ecl:amb cid:350 eyr:2023 pid:028048884
     *      hcl:#cfa07d byr:1929
     *
     *      hcl:#ae17e1 iyr:2013
     *      eyr:2024
     *      ecl:brn pid:760753108 byr:1931
     *      hgt:179cm
     *
     *      hcl:#cfa07d eyr:2025 pid:166559648
     *      iyr:2011 ecl:brn hgt:59in
     *
     * The first passport is valid - all eight fields are present. The second passport is invalid - it is missing hgt
     * (the Height field).
     *
     * The third passport is interesting; the only missing field is cid, so it looks like data from North Pole
     * Credentials, not a passport at all! Surely, nobody would mind if you made the system temporarily ignore missing
     * cid fields. Treat this "passport" as valid.
     *
     * The fourth passport is missing two fields, cid and byr. Missing cid is fine, but missing any other field is not,
     * so this passport is invalid.
     *
     * According to the above rules, your improved system would report 2 valid passports.
     *
     * Count the number of valid passports - those that have all required fields. Treat cid as optional.
     *
     * @param string $input
     *      The filename of the input to be processed.
     * @return int
     *      Returns the number of collisions encounter while traversing $input.
     */
    public function part1(string $input): int
    {
        $rawPassports = $this->returnInputAsAnArrayOfStrings($input);
        $passports = $this->extractPassports($rawPassports);

        $validPassports = 0;
        /** @var array<string> $passport */
        foreach ($passports as $passport) {
            if ($this->validate($passport) === true) {
                $validPassports += 1;
            }
        }

        return $validPassports;
    }

    /**
     * @param array<string> $rawPassports
     * @return array<array>
     */
    private function extractPassports(array $rawPassports): array
    {
        $passports = [];
        $rawPassport = '';
        while (!empty($rawPassports)) {
            $line = array_pop($rawPassports);
            if ($line === '') {
                array_push(
                    $passports,
                    $this->parsePassport($rawPassport)
                );
                $rawPassport = '';
            }
            $rawPassport .= ' ' . $line;
        }
        array_push(
            $passports,
            $this->parsePassport($rawPassport)
        );

        return $passports;
    }

    /**
     * @param string $rawPassport
     * @return array<string>
     */
    private function parsePassport(string $rawPassport): array
    {
        $passport = [];

        $rawFields = explode(' ', $rawPassport);
        foreach ($rawFields as $rawField) {
            if ($rawField === '') {
                continue;
            }
            [$key, $value] = explode(':', $rawField);
            $passport[$key] = strval($value);
        }
        return $passport;
    }

    /**
     * @param array<string> $passport
     * @param bool $strict
     * @return bool
     */
    private function validate(array $passport, bool $strict = false): bool
    {
        $requiredFields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid',];

        foreach ($requiredFields as $requiredField) {
            if (!isset($passport[$requiredField])) {
                return false;
            }
            if ($strict && !$this->validateField($requiredField, $passport[$requiredField])) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param string $field
     * @param string $value
     * @return bool
     */
    public function validateField(string $field, string $value): bool
    {
        switch ($field) {
            case 'byr':
                return $value >= 1920 && $value <= 2002;
            case 'iyr':
                return $value >= 2010 && $value <= 2020;
            case 'eyr':
                return $value >= 2020 && $value <= 2030;
            case 'hgt':
                if (!preg_match('/([0-9]+)([a-z]+)/', $value, $matches)) {
                    return false;
                }
                [, $height, $system] = $matches;
                if ($system === 'cm') {
                    return intval($height) >= 150 && intval($height) <= 193;
                }
                if ($system === 'in') {
                    return intval($height) >= 59 && intval($height) <= 76;
                }
                return false;
            case 'hcl':
                return boolval(preg_match('/^#[a-z0-9]{6}$/', $value));
            case 'ecl':
                $validColors = ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'];
                return in_array($value, $validColors, true);
            case 'pid':
                return boolval(preg_match('/^[0-9]{9}$/', $value));
            default:
                return false;
        }
    }

    /**
     * @param string $input
     *      The filename of the input to be processed.
     * @return int
     */
    public function part2(string $input): int
    {
        $rawPassports = $this->returnInputAsAnArrayOfStrings($input);
        $passports = $this->extractPassports($rawPassports);

        $validPassports = 0;
        /** @var array<string> $passport */
        foreach ($passports as $passport) {
            if ($this->validate($passport, true) === true) {
                $validPassports += 1;
            }
        }

        return $validPassports;
    }
}
