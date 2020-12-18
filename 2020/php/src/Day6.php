<?php

declare(strict_types=1);

namespace AoC2020;

/**
 * Class Day6
 * @package AoC2020
 */
class Day6 extends Day
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
