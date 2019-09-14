<?php

use PHPUnit\Framework\TestCase;

final class StringtoolsTest extends TestCase
{

    /**
     * @param $firstString
     * @param $secondString
     * @param string $output
     * @dataProvider getTwoStringsData
     */
    public function testConcatTwoStrings(string $firstString, string $secondString, string $output)
    {
        $stringtool = new Stringtools();
        $this->assertEquals($output, $stringtool->concat($firstString, $secondString));
    }

    /**
     * @param $firstString
     * @param $secondString
     * @param string $output
     * @dataProvider getThreeStringsData
     */
    public function testConcatThreeStrings(string $firstString, string $secondString, string $thirdString, string $output)
    {
        $stringtool = new Stringtools();
        $this->assertEquals($output, $stringtool->concat($firstString, $secondString, $thirdString));
    }

    /**
     * @param string $line
     * @param string $output
     * @dataProvider getStringForNewLine
     */
    public function testWriteNewLine(string $line, string $output)
    {
        $stringtool = new Stringtools();
        $this->assertEquals($output, $stringtool->writeNewLine($line));
    }

    /**
     * @param string $line
     * @param string $output
     * @dataProvider getStringForNewLineHtml
     */
    public function testWriteNewLineHtml(string $line, string $output)
    {
        $stringtool = new Stringtools();
        $this->assertEquals($output, $stringtool->writeNewLine($line, true));
    }

    /**
     * @param string $word
     * @param string $output
     * @dataProvider getStringForUpperCase
     */
    public function testUpperCase(string $word, string $output)
    {
        $this->assertEquals($output, Stringtools::upperCase($word));
    }

    /**
     * @param string $word
     * @param string $output
     * @dataProvider getStringForLowerCase
     */
    public function testLowerCase(string $word, string $output)
    {
        $this->assertEquals($output, Stringtools::lowerCase($word));
    }

    /**
     * @return array
     */
    public function getTwoStringsData()
    {
        return [
            ["ahmed", "saeed", "ahmedsaeed"],
            ["1", "2", "12"],
            ["ahmed1", "ahmed2", "ahmed1ahmed2"]
        ];
    }

    /**
     * @return array
     */
    public function getThreeStringsData()
    {
        return [
            ["Hi", "ahmed", "saeed", "Hiahmedsaeed"],
            ["1", "2", "3", "123"],
            ["ahmed1", "ahmed2", "ahmed3", "ahmed1ahmed2ahmed3"]
        ];
    }

    public function getStringForNewLine()
    {
        return [
            ["ahmed", "ahmed\n"],
            ["ahmed\n", "ahmed\n\n"]
        ];
    }

    public function getStringForNewLineHtml()
    {
        return [
            ["ahmed", "ahmed<br>"],
            ["ahmed<br>", "ahmed<br><br>"]
        ];
    }

    public function getStringForUpperCase()
    {
        return [
            ["aHmEd", "AHMED"],
            ["AHMED", "AHMED"],
            ["AhmeD1", "AHMED1"]
        ];
    }

    public function getStringForLowerCase()
    {
        return [
            ["aHmEd", "ahmed"],
            ["AHMED", "ahmed"],
            ["AhmeD1", "ahmed1"]
        ];
    }
}