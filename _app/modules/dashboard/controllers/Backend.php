<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend extends Backend_Controller
{
    public function __construct()
    {
       parent::__construct();

    }

    function index() {
        $this->show();
    }

    function show() {
        $data = [];
		$this->template->breadcrumb($this->breadcrumb);
		$this->template->title("Dashboard");
		$this->template->content("dashboard/Dashboard", $data);

        $this->template->show(THEMES_BACKEND . 'index');
    }
}
