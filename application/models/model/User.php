<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User model
 *
 * @author Pierre HUBERT
 */

class User {

	//ID of the user
	public $id;

	//Name of the user
	public $name;

	//Email address of the user
	public $email;

	//Password of the user (crypted)
	public $password;

	/**
	 * Check if the entry is valid or not
	 *
	 * @return bool TRUE if the entry is valid / FALSE else
	 */
	public function isValid() : bool {
		return (int) $this->id > 0;
	}

}