<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home controller
 *
 * @author Pierre HUBERT
 */

require_once __DIR__."/BaseController.php";

class Home extends BaseController {

	/**
	 * Main page of the project
	 */
	public function index(){

		$page_src = "";

		//Display the page
		$this->display_page("Home page", $page_src);

	}

}