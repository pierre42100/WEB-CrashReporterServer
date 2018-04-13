<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Account model
 *
 * @author Pierre HUBERT
 */

class Account extends CI_Model {

	/**
	 * The name of the users table
	 */
	const TABLE_NAME = "users";

	/**
	 * The name of the session variable
	 */
	const SESSION_VAR_NAME = "cr_user";

	/**
	 * Check whether the user is signed in or not
	 *
	 * @return bool TRUE if the user is signed in / FALSE else
	 */
	public function signed_in() : bool {
		return isset($_SESSION[self::SESSION_VAR_NAME]);
	}

	/**
	 * Intend to sign in user
	 *
	 * @param string $email The email
	 * @param string $password
	 * @return bool TRUE : signed in / FALSE else
	 */
	public function sign_in(string $email, string $password) : bool {
		
		//Perform a request over the database
		$this->db->from(self::TABLE_NAME);
		$this->db->where("email", $email);
		$user = $this->process_get_single();

		//Check if the user is valid
		if(!$user->isValid())
			return false;

		//Check the password
		if(!$this->check_password($user->password, $password))
			return false;

		//Now we can store user information into the session
		$_SESSION[self::SESSION_VAR_NAME] = $user->id;

		//Success
		return true;
	}

	/**
	 * Get current user information
	 *
	 * @return User Information about the current user
	 */
	public function get_current_info() : User {

		//Perform a request in the database
		$this->db->from(self::TABLE_NAME);
		$this->db->where("id", $_SESSION[self::SESSION_VAR_NAME]);

		return $this->process_get_single();

	}

	/**
	 * Sign out the user
	 */
	public function sign_out(){
		if(isset($_SESSION[self::SESSION_VAR_NAME]))
			unset($_SESSION[self::SESSION_VAR_NAME]);
	}

	/**
	 * Crypt user passord
	 *
	 * @param string $password Password in clear
	 * @return string Encrypted password
	 */
	private function crypt_password(string $password) : string {
		return password_hash($password, PASSWORD_DEFAULT);
	}

	/**
	 * Check a given password
	 *
	 * @param string $hash The crypted password to check
	 * @param string $password Password in clear to check
	 * @return bool TRUE if the password are the same / FALSE else
	 */
	private function check_password(string $hash, string $password) : bool {
		return password_verify($password, $hash);
	}

	/**
	 * Process the retrievement of a single entry
	 *
	 * @return User The generated user object / invalid user object in 
	 * case of failure
	 */
	private function process_get_single() : User {

		//Perform the request
		$query = $this->db->get();

		foreach ($query->result() as $row) {
			return $this->dbToUser($row);
		}

		//If we got here, the user was not found => return invalid object
		return new User();

	}

	/**
	 * Convert a database entry into a User object
	 *
	 * @param stdClass $row Database entry
	 * @return User Generated user object
	 */
	private function dbToUser(stdClass $row) : User {

		$user = new User();
		$user->id = $row->id;
		$user->name = $row->name;
		$user->email = $row->email;
		$user->password = $row->password;
		return $user;
	}
}