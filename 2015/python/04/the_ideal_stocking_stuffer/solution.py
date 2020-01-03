"""
--- Day 4: The Ideal Stocking Stuffer ---
"""

from hashlib import md5
from itertools import count
from re import match


# pylint: disable = inconsistent-return-statements
def md5match(pattern: str, string: bytes):
    """
    Search md5 hashes of string for occurances of pattern:
    """
    for i in count():
        md5sum = md5(string + str(i).encode("ascii")).hexdigest()
        if match(pattern, md5sum):
            return i


def part1(secret_key: bytes):
    """
    Santa needs help mining some AdventCoins (very similar to bitcoins) to use
    as gifts for all the economically forward-thinking little girls and boys.

    To do this, he needs to find MD5 hashes which, in hexadecimal, start with
    at least five zeroes. The input to the MD5 hash is some secret key (your
    puzzle input, given below) followed by a number in decimal. To mine
    AdventCoins, you must find Santa the lowest positive number (no leading
    zeroes: 1, 2, 3, ...) that produces such a hash.

    For example:

        - If your secret key is abcdef, the answer is 609043, because the MD5
          hash of abcdef609043 starts with five zeroes (000001dbbfa...), and it
          is the lowest such number to do so.
        - If your secret key is pqrstuv, the lowest number it combines with to
          make an MD5 hash starting with five zeroes is 1048970; that is, the
          MD5 hash of pqrstuv1048970 looks like 000006136ef....
    """
    return md5match("^00000", secret_key)


def part2(secret_key: bytes):
    """
    --- Part Two ---

    Now find one that starts with six zeroes.
    """
    return md5match("^000000", secret_key)


if __name__ == "__main__":
    with open("input") as FILE_INPUT:
        SECRET_KEY = FILE_INPUT.read().rstrip().encode("ascii")
        print("Day 4 Part 1:", part1(SECRET_KEY))
        print("Day 4 Part 2:", part2(SECRET_KEY))
