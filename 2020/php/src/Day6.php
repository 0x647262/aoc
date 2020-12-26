<?php

declare(strict_types=1);

namespace AoC2020;

/**
 * --- Day 6: Custom Customs ---
 *
 * As your flight approaches the regional airport where you'll switch to a much larger plane, customs declaration forms
 * are distributed to the passengers.
 *
 * Class Day6
 * @package AoC2020
 */
class Day6 extends Day
{
    /**
     * --- Part One ---
     *
     * The form asks a series of 26 yes-or-no questions marked a through z. All you need to do is identify the questions
     * for which anyone in your group answers "yes". Since your group is just you, this doesn't take very long.
     *
     * However, the person sitting next to you seems to be experiencing a language barrier and asks if you can help.
     * For each of the people in their group, you write down the questions for which they answer "yes", one per line.
     * For example:
     *
     *      abcx
     *      abcy
     *      abcz
     *
     * In this group, there are 6 questions to which anyone answered "yes": a, b, c, x, y, and z. (Duplicate answers to
     * the same question don't count extra; each question counts at most once.)
     *
     * Another group asks for your help, then another, and eventually you've collected answers from every group on the
     * plane (your puzzle input). Each group's answers are separated by a blank line, and within each group, each
     * person's answers are on a single line. For example:
     *
     *      abc
     *
     *      a
     *      b
     *      c
     *
     *      ab
     *      ac
     *
     *      a
     *      a
     *      a
     *      a
     *
     *      b
     *
     * This list represents answers from five groups:
     *
     *      - The first group contains one person who answered "yes" to 3 questions: a, b, and c.
     *      - The second group contains three people; combined, they answered "yes" to 3 questions: a, b, and c.
     *      - The third group contains two people; combined, they answered "yes" to 3 questions: a, b, and c.
     *      - The fourth group contains four people; combined, they answered "yes" to only 1 question, a.
     *      - The last group contains one person who answered "yes" to only 1 question, b.
     *
     * In this example, the sum of these counts is 3 + 3 + 3 + 1 + 1 = 11.
     *
     * For each group, count the number of questions to which anyone answered "yes". What is the sum of those counts?
     *
     * @param string $input
     *      The name of the file to be processed.
     * @return int
     *      Returns the number of valid passwords contained in $input.
     */
    public function part1(string $input): int
    {
        $rawForms = $this->returnInputAsAnArrayOfStrings($input);
        $processedForms = $this->processCustomsDeclarationForms($rawForms);
        $sum = 0;
        /** @var array<string> $processedForm */
        foreach ($processedForms as $processedForm) {
            $sum += sizeof(array_count_values($processedForm));
        }

        return $sum;
    }

    /**
     * @param array<string> $rawForms
     * @return array<array>
     */
    private function processCustomsDeclarationForms(array $rawForms): array
    {
        $forms = [];
        $form = '';
        while (!empty($rawForms)) {
            $line = array_pop($rawForms);
            if ($line === '') {
                array_push(
                    $forms,
                    str_split($form)
                );
                $form = '';
            }
            $form .= $line;
        }
        array_push(
            $forms,
            str_split($form)
        );

        return $forms;
    }

    /**
     * --- Part Two ---
     *
     * As you finish the last group's customs declaration, you notice that you misread one word in the instructions:
     *
     * You don't need to identify the questions to which anyone answered "yes"; you need to identify the questions to
     * which everyone answered "yes"!
     *
     * Using the same example as above:
     *
     *      abc
     *
     *      a
     *      b
     *      c
     *
     *      ab
     *      ac
     *
     *      a
     *      a
     *      a
     *      a
     *
     *      b
     *
     * This list represents answers from five groups:
     *
     *      - In the first group, everyone (all 1 person) answered "yes" to 3 questions: a, b, and c.
     *      - In the second group, there is no question to which everyone answered "yes".
     *      - In the third group, everyone answered yes to only 1 question, a. Since some people did not answer "yes" to
     *        b or c, they don't count.
     *      - In the fourth group, everyone answered yes to only 1 question, a.
     *      - In the fifth group, everyone (all 1 person) answered "yes" to 1 question, b.
     *
     * In this example, the sum of these counts is 3 + 0 + 1 + 1 + 1 = 6.
     *
     * For each group, count the number of questions to which everyone answered "yes". What is the sum of those counts?
     *
     * @param string $input
     *      The name of the file to be processed.
     * @return int
     *      Returns the number of valid passwords contained in $input.
     */
    public function part2(string $input): int
    {
        $rawForms = $this->returnInputAsAnArrayOfStrings($input);
        $processedForms = $this->processGroupCustomsDeclarationForms($rawForms);
        $sum = 0;
        /** @var array<string> $processedForm */
        foreach ($processedForms as $processedForm) {
            $sum += sizeof(array_count_values($processedForm));
        }

        return $sum;
    }

    /**
     * TODO: Reduce the cognitive complexity of this function.
     *
     * @param array<string> $rawForms
     * @return array<array>
     */
    private function processGroupCustomsDeclarationForms(array $rawForms): array
    {
        $forms = [];
        $form = [];
        $persons = 0;
        while (!empty($rawForms)) {
            /** @var string $line */
            $line = array_pop($rawForms);
            if ($line === '') {
                $filteredAnswers = [];
                foreach ($form as $answer => $responses) {
                    if ($responses === $persons) {
                        array_push($filteredAnswers, $answer);
                    }
                }
                array_push($forms, $filteredAnswers);
                $form = [];
                $persons = 0;
                continue;
            }
            $persons += 1;
            $answers = str_split($line);
            foreach ($answers as $answer) {
                if (key_exists($answer, $form)) {
                    $form[$answer] += 1;
                    continue;
                }
                $form[$answer] = 1;
            }
        }
        $filteredAnswers = [];
        foreach ($form as $answer => $responses) {
            if ($responses === $persons) {
                array_push($filteredAnswers, $answer);
            }
        }
        array_push($forms, $filteredAnswers);

        return $forms;
    }
}
