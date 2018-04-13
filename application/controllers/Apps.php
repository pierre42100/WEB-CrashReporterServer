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

		//Add create form
		$page_src .= $this->load->view("apps/v_form", array(), true);

		//Display page
		$this->display_page("Applications", $page_src);
	}

}