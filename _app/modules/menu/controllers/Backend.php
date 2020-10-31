<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * core menu setting
 */
class Backend extends Backend_Controller {

   function __construct() {
      parent::__construct();
   }
   function index() {
      $this->show();
   }
   function show() {
      $par = isset( $GET['par']) ? dec($_GET['par']) : null;
      $data = array();
      $data['is_superuser'] = ( $this->user_info['user_group_name'] == 'super-admin') ? TRUE : FALSE;
      $data['table'] = [
         'columns' => "[
            { data:'no', title:'No', searchable:false, orderable:false, width:'5%', },
				{ data:'action', title:'Aksi', searchable:false, orderable:false, width:'10%' },
				{ data:'menu_sub', title:'Sub Menu', width:'5%', orderable:false, searchable: false},
				{ data:'menu_name', title:'Menu Name', width:'15%', orderable:true, align:'left', searchable: true, searchdata: { type: 'input' } },
				{ data:'menu_slug', title:'Slug', width:'15%', orderable:true, align:'left', searchable: true, searchdata: { type: 'input' } },
				{ data:'menu_url', title:'URL', width:'15%', orderable:true, align:'left', searchable: true, searchdata: { type: 'input' } },
				{ data:'menu_class', title:'Class', width:'5%', orderable:true, align:'center', searchable: false },
				{ data:'menu_description', title:'Deskription',  width:'25%', orderable:true, align:'left', searchable: true, searchdata: { type: 'input' } },
				{ data:'menu_is_active', title:'Status', width:'5%', orderable:true, align:'center', searchable: true, searchdata: { type: 'option' } },
         ]",
         'order' => "[[2,'asc']]",
      ];
      if (empty( $par ) ) {
         $data['table']['title'] = 'Tabel Menu';
         $data['table']['url'] = site_url("admin/menu/get_data");
         $this->template->breadcrumb( $this->breadcrumb );
         $data['url_add'] = site_url( $this->url_module ) .'/get_form';
      } else {
         $data['table']['url'] = site_url("admin/menu/get_data?par=" ) . enc($par['menu_id']);
         $data['table']['title'] = "Tabel Sub Menu";
         $breadcrumb = [
            "Sub Menu" => "admin/menu/show?par=" . $_GET['par']
         ];
         $this->template->breadcrumb( array_merge ($this->breadcrumb , $breadcrumb ) );
         $data['url_add'] = site_url( $this->url_module ) . "/get_form?par=" . enc( [ 'parent_id' => $par['menu_id'] ] );
      }
      $this->template->title( 'Menu' );
		$this->template->content( "general/Table_view", $data );
		$this->template->show( THEMES_BACKEND . 'index' );
   }

   function get_form() {
      $data = [];
      $this->load->view('general/Form_view', $data);
   }
}
