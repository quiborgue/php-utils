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
			} elseif(!array_key_exists($key, $array2) || $array2[$key] != $value) {
				$difference[$key] = $value; 
			}
		} 
		return !isset($difference) ? array() : $difference; 
	}

	public static function doesStructureLookAlike($given, $expected) {
		$isStructureGivenArray = is_array($given);
        $isStructureExpectedArray = is_array($expected);
        if ($isStructureGivenArray != $isStructureExpectedArray) {
            $isStructureGivenArrayStr = $isStructureGivenArray ? "" : "not";
            $isStructureExpectedArrayStr = $isStructureExpectedArray ? "" : "not";
            throw new \Exception("Structure given is $isStructureGivenArrayStr an Array and Structure expected is $isStructureExpectedArrayStr an Array.");
        }
        
        if ($isStructureGivenArray && $isStructureExpectedArray) {
        	if (count($given) == 0 && count($expected) == 0) {
        		return;
        	}

        	self::doesStructureLookAlike($given[0], $expected[0]);
        }
        
        $isStructureGivenObject = is_object($given);
        $isStructureExpectedObject = is_object($expected);
        if ($isStructureGivenObject != $isStructureExpectedObject) {
            $isStructureGivenObjectStr = $isStructureGivenObject ? "" : "not";
            $isStructureExpectedObjectStr = $isStructureExpectedObject ? "" : "not";
            throw new \Exception("Structure given is $isStructureGivenObjectStr an Object and Structure expected is $isStructureExpectedObjectStr an Object.");
        }

        if ($isStructureGivenObject && $isStructureExpectedObject) {
        	$givenObjectArray = (array) $given;
        	$expectedObjectArray = (array) $expected;
        	$diff = array_diff(array_keys($expectedObjectArray), array_keys($givenObjectArray));

        	if (count($diff) > 0) {
        		throw new \Exception("Structure given has " . implode(", ", array_keys($givenObjectArray)) . 
        			" and Structure expected has " . implode(", ", array_keys($expectedObjectArray)) . ".");
        	}

        	foreach ($givenObjectArray as $k => $v) {
        		self::doesStructureLookAlike($v, $expectedObjectArray[$k]);
        	}
        }        
    }
}
            