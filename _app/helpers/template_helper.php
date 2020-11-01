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
      $CI = & get_instance();
      $url_module = $CI->uri->segment(1) . '/' . $CI->uri->segment(2);
      $link = ( ( $url == '') ? $url_module . '/show' : $url );
      if ( $CI->user_info['user_group_id'] == 0 ){
         $get_act = get_data([
            'table'  => 'core_menu',
            'select' => 'menu_action',
            'where'  => [
               'menu_url' => $link,
            ],
         ])->row('menu_action');
      } else {
         if( $link == '' ) {
            $where = [
               'user_group_role_user_group_id' => $CI->user_info['user_group_id'],
               'user_group_role_menu_id'  => $CI->info_menu->menu_id,
            ];
         } else {
            $where = [
               'user_group_role_user_group_id' => $CI->user_info['user_group_id'],
               'menu_url' => $link,
            ];
         }
         $get_act = get_data([
            'table' => [
               'core_user_group_role' => '',
               'core_menu' => 'menu_id = user_group_role_user_group_id'
            ],
            'select' => 'user_group_role_menu_action menu_action',
            'where'  => $where,
         ])->row('menu_action');
      }
      $result = [];
      if ( ! empty( $get_act) ) {
         $all_act = json_decode( $get_act, true );
         $jml = count($all_act);
         $where_in = ')';
         $menu_act = get_data([
            'table' => 'core_menu_action',
            'select' => 'menu_action_name, menu_action_title, menu_action_icon, menu_action_color',
            'where' => [
               'menu_action_name IN' . $where_in => null
            ]
         ])->result();
         foreach ($menu_act as $key => $action) {
            $result[$action->menu_action_name] = $action;
         }
      }
      $result;
   }
}

if( !function_exists( 'generate_menu') ) {
   function generate_menu($btn,$url_module='') {
      $action = all_action( $url_module );
      $html = '';
      if ( $action ) {
         foreach ($btn as $name => $act) {
            $html .= ( ( array_key_exists( $name, $action ) ) ?
               '<button
                  type="button"
                  act="' . $act['link'] .'"
                  class = "btn btn-sm btn-' . $act['size'] . ' btn-' . ( ( isset( $act['is_modal'] ) ) ? 'form' : $action[$name]->menu_action_name ) .'"
                  style ="background-color:' .$action[$name]->menu_action_color . ';border-color:' . $action[$name]->menu_action_color .';color:#ffffff;margin-right:5px;"
                  title ="' .$action[$name]->menu_action_title. '"
                  data-value="' . ( ( isset( $act["data"] ) ) ? $act["data"] : null ) .'">
                     <i class="' . $action[$name]->menu_action_icon. '"></i>
                     ' . ( ( isset( $act["show_name"] ) ) ? '&nbsp;' . $name : null) . '
               </button>' :
               ''
            );
         }
      }
      return $html;
   }
}

if ( ! function_exists('check_action_menu ') ) {
   function check_action_menu( $act, $url_module = '') {
      $action = all_action( $url_module );
      $result = false;
      if( array_key_exists( $act, $action) ) {
         $result = true;
      }
      return $result;
   }
}
