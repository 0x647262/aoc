"""
--- Day 5: Doesn't He Have Intern-Elves For This? ---
"""

import re


def contains_at_least_three_vowels(string: str):
    """
    Returns True if string contains at least 3 vowels, otherwise False.
    """
    vowels = re.compile(r"[aeiou]")
    matches = vowels.findall(string)
    if len(matches) >= 3:
        return True
    return False


def contains_two_consecutive_letters(string: str):
    """
    Returns True if string contains at least one letter that appears twice in a
    row, otherwise False.
    """
    consecutive_letters = re.compile(r"([a-z])\1")
    if consecutive_letters.search(string):
        return True
    return False


def contains_naughty_string(string: str):
    """
    Returns True if a string contains a naughty string.
    """
    regex = re.compile(r"ab|cd|pq|xy")
    if regex.search(string):
        return True
    return False


def contains_character_pair_without_overlap(string: str):
    """
    Returns True if string contains a pair of two characters that appear twice
    without overlapping, otherwise False
    """
    regex = re.compile(r"([a-z][a-z])(.?)+\1")
    if regex.search(string):
        return True
    return False


def contains_repeat_character_sandwich(string: str):
    """
    Returns True if string contains a letter that repeats itself with a single
    character between.
    """
    regex = re.compile(r"([a-z]).\1")
    if regex.search(string):
        return True
    return False


def part1(santas_list: list):
    """
    Santa needs help figuring out which strings in his text file are naughty or
    nice.

    A nice string is one with all of the following properties:

        - It contains at least three vowels (aeiou only), like aei, xazegov, or
          aeiouaeiouaeiou.
        - It contains at least one letter that appears twice in a row, like xx,
          abcdde (dd), or aabbccdd (aa, bb, cc, or dd).
        - It does not contain the strings ab, cd, pq, or xy, even if they are
          part of one of the other requirements.

    For example:

        - ugknbfddgicrmopn is nice because it has at least three vowels
          (u...i...o...), a double letter (...dd...), and none of the
          disallowed substrings.
        - aaa is nice because it has at least three vowels and a double letter,
          even though the letters used by different rules overlap.
        - jchzalrnumimnmhp is naughty because it has no double letter.
        - haegwjzuvuyypxyu is naughty because it contains the string xy.
        - dvszwmarrgswjxmb is naughty because it contains only one vowel.

    How many strings are nice?
    """
    nice_strings = 0
    for string in santas_list:
        if contains_naughty_string(string):
            continue
        if contains_at_least_three_vowels(string) and \
                contains_two_consecutive_letters(string):
            nice_strings += 1
    return nice_strings


def part2(santas_list: list):
    """
    --- Part Two ---

    Realizing the error of his ways, Santa has switched to a better model of
    determining whether a string is naughty or nice. None of the old rules
    apply, as they are all clearly ridiculous.

    Now, a nice string is one with all of the following properties:

        - It contains a pair of any two letters that appears at least twice in
          the string without overlapping, like xyxy (xy) or aabcdefgaa (aa),
          but not like aaa (aa, but it overlaps).
        - It contains at least one letter which repeats with exactly one letter
          between them, like xyx, abcdefeghi (efe), or even aaa.

    For example:

        - qjhvhtzxzqqjkmpb is nice because is has a pair that appears twice
          (qj) and a letter that repeats with exactly one letter between them
          (zxz).
        - xxyxx is nice because it has a pair that appears twice and a letter
          that repeats with one between, even though the letters used by each
          rule overlap.
        - uurcxstgmygtbstg is naughty because it has a pair (tg) but no repeat
          with a single letter between them.
        - ieodomkazucvgmuy is naughty because it has a repeating letter with
          one between (odo), but no pair that appears twice.

    How many strings are nice under these new rules?
    """
    nice_strings = 0
    for string in santas_list:
        if contains_character_pair_without_overlap(string) and \
                contains_repeat_character_sandwich(string):
            nice_strings += 1
    return nice_strings


if __name__ == "__main__":
    with open("input") as FILE_INPUT:
        SANTAS_LIST = FILE_INPUT.readlines()
        print("Day 5 Part 1:", part1(SANTAS_LIST))
        print("Day 5 Part 2:", part2(SANTAS_LIST))
