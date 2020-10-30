<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend_Controller extends MY_Controller
{
    public function __construct() {
      parent::__construct();
      $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
 		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
 		$this->output->set_header('Pragma: no-cache');
 		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

      $this->load->library('auth');
      $this->user_info = $this->session->user_info;
      $this->info_menu = $this->info_menu();
      $this->breadcrumb = $this->get_breadcrumb();
      $this->url_page = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
      $this->url_module = $this->uri->segment(1) . '/' . $this->uri->segment(2);
      $this->is_root = ((( $this->user_info['user_group_id'] == '0') && ($this->user_info['user_group_name'] == 'root')) ? TRUE : FALSE);

      define('THEMES_BACKEND', 'themes/admin/' . $this->get_theme('admin') . DIRECTORY_SEPARATOR);
    }

    function info_menu() {

    }

    function get_breadcrumb() {

    }


}
