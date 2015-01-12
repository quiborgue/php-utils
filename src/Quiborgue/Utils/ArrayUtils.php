<?php namespace Quiborgue\Utils;
class ArrayUtils {
	public static function diffAssocRecursive($array1, $array2) { 
		if (count($array2) > count($array1)) {
			$aux = $array1;
			$array1 = $array2;
			$array2 = $aux;
		}
		
		foreach($array1 as $key => $value) {
			if(is_array($value)) { 
				if(!isset($array2[$key])) { 
					$difference[$key] = $value; 
				} elseif(!is_array($array2[$key])) { 
					$difference[$key] = $value; 
				} else { 
					$new_diff = self::diffAssocRecursive($value, $array2[$key]); 
					if($new_diff != FALSE) { 
						$difference[$key] = $new_diff; 
					} 
				} 
			} elseif(!isset($array2[$key]) || $array2[$key] != $value) { 
				$difference[$key] = $value; 
			}
		} 
		return !isset($difference) ? array() : $difference; 
	}
}