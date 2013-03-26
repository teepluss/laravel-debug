<?php namespace Teepluss\Debug;

use dump_r\Core as Dumpper;

class Debug {

	public function dump($raw, $ret = false, $html = true, $depth = 1e3, $expand = 1e3)
	{
		return Dumpper::dump_r($raw, $ret, $html, $depth, $expand);
	}

}