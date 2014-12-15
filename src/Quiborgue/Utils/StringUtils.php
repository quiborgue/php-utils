<?php namespace Quiborgue\Utils;
class StringUtils {
	public static function is_regex($str) {
    	$regex = "/^\/[\s\S]+\/$/";
    	return preg_match($regex, $str);
	}
}
