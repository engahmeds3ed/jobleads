<?php

class Stringtools
{
    /**
     * Concatenate more than one string and return it back
     * @param string ...$strings
     * @return string
     */
    public function concat(...$strings)
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
    public function writeNewLine(string $line, bool $isHtml = false)
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


}