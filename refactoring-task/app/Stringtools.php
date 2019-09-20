<?php

class Stringtools
{
    /**
     * Concatenate more than one string and return it back
     * @param string ...$strings
     * @return string
     */
    public static function concat(...$strings)
    {
        $output = "";
        if(!empty($strings)){
            $output = implode("", $strings);
        }
        return $output;
    }

    /**
     * write a string then puts a new line either html or raw text new line
     * @param string $line
     * @param bool $isHtml
     * @return string
     */
    public static function writeNewLine(string $line, bool $isHtml = false)
    {
        return $line . (($isHtml) ? "<br>" : "\n");
    }

    /**
     * UpperCase all characters on the specified string
     * @param $string
     * @return string
     */
    public static function upperCase($string) {
        return strtoupper($string);
    }

    /**
     * LowerCase all characters on the specified string
     * @param $string
     * @return string
     */
    public static function lowerCase($string) {
        return strtolower($string);
    }


    /**
     * replace a string with another in text variable
     * @param string $needle Needle to search for
     * @param string $replace Replace - value to replace the needle
     * @param string $text Haystack - string to search the needle in
     * @return string
     */
    public static function replace($needle, $replace, $text):string
    {
        return str_replace($needle, $replace, $text);
    }

    /**
     * trim spaces at start and end of any string
     * @param string $input
     * @return string
     */
    public static function trim(string $input):string
    {
        return trim($input);
    }

    /**
     * Generic hash method to hash a string with any algorithm
     * @param string $algorithm
     * @param string $data
     * @return string
     */
    protected static function hash(string $algorithm, string $data):string
    {
        return hash($algorithm, $data);
    }

    /**
     * Hash with md5 algorithm
     * @param string $data
     * @return string
     */
    public static function md5(string $data):string
    {
        return self::hash("md5", $data);
    }

    /**
     * Hash with sha512 algorithm
     * @param string $data
     * @return string
     */
    public static function sha512(string $data):string
    {
        return self::hash("sha512", $data);
    }
}