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
	 * Public constructor
	 */
	public function __construct(){
		parent::__construct();

		if(!$this->account->signed_in())
			redirect(site_url("login"));
	}

	/**
	 * Main page of the project
	 */
	public function index(){

		//$page_src = "";

		//Display the page
		//$this->display_page("Home page", $page_src);
		redirect(site_url("apps"));

	}

}