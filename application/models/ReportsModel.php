<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Reports model
 *
 * @author Pierre HUBERT
 */

class ReportsModel extends CI_Model {


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
	 * Intend to delete a report
	 *
	 * @param Application $app The target application
	 * @param string $name The name of the target report
	 * @return bool TRUE in case of success / FALSE else
	 */
	public function delete(Application $app, string $name) : bool {

		//Security check
		if(strlen($name) < 4 || str_replace("/", "", $name) != $name)
			return FALSE;

		//Determine the path of the report
		$path_report = $this->get_reports_dir($app).$name;

		if(!file_exists($path_report))
			return FALSE;

		//Delete the report and return the result
		return unlink($path_report);
	}

	/**
	 * Get the list of reports of an application
	 *
	 * @param Application $app The target application
	 * @return array The list of reports
	 */
	public function get_list_app(Application $app) : array {

		//Get the application reports target directory
		$report_dir = $this->get_reports_dir($app);

		//Check if the directory exists
		if(!file_exists($report_dir))
			return array(); //Empty list

		$list = array();
		foreach(glob($report_dir."*") as $file){
			$list[] = $this->readReportMetadata($file, new ReportMetadata());
		}


		return $list;
	}

	/**
	 * Check whether a report specified by its name exists or not
	 *
	 * @param Application $app Related application
	 * @param string $name The name of the report to check
	 * @return bool TRUE if the report exists / FALSE else
	 */
	public function exists_name(Application $app, string $name) : bool {

		//Determine the path of the report
		$path_report = $this->get_reports_dir($app).$name;

		return file_exists($path_report);

	}

	/**
	 * Get all the information about a single report
	 *
	 * @param Application $app The target application
	 * @param string $name The name of the report
	 * @return FullReport The report
	 */
	public function get_full(Application $app, string $name) : FullReport {

		//Determine the path of the report
		$path_report = $this->get_reports_dir($app).$name;

		$report = new FullReport();
		$this->readReportMetadata($path_report, $report);
		$report->content = file_get_contents($path_report);
		return $report;
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

	/**
	 * Read the information about a report file and fill a ReportMetada object
	 * with it
	 *
	 * @param string $filename The path of the report file
	 * @param ReportMetadata $obj The object to file
	 * @return ReportMetadata Generated object
	 */
	private function readReportMetadata(string $filename, ReportMetadata $obj) : ReportMetadata {

		//Save file path
		$obj->full_path = $filename;

		//Get informations about the file
		$file = pathinfo($filename);
		$obj->name = $file['basename'];
		$obj->report_size = filesize($filename);
		$obj->creation_date = filemtime($filename);

		return $obj;
	}
}