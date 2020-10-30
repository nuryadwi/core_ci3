<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend_Controller extends MY_Controller
{
    public function __construct() {
        parent::__construct();
        $this->info_menu = $this->info_menu();
        $this->user_info = $this->session->user_info;
        $this->breadcrumb = $this->get_breadcrumb();
        $this->url_page = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
        $this->url_module = $this->uri->segment(1) . '/' . $this->uri->segment(2);

        define('THEMES_BACKEND', 'themes/admin/' . $this->get_theme('admin') . DIRECTORY_SEPARATOR);
    }

    function info_menu() {
        
    }

    function get_breadcrumb() {

    }


}
