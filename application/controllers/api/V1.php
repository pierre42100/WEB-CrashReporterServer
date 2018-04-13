<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * First version of the API
 *
 * @author Pierre HUBERT
 */

class V1 extends CI_Controller {

	/**
	 * Public constructor
	 */
	public function __construct(){
		parent::__construct();

		//This version of the API does only support JSON
		header("Content-Type: application/json");
	}

	/**
	 * Push a report to the server
	 */
	public function push(){

		//Get the target application by its key
		$app = $this->getAppByPostKey("app_key");

		//Get the report
		$report = $this->getPostReport("report");

		//Save the report
		if(!$this->reports->save($app, $report))
			$this->exit_fatal("An error occured while trying to save the report!", 500);

		//Success
		$this->return_info(array(
			"success" => "The report has been sucessfully saved !"
		), 200);
	}

	/**
	 * Get an Application by its key specified in the request
	 *
	 * @param string $name The name  of the post field that contain the key of the application
	 * @return Application The application object (The page crash in case of failure)
	 */
	private function getAppByPostKey(string $name) : Application {

		//Check if the app key was specified in the request
		if($this->input->post($name) == null)
			$this->exit_fatal("Please specify an application key in '".$name."' !", 400);
		$app_key = (string) $this->input->post($name);

		//Try to get the application by its key
		$app = $this->applications->get_by_key($app_key);

		//Check if the key is valid
		if(!$app->isValid())
			$this->exit_fatal("Could not get an application with this key!", 404);

		//Return the application
		return $app;
	}

	/**
	 * Get a report sent in a POST request
	 *
	 * @param string $name The name of the post field containing the report
	 * @return string The report (page crash in case of failure)
	 */
	private function getPostReport(string $name) : string {

		//Check if the report was specified in the request
		if($this->input->post($name) == null)
			$this->exit_fatal("Please specify the report in '".$name."' !", 400);
		$report = $this->input->post($name);

		//Check the report length
		if(strlen($report) < 10)
			$this->exit_fatal("The report is too short !", 400);

		if(strlen($report) > 10000)
			//Reduce report length if required
			$report = substr($report, 0, 10000);

		//Return the report
		return str_replace("<", "&lt;", $report);

	}

	/**
	 * Exit with a fatal error
	 *
	 * @param string $message The message of the error
	 * @param int $code The code of the error
	 */
	private function exit_fatal(string $message, int $code) {
		$this->return_info(
			array(
			"error" => array(
				"code" => $code,
				"message" => $message
			)
		), $code);
		exit();
	}

	/**
	 * Return information
	 *
	 * @param array $data The data to return to the screen
	 * @param int $code The http response code (200 by default)
	 */
	public function return_info(array $data, int $code = 200){
		http_response_code($code);
		echo json_encode($data);
	}
}