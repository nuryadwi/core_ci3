<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function set_template($view_type= null, $view_content = '', $data= array() ) {
   $configuration = site_configuration();

   switch ($view_type) {
      case 'frontend':
			$template 		= $configuration['frontend_themes'];
			$template_file	= 'home';
			break;

		case 'backend':
			$template 		= $configuration['backend_themes'];
			$template_file	= 'admin';
			break;

		case 'login':
			$template 		= $configuration['login_themes'];
			$template_file	= 'login';
			break;

		default:
			$template_file = 'home';
			break;
   }
   if($view_content == '') {
      $CI->load->custom_view('template/' . $view_type. '/'. $template, $template_file, $data);
   } else {
      $CI->load->view($views, $data);
   }
}

function site_configuration() {
   $param = array(
      'table' => 'core_configuration',
      'select' => 'configuration_name, configuration_value'
   );
   $query = get_data($param);

   $site_configuration = array();
   if( $query->num_rows() > 0) {
      foreach ($query->result() as $row) {
         $site_configuration[$row->configuration_name] = $row->configuration_value;
      }
   }
   return $site_configuration;
}

if (! function_exists('action') ) {
   function action($act = null, $menu = null) {
      $CI = & get_instance();
      $is_true = false;
      // disp($CI->info_menu->menu_id);
      // die();
      if( $CI->user_info['user_group_id'] == 1){
         $is_true = true;
      }else{
         if($act !=null) {
            if( $menu == null ) {
               $get_act = get_data(
                     [
                        'table' => 'core_user_group_role',
                        'select' => 'user_group_role_menu_action action',
                        'where' => [
                           'user_group_role_user_group_id' => $CI->user_info['user_group_id'],
                           'user_group_role_menu_id' => $CI->info_menu->menu_id,
                        ]
                     ]
               );
            } else {
               $get_act = get_data([
                  'table' => [
                     'core_user_group_role' => 'menu_id = user_group_role_menu_id',
                  ],
                  'select' => 'user_group_role_menu_action',
                  'where' => [
                     'user_group_role_user_group_id' => $CI->user_info['user_group_id'],
                     'menu_url' => $menu,
                  ]
               ]);
            }

            if( $get_act->num_rows() > 0 ){
               if( in_array( $act, json_decode($get_act->row('action') ) ) ) {
                  $is_true = true;
               }
            }
         }
      }
      return $is_true;
   }
}

if( !function_exists('all_action') ) {
   function all_action($url='') {
      
   }
}

if( !function_exists( 'generate_menu') ) {
   function generate_menu($btn,$url_module='') {

   }
}
