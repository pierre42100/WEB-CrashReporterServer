<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Applications model
 *
 * @author Pierre HUBERT
 */

class Applications extends CI_Model {
	
	/**
	 * Table name
	 */
	const TABLE_NAME = "apps";

	/**
	 * Intend to create an application
	 *
	 * @param Application $app The application to create
	 * @return bool TRUE in case of success / FALSE else
	 */
	public function create(Application $app) : bool {

		//Generate database entry
		$entry = $this->appToDb($app);

		//Intend to create the entry
		return $this->db->insert(self::TABLE_NAME, $entry);
	}

	/**
	 * Fetch and return the list of applications
	 *
	 * @return array The list of applications
	 */
	public function get_list() : array {

		//Perform the request on the database
		$this->db->from(self::TABLE_NAME);

		return $this->process_get_multiple();

	}

	/**
	 * Get an application by its key
	 *
	 * @param string $key The key of the application
	 * @return Application Information about the application / invalid
	 * object in case of failure
	 */
	public function get_by_key(string $key) : Application {

		//Perform the request on the database
		$this->db->from(self::TABLE_NAME);
		$this->db->where("key", $key);

		return $this->process_get_single();

	}

	/**
	 * Perform and handle a request with multiple results
	 *
	 * @return array The list of applications
	 */
	private function process_get_multiple() : array {

		$query = $this->db->get();

		//Process the list
		$list = array();
		foreach ($query->result() as $row) {
			$list[] = $this->dbToApp($row);
		}

		return $list;

	}

	/**
	 * Handle retrievement and processing of a single application entry
	 *
	 * @return Application Information about the application / Invalid application
	 * object in case of failure
	 */
	private function process_get_single() : Application {

		$query = $this->db->get();

		//Process the list
		foreach ($query->result() as $row) {
			return $this->dbToApp($row);
		}

		//If we got there, the application was not found
		return new Application();

	}

	/**
	 * Turn a database entry into an application object
	 *
	 * @param stdClass $row The database entry
	 * @return Application Generated application object
	 */
	private function dbToApp(stdClass $row) : Application {

		$app = new Application();

		$app->id = $row->id;
		$app->name = $row->name;
		$app->description = $row->description;
		$app->key = $row->key;
		$app->secret = $row->secret;

		return $app;
	}

	/**
	 * Turn an application object into a database entry
	 *
	 * @param Application $app The application to convert
	 * @return Generated database entry
	 */
	private function appToDb(Application $app) : array {

		$row = array();

		$row['name'] = $app->name;
		$row['description'] = $app->description;
		$row['key'] = $app->key;
		$row['secret'] = $app->secret;

		return $row;

	}


}