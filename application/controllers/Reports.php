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

			//Get the name of the report
			$report_name = $this->getGetReportName($app, "delete_report");

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

	/**
	 * View the content of a report
	 */
	public function view(){

		$page_src = "";

		//Get app information based on its ID
		$app = $this->getAppFromGetID("app");

		//Get the name of the report
		$report_name = $this->getGetReportName($app, "report");

		//Get information about the report
		$report = $this->reports->get_full($app, $report_name);

		//Show it
		$page_src .= $this->load->view("reports/v_detailed_report", array(
			"app" => $app,
			"report" => $report
		), true);

		//Display the page
		$this->display_page("View report", $page_src);
	}

	/**
	 * Get the name of a report included in a $_GET request
	 *
	 * @param Application $app Information about the related application
	 * @param string $name The name of the $_GET request included with the query
	 * @return string The name of the report (false in case of failure)
	 */
	private function getGetReportName(Application $app, string $name) : string {

		//Check the existence of the $_GET variable
		if($this->input->get($name) == null)
			$this->exit_fatal("Please specify the ID of a report in '".$name."'!", 400);
		$report_name = (string) $this->input->get($name);

		//Check report name
		if(str_replace("/", "", $report_name) != $report_name || strlen($report_name) < 5)
			$this->exit_fatal("The name of the report is considered as invalid!");

		//Check if the report exists
		if(!$this->reports->exists_name($app, $report_name))
			$this->exit_fatal("Specified report not found!", 404);

		//Return the report
		return $report_name;
	}
}