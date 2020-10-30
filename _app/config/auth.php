<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['allowed_uri'] = array(
	'admin/profile/show',
	'admin/profile/edit_profile',
	'admin/profile/account',
	'admin/profile/edit_account',
	'admin/member/get_member_info/(.*)',
	'admin/dashboard/show',
);
