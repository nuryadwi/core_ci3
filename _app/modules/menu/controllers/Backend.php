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
         $data['btn_control'] = 'add';
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

   function get_data() {
      $par = ( isset( $_GET['par'] ) ? dec( $_GET['par'] ) : '0' );
      $in = $this->input->post();
      $get = get_datatable( [
         'table' => 'core_menu',
         'sub' => [
            'select' => '
               menu_id,
               menu_parent_menu_id,
               menu_name,
               menu_slug,
               menu_url,
               menu_description,
               menu_class,
               menu_sort,
               menu_is_active,
               menu_name parent_name
            ',
            'where' => "menu_parent_menu_id = '{$par}'",
         ]
      ] );
      header("Content-type: application/json");
      $data = [];
      $no = $in['start']+1;
      foreach ($get['data']->result() as $par => $row) {
         $is_active = '<i class="' . ( ( $row->menu_is_active == '0' ) ? 'mdi mdi-lightbulb' : 'mdi mdi-lightbulb-on' ) . '" style=";font-size:16px;' . ( ( $row->menu_is_active == '0') ? 'color:#000' : 'color:#d6cb22;' ) . '"></i>';
         $edit = '<button act="' . base_url( $this->url_module ) .'/get_form?par=' .enc( [ 'parent_id' => $row->menu_parent_menu_id, 'menu_id' => $row->menu_id ] ) . '" class="btn btn-warning btn-xs btn-edit" title="Edit"><i class="fa fa-edit"></i></button>';
         $row_data = [
            'no' => $no,
            'action' => $edit,
            'menu_parent_menu_id' => $row->menu_parent_menu_id,
            'menu_name' => $row->menu_name,
            'menu_sub' => '<a href="' . base_url( "admin/menu/show?par=" ) . enc( ['menu_id' => $row->menu_id, 'menu_name'] ) . '"><i class="fa fa-align-right"></i></a>',
            'menu_slug' => $row->menu_slug,
            'menu_url' => $row->menu_url,
            'menu_class' => '<i class="' .$row->menu_class. '"></i>',
            'menu_description' => $row->menu_description,
            'menu_order' => $row->menu_sort,
            'menu_is_active' => $is_active,
         ];
         $data[] = $row_data;
         $no++;
      }
      $result = [
         "recordsTotal" => $get['total'],
         "recordsFiltered" => $get['total'],
         "data" => $data
      ];
      echo json_encode( $result );
   }

   function act_show() {
      $arr_output = array();
      $arr_output['message'] = '';
      $arr_output['message_class'] = '';
      $in = $this->input->post();

      //

      echo json_encode( $arr_output );
   }

   function get_form(){
      $par = isset( $_GET['par']) ? dec( $_GET['par'] ) : null;
      $data = [];
      if( ( isset( $par['menu_id'] ) ) && ! empty( $par['menu_id'] ) ) {
         $data['form_title'] = "Edit Menu";
         $data['form_action'] = base_url( $this->url_module . '/act_edit' );
         $params_detail = [
            'select' => '
                  menu_name,
                  menu_url,
                  menu_class,
                  menu_action,
                  menu_description
               ',
            'table' => 'core_menu',
            'where' => [
               'menu_id' => $par['menu_id'],
            ],
         ];
         $query = get_data( $params_detail );
         $row = $query->row();
         $menu_action_active = json_decode( $row->menu_action );
      } else {
         $data['form_title'] = "Tambah Menu";
         $data['form_action'] = base_url( $this->url_module . '/act_save' );
         $row = [];
         $menu_action_active = [];
      }
      $params_parent = [
         'select' => 'menu_name',
         'table' => 'core_menu',
         'where' => ['menu_id' => ( ( isset( $par['parent_id'] ) ) ? $par['parent_id'] : null) ]
      ];
      $query_parent = get_data( $params_parent );
      $params_action = [
         'table' => 'core_menu_action',
         'sort_by' => 'core_menu_id'
      ];
      $query_action = get_data($params_action);
      $disp_menu_action = '';
      $jumlah_action = $query_action->num_rows();
      $jumlah_per_row = ceil( $jumlah_action / 3 );
      $menu_act = $query_action->result_array();
      foreach ($query_action->result() as $key => $value) {
         $checked_action = (
            ( $value->menu_action_name == 'show' ) ?
            'checked disabled' :
            (
               ( in_array( $value->menu_action_name, $menu_action_active) ) ?
               'checked' :
               ''
            )
         );
         $disp_menu_action .= '
         <div class="col-md-4 col-sm-6">
            <div class="custom-control custom-checkbox">
               <input name="menu_action[]" class="custom-control-input" type="checkbox" id="customCheckbox_' . ($value->menu_action_id ) . '" value="' . $value->menu_action_name. '" ' .$checked_action. '>' . ( ( $value->menu_action_name == 'show' ) ? '<input type="hidden" name="menu_action[]" value="show">' : ''). '
               <label for="customCheckbox_' . ( $value->menu_action_id ) . '" class="custom-control-label">' .$value->menu_action_title. '</label>
            </div>
         </div>
         ';
      }

      $data['form_data'] = '
         <div class="row col-12">
            <div class="col-12">
               <label class="col-6">Menu Parent</label>
               <div class="col-6 form-group">
                  <input type="text" class="form-control" value="' .$query_parent->row('menu_name') .'" readonly>
               </div>
            </div>
            <div class="col-md-6">
               <label class="col-12">Menu Name</label>
               <div class="col-12 form-group">
                  <input type="hidden" name="parent_menu" value="' . ( ( ( isset( $par['patent_id'] ) ) && ! empty( $par['parent_id'] ) ) ? $par['parent_id'] : "0" ) . '">
                  <input type="hidden" name="menu_id" value="' . ( ( ( isset( $par['menu_id'] ) ) && ! empty( $par['menu_id'] ) ) ? $par['menu_id'] : "0" ) . '">
                  <input class="form-control" name="menu_name" value="' . ( ( empty( $row ) ) ? '' : $row->menu_name ) . '" required placeholder="Nama Menu">
               </div>
               <label class="col-12">Menu Class Icon</label>
               <div class="col-12 form-group">
                  <input class="form-control" name="menu_class" value"' . ( ( empty( $row ) ) ? '' : $row->menu_class ) .'" required placeholder="class menu">
               </div>
            </div>
            <div class="col-md-6">
               <label class="col-12">Menu URL</label>
               <div class="col-12 form-group">
                  <input class="form-control" name="menu_url" value="' .( ( empty( $row ) ) ? '': $row->menu_url ). '" required placeholder="URL">
               </div>
               <label class="col-12">Menu Description</label>
               <div class="col-12 form-group">
                  <textarea class="form-control" name="menu_description">' .( ( empty( $row) ) ? '' : $row->menu_description ) .'</textarea>
               </div>
            </div>
            <div class="col-12">
               <label class="col-6">Action: </label>
               <div class="row col-12">
                  ' .$disp_menu_action. '
               </div>
            </div>
         </div>
      ';
      $this->load->view('general/Form_view', $data);
   }

   function act_save($value='') {
      $in = $this->input->post();

   }
}
