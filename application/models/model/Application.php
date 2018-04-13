<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application model
 *
 * @author Pierre HUBERT
 */

class Application {

	//Data about the application
	public $id;
	public $name;
	public $description;
	public $key;
	public $secret;

	/**
	 * Check if the entry is valid or not
	 *
	 * @return bool TRUE if the entry is valid / FALSE else
	 */
	public function isValid() : bool {
		return (int) $this->id > 0;
	}

}