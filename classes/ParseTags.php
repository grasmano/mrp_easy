<?php


class ParseTags
{
    public static function parse($string)
    {
        $matches = [];
        $regExpTag = "\"(\[[A-Z0-9_]+[^:]\:)|(\[\/?[A-Z0-9_]+[^]]\])\""; // Regular expression for "TAG_NAME"
        $regExpDescription = "\"\:[\w\s_]+\]\""; // Regular expression for "description"
        $regExpData = "\"\][\w\s_]+\[\""; // Regular expression for "data"

        $tag = self::pregMatch($regExpTag, $string);
        $matches[$tag] = [];

        $description = self::pregMatch($regExpDescription, $string);
        $matches[$tag]['description'] = $description;

        $data = self::pregMatch($regExpData, $string);
        $matches[$tag]['data'] = $data;

        return $matches;
    }

    public static function pregMatch($regExp, $string)
    {
        if (preg_match_all($regExp, $string, $match)) {
            $str = substr($match[0][0], 1);
            $str = substr_replace($str, "", -1);
            return $str;
        } else {
            return '';
        }
    }
}
