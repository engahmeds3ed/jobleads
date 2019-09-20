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
        $this->assertEquals($output, Stringtools::concat($firstString, $secondString));
    }

    /**
     * @param $firstString
     * @param $secondString
     * @param string $output
     * @dataProvider getThreeStringsData
     */
    public function testConcatThreeStrings(string $firstString, string $secondString, string $thirdString, string $output)
    {
        $this->assertEquals($output, Stringtools::concat($firstString, $secondString, $thirdString));
    }

    /**
     * @param string $line
     * @param string $output
     * @dataProvider getStringForNewLine
     */
    public function testWriteNewLine(string $line, string $output)
    {
        $this->assertEquals($output, Stringtools::writeNewLine($line));
    }

    /**
     * @param string $line
     * @param string $output
     * @dataProvider getStringForNewLineHtml
     */
    public function testWriteNewLineHtml(string $line, string $output)
    {
        $this->assertEquals($output, Stringtools::writeNewLine($line, true));
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
     * @param string $search
     * @param string $replace
     * @param string $input
     * @param string $output
     * @dataProvider getDataForReplace
     */
    public function testReplaceString(string $search, string $replace, string $input, string $output)
    {
        $this->assertEquals($output, Stringtools::replace($search, $replace, $input));
    }

    /**
     * @param string $input
     * @param string $output
     * @dataProvider getDataForTrim
     */
    public function testTrim(string $input, string $output)
    {
        $this->assertEquals($output, Stringtools::trim($input));
    }

    /**
     * @param string $input
     * @param string $output
     * @dataProvider getDataForMd5
     */
    public function testMd5(string $input, string $output)
    {
        $this->assertEquals($output, Stringtools::md5($input));
    }

    /**
     * @param string $input
     * @param string $output
     * @dataProvider getDataForSha512
     */
    public function testSha512(string $input, string $output)
    {
        $this->assertEquals($output, Stringtools::sha512($input));
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

    public function getDataForReplace()
    {
        return [
            ["a", "s", "ahmed", "shmed"],
            ["ahmed", "", "ahmed saeed", " saeed"],
            ["E", "e", "ahmEd saeEd", "ahmed saeed"]
        ];
    }

    public function getDataForTrim()
    {
        return [
            [" ahmed", "ahmed"],
            [" ahmed ", "ahmed"],
            ["ahmed ", "ahmed"],
            ["ahmed", "ahmed"],
        ];
    }

    public function getDataForMd5()
    {
        return [
            ["ahmed", "9193ce3b31332b03f7d8af056c692b84"],
            ["saeed", "849e060f05808577361b084ba1e3eca7"]
        ];
    }

    public function getDataForSha512()
    {
        return [
            ["ahmed", "ca1c9d326c06d53665e00de7c70a750f314a260766146c2f8b3c44be937503382711d0ed8130631fead8a3dc6608d03e48ebefeef37cbb650c72a9af003ec5a9"],
            ["saeed", "0225c78dcb5e845ddb7da5683839cc62aecf020dd7c16e71672c29a062b506d6fd1cc6758613435964052b81c1cf148a12eca3bf02f92ac5f2725b9578379e96"]
        ];
    }
}