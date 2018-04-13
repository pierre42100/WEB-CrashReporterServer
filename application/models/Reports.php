<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Reports model
 *
 * @author Pierre HUBERT
 */

class Reports extends CI_Model {


	/**
	 * Save a new report
	 *
	 * @param Application $app The target application for the report
	 * @param string $content The content of the report
	 * @return bool TRUE in case of success / FALSE else
	 */
	public function save(Application $app, string $content) : bool {
		
		//Get the application reports target directory
		$report_dir = $this->get_reports_dir($app);

		//Check if the directory exists. If not, create it
		if(!file_exists($report_dir))
			mkdir($report_dir, 0777, true);

		//Generate the name of the report
		$report_name = $this->generateReportName();
		$report_path = $report_dir.$report_name;

		//Intends to save the report
		return file_put_contents($report_path, $content);
	}

	/**
	 * Get the reports target directory
	 *
	 * @param Application $app The target application
	 * @return string The path to the reports directory
	 */
	private function get_reports_dir(Application $app) : string {

		//Generate path directory
		return $this->config->item("data_directory")."reports/".$app->id."/";

	}

	/**
	 * Generate new report name
	 *
	 * @return string The file name for the new report
	 */
	private function generateReportName() : string {
		return time()."-".sha1($_SERVER['REMOTE_ADDR']);
	}
}