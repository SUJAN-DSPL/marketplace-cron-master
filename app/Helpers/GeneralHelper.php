<?php

declare(strict_types=1);

if (! function_exists(function: 'str_squish')) {
    function str_squish(?string $value): ?string
    {
        if (is_null($value)) {
            return null;
        }

        return preg_replace('~(\s|\x{3164}|\x{1160})+~u', ' ', preg_replace('~^[\s\x{FEFF}]+|[\s\x{FEFF}]+$~u', '', $value));
    }
}

if (! function_exists(function: 'getNames')) {
    /**
     * @return string[]
     */
    function getNames(string $fullName = ''): array
    {
        $output = ['firstname' => '', 'lastname' => ''];
        $input = explode(separator: ' ', string: $fullName);
        $len = count(value: $input);

        if (round(num: $len / 2) == 1) {
            $firstHalf = array_slice(array: $input, offset: (int) round(num: $len / 2));
            $secondHalf = '';
        } else {
            $firstHalf = array_slice(array: $input, offset: 0, length: (int) round(num: $len / 2));
            $secondHalf = array_slice($input, (int) round(num: $len / 2));
        }

        $output['firstname'] = (! empty($firstHalf)) ? implode(separator: ' ', array: $firstHalf) : '.';
        $output['lastname'] = (! empty($secondHalf)) ? implode(separator: ' ', array: $secondHalf) : '.';

        return $output;
    }
}
