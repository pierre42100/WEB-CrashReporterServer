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

		//Get page body
		$src .= $this->load->view("common/v_body", array(
			"page_src" => $page_src
		), true);

		//Display the page
		echo $src;

	}

}