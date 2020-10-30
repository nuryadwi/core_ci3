<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth {
   var $CI = null;
   function __construct() {
      $this->CI = & get_instance();
      $this->CI->load->library( array('session') );
   }

   function auth_user() {
      $user_info = $this->CI->session->user_info;
      if ( $user_info['user_is_login'] ) {
         if ( $user_info['user_is_admin'] ) {
            return TRUE;
         } else {
            return FALSE;
         }
      } else {
         return FALSE;
      }
   }

   function auth_member() {
		$user_info = $this->CI->session->user_info;
        if ( $user_info['user_is_login'] ) {
			if ( $user_info['user_is_admin'] ) {
				return FALSE;
			} else{
				return TRUE;
			}
        } else {
            return FALSE;
        }
   }
   function privilege_user() {
      $user_info = $this->CI->session->user_info;
      $uri_string = rtrim( uri_string(), "/");
      $arr_uri = explode('/', $uri_string );
      $actor = $arr_uri[0];
      $controller = $arr_uri[1];

      $action = str_replace( $actor . '/' . $controller . '/', '', $uri_string );

      $uri = $this->CI->config->load('auth', TRUE);
      $arr_uri_string_true = $uri['allowed_uri'];

      $is_true = FALSE;
      if( $user_info['user_group_name'] == 'root') {
         $is_true = TRUE;
      } else {
         foreach ($arr_uri_string_true as $uri_string_true) {
            if( preg_match('/'. str_replace('/','\/', rtrim( $uri_string_true, "/") ) . '$/', $uri_string) ) {
               $is_true = TRUE;
            }
         }
      }
   }


}
