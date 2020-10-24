<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
		$theme = $this->get_theme('login');
		disp($theme);
		die();
		$this->load->view('welcome_message');
	}
}
