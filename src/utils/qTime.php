<?php
/**
 * psmCore Website Utilities
 *
 * @copyright 2004-2015
 * @license GPL-3
 * @author lorenzo at poixson.com
 * @link http://poixson.com/
 */
namespace psmCore\utils;

class qTime {

	protected $start = \psmCore\INT_MIN;
	protected $last  = \psmCore\INT_MIN;



	public function __construct($startNow=TRUE) {
		if($startNow)
			$this->Start();
	}



	public function Start() {
		$this->start = self::getTimestamp();
	}



	public function getTimeSinceStart() {
		$now   = self::getTimestamp();
		$start = $this->start;
		if($start == \psmCore\INT_MIN)
			return FALSE;
		if($start > $now)
			return 0;
		return $now - $start;
	}
	public function getTimeSinceLast() {
		$now   = self::getTimestamp();
		$start = $this->start;
		$last  = $this->last;
		if($last == \psmCore\INT_MIN) {
			if($start == \psmCore\INT_MIN)
				return FALSE;
			$last = $start;
		}
		if($last > $now)
			return 0;
		$since = $now - $last;
		$this->last = $now;
		return $since;
	}



	public static function getTimestamp() {
		return General::getTimestamp();
	}



}
