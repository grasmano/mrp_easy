<?php

use PHPUnit\Framework\TestCase;

class ParsingTests extends TestCase
{
    public function testParsingSimple() {
        $this->assertSame(['TAG_NAME' => ['description' => 'some_desc', 'data' => 'some_data']], ParseTags::parse('[TAG_NAME:some_desc]some_data[/TAG_NAME]'));
    }

    public function testParsingRandomDescriptionAndDataStrings() {
        $this->assertSame(['TAG_NAME' => ['description' => 'Desc123_ 54 6QWE', 'data' => ' _ HJGKR dgfb']], ParseTags::parse('[TAG_NAME:Desc123_ 54 6QWE] _ HJGKR dgfb[/TAG_NAME]'));
    }

    public function testParsingEmptyTagName() {
        $this->assertSame(['' => ['description' => 'some_desc', 'data' => 'some_data']], ParseTags::parse('[:some_desc]some_data[/]'));
    }

    public function testParsingTagNameSmallLetters() {
        $this->assertSame(['' => ['description' => 'some_desc', 'data' => 'some_data']], ParseTags::parse('[tag_name:some_desc]some_data[/tag_name]'));
    }

}
