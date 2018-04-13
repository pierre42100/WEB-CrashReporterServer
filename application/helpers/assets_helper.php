<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Assets helper
 *
 * @author Pierre HUBERT
 */

if(!function_exists("path_assets")){

	/**
	 * Get and return the path to an asset
	 *
	 * @param string $uri The URI pointing on the asset
	 * @return string The full path to the asset
	 */
	function path_assets(string $uri = "") : string {

		return base_url()."assets/".$uri;

	}

}