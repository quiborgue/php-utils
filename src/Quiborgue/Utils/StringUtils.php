<?php namespace Quiborgue\Utils;
class StringUtils {
	public static function isRegex($str) {
    	$regex = "/^\/[\s\S]+\/$/";
    	return preg_match($regex, $str);
	}
}
