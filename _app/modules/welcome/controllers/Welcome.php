<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Login_Controller {

	public function index()
	{
		$theme = $this->get_theme('login');
		$data['user'] = [];

		$this->template->title( "Judulnya" );
		$this->template->breadcrumb( "breadcrumb" );
		$this->template->content( 'welcome/welcome_message', $data );
		$this->template->show( THEMES_LOGIN . 'index' );
	}
}
