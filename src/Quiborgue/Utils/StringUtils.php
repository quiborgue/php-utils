<?php namespace Quiborgue\Utils;
class StringUtils {
	public static function isRegex($str) {
    	$regex = "/^\/[\s\S]+\/$/";
    	return preg_match($regex, $str);
	}

	public static function clearText($text) {
		return str_replace("\t", "", str_replace("\n", "", strip_tags($text)));
	}
}
