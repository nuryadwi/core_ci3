<?php

if ( ! defined( 'BASEPATH' ) ) exit('No direct script access allowed');

class Record_log {

   var $CI = null;

   function __construct() {
     $this->CI = & get_instance();
   }

   function create_log_status( $data ) {
   	$insert_log = save_data([
   		'table' => 'core_user_status_log',
   		'set' => $data,
   	]);
   	if ( $insert_log ) {
   		return true;
   	} else {
   		return false;
   	}
   }
}
