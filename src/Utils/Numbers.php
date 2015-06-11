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

final class Numbers {
	private final function __construct() {}



	##########
	## Math ##
	##########



	/**
	 * Check the min and max of a value and return the result.
	 * @param int $value -
	 * @param int $min -
	 * @param int $max -
	 * @return int value
	 */
	public static function MinMax($value, $min=FALSE, $max=FALSE) {
		if($min !== FALSE && $value < $min) return $min;
		if($max !== FALSE && $value > $max) return $max;
		return $value;
	}



	############
	## Format ##
	############



	public static function roundDec($val, $places) {
		if($places < 0)
			return $val;
		if($places == 0)
			return \round($val);
		$pow = \pow(10, $places);
		$str = (string) (\round($val * $pow) / $pow);
		$pos = \strrpos($str, '.');
		if($pos === FALSE)
			return $str.'.'.\str_repeat('0', $places);
		$pos = (\strlen($str) - $pos) - 1;
		if($pos < $places)
			return $str.\str_repeat('0', $places - $pos);
		return $str;
	}



	/**
	 * Convert bytes to human readable format.
	 * @param int $size - Integer in bytes to convert.
	 * @return string - Formatted size.
	 */
	public static function formatBytes($size) {
		$size = (int) $size;
		if($size < 0) return NULL;
		if(     $size < 1024)          return \round($size                , 0).'&nbsp;Bytes';
		else if($size < 1048576)       return \round($size / 1024         , 2).'&nbsp;KB';
		else if($size < 1073741824)    return \round($size / 1048576      , 2).'&nbsp;MB';
		else if($size < 1099511627776) return \round($size / 1073741824   , 2).'&nbsp;GB';
		else                           return \round($size / 1099511627776, 2).'&nbsp;TB';
	}



	/**
	 * Convert a number to roman numerals.
	 * @param int $value -
	 * @param int $max -
	 * @return string - Roman numerals string representing input number.
	 */
	public static function NumberToRoman($value, $max=FALSE) {
		$value = (int) $value;
		if($max !== FALSE) {
			if($value > $max)
				return ((string) $value);
		}
		$result = '';
		$lookup = array(
				'M' => 1000,
				'CM'=> 900,
				'D' => 500,
				'CD'=> 400,
				'C' => 100,
				'XC'=> 90,
				'L' => 50,
				'XL'=> 40,
				'X' => 10,
				'IX'=> 9,
				'V' => 5,
				'IV'=> 4,
				'I' => 1
		);
		foreach($lookup as $roman => $num) {
			$matches = \intval($value / $num);
			$result .= \str_repeat($roman, $matches);
			$value = $value % $num;
		}
		return $result;
	}



	##########
	## Time ##
	##########



	/**
	 * String to seconds.
	 * @param string $text - String to convert.
	 * @return int seconds
	 */
	public static function StringToSeconds($text) {
		$str = '';
		$value = 0;
		for($i = 0; $i < \strlen($text); $i++) {
			$s = \substr($text, $i, 1);
			if(\is_numeric($s)) {
				$str .= $s;
				continue;
			}
			if($s === ' ') continue;
			$val = (int) $str;
			$str = '';
			if($val == 0) continue;
			switch(\strtolower($s)) {
				case 'n':
					$value += ($val * \psmCore\S_MS);
					break;
				case 's';
				$value += ($val * \psmCore\S_SECOND);
				break;
				case 'm':
					$value += ($val * \psmCore\S_MINUTE);
					break;
				case 'h':
					$value += ($val * \psmCore\S_HOUR);
					break;
				case 'd':
					$value += ($val * \psmCore\S_DAY);
					break;
				case 'w':
					$value += ($val * \psmCore\S_WEEK);
					break;
				case 'o':
					$value += ($val * \psmCore\S_MONTH);
					break;
				case 'y':
					$value += ($val * \psmCore\S_YEAR);
					break;
				default:
					continue;
			}
		}
		return $value;
	}
	/**
	 * Seconds to string.
	 * @param int $seconds - Integer to convert.
	 * @return string
	 */
	public static function SecondsToString($seconds) {
		$result = array();
		// years
		if($seconds > \psmCore\S_YEAR) {
			$t = \floor($seconds / \psmCore\S_YEAR);
			$seconds = $seconds % \psmCore\S_YEAR;
			$result[] = $t.' Year'.
					($t > 1 ? 's' : '');
		}
		// days
		if($seconds > \psmCore\S_DAY) {
			$t = \floor($seconds / \psmCore\S_DAY);
			$seconds = $seconds % \psmCore\S_DAY;
			$result[] = $t.' Day'.
					($t > 1 ? 's' : '');
		}
		// hours
		if($seconds > \psmCore\S_HOUR) {
			$t = \floor($seconds / \psmCore\S_HOUR);
			$seconds = $seconds % \psmCore\S_HOUR;
			$result[] = $t.' Hour'.
					($t > 1 ? 's' : '');
		}
		// minutes
		if($seconds > \psmCore\S_MINUTE) {
			$t = \floor($seconds / \psmCore\S_MINUTE);
			$seconds = $seconds % \psmCore\S_MINUTE;
			$result[] = $t.' Minute'.
					($t > 1 ? 's' : '');
		}
		// seconds
		if($seconds > 0) {
			$result[] = $seconds.' Second'.
					($seconds > 1 ? 's' : '');
		}
		if(\count($result) == 0)
			return '--';
		return \implode('  ', $result);
	}



}
