<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Applications controller
 *
 * @author Pierre HUBERT
 */

require_once __DIR__."/BaseController.php";

class Apps extends BaseController {

	/**
	 * Public constructor
	 */
	public function __construct(){
		parent::__construct();

		if(!$this->account->signed_in())
			redirect(site_url("login"));
	}

	/**
	 * List of applications
	 */
	public function index(){

		$page_src = "";

		//Check if a request has been made to create an application
		if($this->input->post("app_name") != null &&
			$this->input->post("app_description") != null &&
			$this->input->post("app_key") != null &&
			$this->input->post("app_secret") != null){

			//Create and populate an Application object
			$app = new Application();
			$app->name = $this->input->post("app_name");
			$app->description = $this->input->post("app_description");
			$app->key = $this->input->post("app_key");
			$app->secret = $this->input->post("app_secret");

			//Try to save the application into the database
			if(!$this->applications->create($app))
				$this->exit_fatal("An error occurred while trying to create the application!");
			else
				$page_src .= $this->get_callout("The application has been successfully created!", "success");
		}

		//Get the list of applications
		$apps_list = $this->applications->get_list();

		//Add create form
		$page_src .= $this->load->view("apps/v_form", array(), true);

		//Display the list of application
		$page_src .= $this->load->view("apps/v_list", array(
			"list" => $apps_list
		), true);

		//Display page
		$this->display_page("Applications", $page_src);
	}

}