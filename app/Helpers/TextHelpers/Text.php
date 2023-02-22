<?php

namespace App\Helpers\TextHelpers;


class Text
{

    /**
     * Coupage d'une chaine de caracteré
     * @param string|null $text
     * @param int $limit
     * @return string
     */
    public static function Excerpt(?string $text, int $limit = 15): string
    {
        if($text === null){
            return "";
        }
        $lenght = mb_strlen($text);
        if ($lenght <= $limit) return $text;
        $offset = mb_strpos($text, ' ', $limit) ?: $limit;
        return substr($text, 0, $offset) . '...';
    }

    /**
     * @param string $text
     * @param array $source
     * @param array $destination
     * @return string|null
     */
    public static function replace(string $text, array $source, array $destination): ?string
    {
        foreach ($source as $key => $value) {
            $text = str_replace($value, $destination[$key], $text);
        }
        return $text;
    }
}
