<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
		$theme = $this->get_theme('login');
		$data = [];
		$res = $this->createRespon(200,'OK', $data);
		disp($res);
		die();
		$this->load->view('welcome_message');
	}
}
