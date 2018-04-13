<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Data helper
 *
 * @author Pierre HUBERT
 */

if(!function_exists("path_data")){


	/**
	 * Get the system path to data helper
	 *
	 * @param string $uri The URI pointing to a file (optionnal)
	 * @return string The full path to data helper
	 */
	function path_data(string $uri = "") : string {
		return get_instance()->config->item("data_directory");
	}
	
}

if(!function_exists("human_filesize")){

	/**
	 * Turn an amount of bytes into a human readable string
	 *
	 * @param int $bytes The amount of bytes to convert
	 * @param int $decimals The number of decimals to show
	 * @return string The human-readable string
	 */
	function human_filesize(int $bytes, int $decimals = 2) : string {
		$factor = floor((strlen($bytes) - 1) / 3);
		if ($factor > 0) $sz = 'KMGT';
		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
	}
}