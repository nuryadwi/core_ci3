<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Controller extends MY_Controller {
    public function __construct() {
        parent::__construct();

        $this->load->helper( 'app' );
        $this->load->library( 'session' );

        define('THEMES_LOGIN', 'themes/login/' . $this->get_theme( 'login' ) . DIRECTORY_SEPARATOR );
    }
}