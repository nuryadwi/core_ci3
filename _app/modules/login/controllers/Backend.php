<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends Login_Controller {

    public function __construct() {
		parent::__construct();
	}

    function index()
    {
        $this->show();
    }
    
    function show()
	{
        $data = array();
		$data['status'] = 0;
		$data['link_post'] = base_url( 'admin/login/auth' );
        $this->template->customize_params( $data );
		$this->template->show( THEMES_LOGIN . 'index' );
    }
    
}
