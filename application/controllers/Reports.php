<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Reports controller
 *
 * @author Pierre HUBERT
 */

require_once __DIR__."/BaseController.php";

class Reports extends BaseController {

	/**
	 * Public constructor
	 */
	public function __construct(){
		parent::__construct();

		if(!$this->account->signed_in())
			redirect(site_url("login"));
	}

	/**
	 * Main reports page
	 */
	public function index(){

		$page_src = "";

		//Get app information based on its ID
		$app = $this->getAppFromGetID("app");

		//Check if a request has been made to delete a report
		if($this->input->get("delete_report") != null){

			//Get the ID of the report
			$report_name = str_replace("/", "", $this->input->get("delete_report"));

			//Try to delete the report
			if(!$this->reports->delete($app, $report_name))
				$page_src .= $this->get_callout("An error occurred while trying to delete the report !", "alert");
			else
				$page_src .= $this->get_callout("The report was successfully deleted !", "success");

		}


		//Get the list of reports of the application
		$reports = $this->reports->get_list_app($app);

		$page_src .= $this->load->view("reports/v_list_page", array(
			"app" => $app,
			"list" => $reports
		), true);

		//Display the page
		$page_src = $this->display_page("Reports", $page_src);

	}
}