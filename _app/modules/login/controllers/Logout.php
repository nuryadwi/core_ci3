<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * controller untuk logout
 * author @dwinuryadi
 */
class Logout extends MY_Controller {

   function __construct() {
      parent::__construct();
      date_default_timezone_set('Asia/Jakarta');
   }
   function index() {
      session_destroy();
      redirect( base_url( 'login' ) );
   }
}
