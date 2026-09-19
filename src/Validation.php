<?php

namespace Src;

class Validation
{
    public function filterInput(array $query): array
    {
        $filtered = [];
        foreach ($query as $key => $input) {
            $filtered[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $filtered;
    }
}