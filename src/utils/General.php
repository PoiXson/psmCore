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

final class General {
	private final function __construct() {}



	/**
	 * @return double - Returns current timestamp in milliseconds.
	 */
	public static function getTimestamp() {
		$time = \explode(' ', \microtime(), 2);
		return ( ((double) $time[0]) + ((double) $time[1]) );
	}



}
