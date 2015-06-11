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

final class San {
	private final function __construct() {}



	public static function AlphaNum($str) {
		return \preg_replace("/[^a-z0-9]+/i", '', $str);
	}
	public static function AlphaNumSafe($str) {
		return \preg_replace("/[^a-z0-9_-]+/i", '', $str);
	}
	public static function AlphaNumSpaces($str) {
		return \preg_replace("/[^a-z0-9_-\s]+/i", '', $str);
	}
	public static function AlphaNumFile($str) {
		$filter = '[:alnum:]\(\)\_\.\,\'\&\?\+\-\=\!';
		return \preg_replace('/[^'.$filter.']/', '', $str);
	}



//	public static function Filename($filename) {
//		if(is_array($filename))
//			return array_map(__METHOD__, $filename);
//		$filename = trim($filename);
//		if(empty($filename))
//			return '';
//		// shouldn't contain /
//		if(strpos($filename, '/') !== FALSE)
//			fail('Invalid file name, cannot contain \'/\' in '.$filename);
//		if(strpos($filename, '\\') !== FALSE)
//			fail('Invalid file name, cannot contain \'\\\' in '.$filename);
//		// hidden file, contains . dot
//		if(\psm\utils\strings::StartsWith($filename, '.'))
//			fail('Invalid file name, cannot start with . dot in '.$filename);
//		// remove invalid characters
//		$filter = '[:alnum:]\(\)\_\.\,\'\&\?\+\-\=\!';
//		$newname = preg_replace('/[^'.$filter.']/', '', $filename);
//		if($filename != $newname)
//			fail('Invalid file name, contains illegal characters in: '.$newname);
//		return $newname;
//	}
//	public static function Dirpath($dirpath) {
//	}



}
