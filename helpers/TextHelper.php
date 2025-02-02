<?php

class TextHelper
{
    public static function limitText($text, $maxLength = 30, $encoding = 'UTF-8')
    {
        if (mb_strlen($text, $encoding) > $maxLength) {
            return mb_substr($text, 0, $maxLength, $encoding) . '...';
        }
        return $text;
    }

    public static function capitalizeFirstLetter($string)
    {
        return ucwords(strtolower($string));
    }

    public static function to($type, $data)
    {
        switch (strtolower($type)) {
            case 'string':
                return (string) $data;
            case 'int':
            case 'integer':
                return (int) $data;
            case 'float':
            case 'double':
                return (float) $data;
            case 'bool':
            case 'boolean':
                return filter_var($data, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? false;
            case 'array':
                return (array) $data;
            case 'object':
                return (object) $data;
            case 'json':
                return json_encode($data);
            case 'null':
                return null;
            default:
                throw new InvalidArgumentException("Type '$type' tidak dikenal.");
        }
    }
}
