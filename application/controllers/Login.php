<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login controller
 *
 * @author Pierre HUBERT
 */

require_once __DIR__."/BaseController.php";

class Login extends BaseController {

	/**
	 * Main login page
	 */
	public function index(){

		//Check if the user submitted the form
		if($this->input->post("email") != null &&
			$this->input->post("password") != null){

			//Try to sign in user
			if(!$this->account->sign_in($this->input->post("email"), $this->input->post("password")))
				$error = "Could not sign you in with the given credentials !";
			else
				redirect(site_url());

		}

		//Load page
		$page_src = $this->load->view("login/v_main", array(
			"error" => isset($error) ? $error : false
		), true);

		//Display page
		$this->display_page("Login", $page_src);

	}

}