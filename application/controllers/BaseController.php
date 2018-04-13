<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Base controller for all the project
 *
 * @author Pierre HUBERT
 */

class BaseController extends CI_Controller {

	
	/**
	 * Display a page with html inclusions...
	 *
	 * @param string $title The title of the page
	 * @param string $page_src The source code of the page to display
	 */
	protected function display_page(string $title, string $page_src){

		//Get page head
		$src = $this->load->view("common/v_head", array(
			"title" => $title
		), true);

		//Append app bar to the source code if the user is signed in
		if($this->account->signed_in())
			$page_src = $this->load->view("common/v_appbar", array(
				"user" => $this->account->get_current_info(),
			), true) . $page_src;

		//Get page body
		$src .= $this->load->view("common/v_body", array(
			"page_src" => $page_src
		), true);

		//Display the page
		echo $src;

	}

	/**
	 * Generate a callout and return its source code
	 *
	 * @param string $message The message of the callout
	 * @param string $kind The kind of callout
	 * @return string Generated source code
	 */
	protected function get_callout(string $message, string $kind = "success") : string {
		return "<div class='remark ".$kind." app-container'>".$message."</div>";
	}

	/**
	 * Display a fatal error message and exit
	 *
	 * @param string $message The message to display on the screen
	 * @param int $code The error code (default: 500)
	 */
	protected function exit_fatal(string $message, int $code = 500){

		//Set the response code
		http_response_code($code);

		//Display a page with the fatal error
		$this->display_page("Fatal error", $this->get_callout($message, "alert"));
		exit();

	}

	/**
	 * Get information about an app specified by its ID in the URL
	 *
	 * @param string $name The name of the $_GET field
	 * @return Application The target application (the page exit in case of failure)
	 */
	protected function getAppFromGetID(string $name) : Application {

		//Check the existence of the $_GET argument
		if($this->input->get($name) == null)
			$this->exit_fatal("Please specify the ID of the app in '".$name."'!", 400);
		$appID = (int) $this->input->get($name);

		//Try to get information about the app
		$app = $this->applications->get_by_id($appID);

		//Check for errors
		if(!$app->isValid())
			$this->exit_fatal("Specified application not found!", 404);

		//Return application
		return $app;
	}

}