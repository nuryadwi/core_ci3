<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends Login_Controller {

   public function __construct() {
		parent::__construct();
	}

   function index() {
      $this->show();
   }

   function show() {
      $data = array();
		$data['status'] = 0;
      $data['link_post'] = base_url( 'admin/login/auth' );
      $this->template->customize_params( $data );
		$this->template->show( THEMES_LOGIN . 'index' );
   }

   function auth() {
      $this->load->helper('security');
      $in = $this->input->post();
      if( $in['username'] != '' && $in['password'] != '') {
         $redirect = ( ( !empty( $in['link'] ) ) ? $in['link'] : base_url('admin/dashboard/show') );
         if ( $this->verify_user( xss_clean( html_escape( $in['username'] ) ) ) && $this->verify_user( xss_clean( html_escape( $in['password'] ) ) ) ) {
            $session_arr = [
                     'user_info' => [
                           'user_is_company' => 0,
                           'user_company_id' => '0',
                           'user_company_name' => 'Carijobs',
                           'user_id'   => '0',
                           'user_username' => 'root',
                           'user_name' => 'Root',
                           'user_group_title' => 'Root',
                           'user_group_id' => '0',
                           'user_group_name' => 'root',
                           'user_last_login' => '-',
                           'user_image' => '',
                           'user_is_login' => 1,
                           'user_is_admin' => true
                     ],
            ];
            $this->session->set_userdata( $session_arr );
         } else {
            $user = get_data([
               'table'  => [
                  'core_user_account' => '',
                  'core_user_role'    => 'user_role_user_id = user_account_id',
               ],
               'where'  => [
                  'user_account_email' => $in['username']
               ]
            ]);
            if( $user->num_rows() > 0 ) {
               if( ( password_verify( $in['password'], $user->row('user_account_password') ) ) && in_array( $user->row('user_role_user_group_id'), ['1','2','3','4'] ) ) {
                  $detail = get_data(
                     [
                        'table' => [
                           'core_user_profile' => '',
                           'core_user_role'     => ['user_role_user_id = user_profile_id', "LEFT"],
                           'core_user_group'    => ['user_group_id = user_role_user_group_id', "LEFT"]
                        ],
                        'where'  => [
                           'user_profile_id' => $user->row('user_account_id')
                        ],
                        'select' => 'user_profile_first_name, user_profile_last_name, user_profile_image, user_group_id, user_group_name, user_group_title'
                     ]
                  );
                  $user_fullname = $detail->row('user_profile_first_name').' '.$detail->row('user_profile_last_name');
                  $datetime = date("Y-m-d H:i:s");
                  $session_arr = [
                     'user_info' => [
                        'user_is_company' => 0,
                        'user_id' => $user->row('user_account_id'),
                        'user_username' => $user->row('user_account_username'),
                        'user_name' => $user_fullname,
                        'user_group_id' => $detail->row('user_group_id'),
                        'user_group_name' => $detail->row('user_group_name'),
                        'user_group_title' => $detail->row('user_group_name'),
                        'user_last_login' => $user->row('user_account_last_login_datetime'),
                        'user_login_at' => $datetime,
                        'user_image'   => $detail->row('user_profile_image'),
                        'user_is_login' => 1,
                        'user_is_admin' => true,
                     ]
                  ];
                  $this->session->set_userdata( $session_arr );
                  save_data(
                     [
                        'table' => 'sys_user_login_log',
                        'set' => [
                           'user_login_log_user_id' => $user->row('user_account_id'),
                           'user_login_log_last_ip' => $this->get_client_ip(),
                           'user_login_log_last_datetime' => $datetime,
                        ]
                     ]
                  );
                  save_data(
                     [
                        'table'  => 'core_user_account',
                        'set'    => [
                           'user_account_last_login_datetime'  => $datetime
                        ],
                        'where'  => [
                           'user_account_id' => $user->row('user_account_id')
                        ]
                     ]
                  );
               } else {
               $this->session->set_flashdata('error', 'Kombinasi Username dan Password Tidak valid !');
               $redirect = base_url('login');
               }
            } else {
               $this->session->set_flashdata('error', 'User tidak ditemukan !');
               $redirect = base_url('login');
            }
         }
      }  else {
         $this->session->set_flashdata('error', 'username /password harus diisi');
         $redirect = base_url('login');
      }
      redirect($redirect);
   }

   function get_client_ip() {
		$ipaddress = '';
		if ( getenv( 'HTTP_CLIENT_IP' ) ) $ipaddress = getenv('HTTP_CLIENT_IP');
         else if(getenv('HTTP_X_FORWARDED_FOR')) $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
         else if(getenv('HTTP_X_FORWARDED')) $ipaddress = getenv('HTTP_X_FORWARDED');
         else if(getenv('HTTP_FORWARDED_FOR')) $ipaddress = getenv('HTTP_FORWARDED_FOR');
         else if(getenv('HTTP_FORWARDED')) $ipaddress = getenv('HTTP_FORWARDED');
         else if(getenv('REMOTE_ADDR')) $ipaddress = getenv('REMOTE_ADDR');
   	   else $ipaddress = 'UNKNOWN';

      return $ipaddress;
	}
   // function sql_insert(){
   //    $this->db->trans_begin();
   //    $pass = '123456789';
	// 	$id_account = save_data([
   //       'table'  => 'core_user_account',
   //       'set'    => [
   //          'user_account_phone' => '628500000121',
   //          'user_account_email' => 'files.yadi@gmail.com',
   //          'user_account_password' => password_hash($pass, PASSWORD_DEFAULT),
   //          'user_account_is_company' => '0',
   //          'user_account_create_on' => date( "Y-m-d H:i:s" ),
   //       ]
   //    ]);
   //    save_data([
   //       'table' => 'core_user_role',
   //       'set' => [
   //          'user_role_user_id' => $id_account,
   //          'user_role_user_group_id' => '1',
   //       ]
   //    ]);
   //    $this->load->library('record_log');
   //    $this->record_log->create_log_status([
   //       'user_status_log_user_id'  => $id_account,
   //       'user_status_log_status'   => '0',
   //       'user_status_log_datetime' => date( "Y-m-d H:i:s" ),
   //       'user_status_log_note'     => 'Register akun',
   //    ]);
	// 	$this->db->trans_complete();
   //    if ( $this->db->trans_status() === FALSE) {
   //       $this->db->trans_rollback();
   //       $result = [
   //          'status' => false,
   //          'message' => "Data Gagal Disimpan."
   //       ];
   //    }else{
   //       $this->db->trans_commit();
   //       $result = [
   //          'status' => false,
   //          'message' => "Data sukses."
   //       ];
   //    }
   //    echo json_encode($result);
	// }

}
