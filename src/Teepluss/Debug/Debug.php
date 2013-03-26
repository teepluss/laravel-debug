<?php namespace Teepluss\Debug;

use dump_r\Type, dump_r\Rend;
use dump_r\Core as BaseDump;

class Debug extends BaseDump {

	/**
	 * Fixed line error.
	 *
	 * @param  mixed   $raw
	 * @param  boolean $ret
	 * @param  boolean $html
	 * @param  integer $depth
	 * @param  integer $expand
	 * @return string
	 */
	public static function dump_r($raw, $ret = false, $html = true, $depth = 1e3, $expand = 1e3)
	{
		$root = Type::fact($raw, $depth);

		// get the input arg passed to the function
		$src = debug_backtrace();

		$idx = ( ! isset($src[0]['file'])) ? 3 : (strpos($src[0]['file'], 'Debug.php') ? 2 : 1);


		$src = (object)$src[$idx];
		$file = file($src->file);

		$line = $file[$src->line - 1];

		preg_match('~(dump|dump_r)\((.+?)(?:,|\)(;|\?>))~', $line, $m);

		$key = $m[2];

		if (PHP_SAPI == 'cli' || !$html)
			$out = Rend::text0($src->file, $src->line, $key, $root);
		else
			$out = Rend::html0($src->file, $src->line, $key, $root, $expand);

		if ($ret)
			return $out;

		echo $out;
	}

	/**
	 * In alias of dump_r
	 *
	 * @return dump_r
	 */
	public function dump()
	{
		return call_user_func_array(array($this, 'static::dump_r'), func_get_args());
	}

}