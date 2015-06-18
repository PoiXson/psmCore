<?php
/**
 * psmCore Website Utilities
 *
 * @copyright 2004-2015
 * @license GPL-3
 * @author lorenzo at poixson.com
 * @link http://poixson.com/
 */
namespace psmCore\Utils;

abstract class BasicEnum {

	private static $constMapArrays  = array();



	private function __construct() {}



	protected static function getConstants() {
		$classname = \get_called_class();
		if(!isset(self::$constMapArrays[$classname])) {
			$reflect = new \ReflectionClass($classname);
			self::$constMapArrays[$classname] = $reflect->getConstants();
			unset($reflect);
		}
		return self::$constMapArrays[$classname];
	}



	public static function isValidName($name, $strict=FALSE) {
		$constants = self::getConstants();
		if($strict)
			return \array_key_exists($name, $constants);
		$keys = \array_map('\\strtolower', \array_keys($constants));
		return \in_array(\strtolower($name), $keys);
	}
	public static function isValidValue($value, $strict=FALSE) {
		$values = \array_values(self::getConstants());
		if($strict)
			return \in_array($value, $values);
		$vals = \array_map('\\strtolower', \array_values($constants));
		return \in_array(\strtolower($value), $vals);
	}



	public static function getByName($name, $strict=FALSE) {
		$constants = self::getConstants();
		if($strict) {
			if(!\array_key_exists($name, $constants))
				return NULL;
			return $constants[$name];
		}
		$n = \strtolower($name);
		foreach($constants as $k => $v) {
			if(\strtolower($k) == $n)
				return $v;
		}
		return NULL;
	}
	public static function getByValue($value, $strict=FALSE) {
		$constants = self::getConstants();
		if($strict) {
			$result = \array_search($value, $constants);
			if(!$result)
				return NULL;
			return $result;
		}
		$val = \strtolower($value);
		foreach($constants as $k => $v) {
			if(\strtolower($v) == $val)
				return $k;
		}
		return NULL;
	}



}
