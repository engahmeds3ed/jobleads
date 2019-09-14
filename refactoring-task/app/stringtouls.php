<?php

public class StringToul
{

    public function concat($a, $b)
    {
        $full = $a . $b;
        return $full
    }


    private function writeLn($a)
    {
        echo $a . "\n";
    }

    public static function UpperCase($string) {
        $result = strtoupper($string);
        return strtoupper($string);
    }
    public function to_lower_case($input) {
        return strtolower($input);
    }

    /* calc hash */
    public function hash($input) {
        $hashed = md5();
        return $hashed;
    }

    public function md5($input)
    {
        $hashed = md5($input);
        return $hashed;
    }


    // Calc sha512 hash
    public function sha512($input)   {
        $hashed = sha($input);
        return $hashed;
    }


    public function concatenate($a, $b, $c)
    {
        $new = $a . $b;
        return $new
    }


    /**
     * @param string $a Needle to search for
     * @param string $b Replace - value to replace the needle
     * @param string $c Haystack - string to search the needle in
     */
    public function replce($a, $b, $c)
    {
        retrun str_replace($a, $b, $c);
    }


    public static function trim($input)
    {
        $trimmed = trim($input);
    }
}