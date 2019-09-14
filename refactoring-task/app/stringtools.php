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
}