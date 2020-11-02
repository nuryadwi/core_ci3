<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* tool */
if ( ! function_exists( 'disp' ) ){
	function disp( $data, $title = '' ){
		echo '<pre>';
		if ( ! empty( $title ) ) {
			echo "<h3>$title</h3>";
		}
		print_r( $data );
		echo '</pre>';
	}
}
if ( ! function_exists( 'dec' ) ) {
	function dec($data) {
		$on_data = preg_replace('/\-+/', '=', $data);
		return unserialize(base64_decode($on_data));
	}
}

if ( ! function_exists( 'get_plan' ) ) {
	function get_plan( $type = '' ) {
		// $CI = & get_instance();
		return get_data([
			'table' => 'sys_plan',
			'where' => [
				'plan_type' => $type,
				'plan_is_active' => '1'
			],
			'select' => 'plan_value'
		])->row();
	}
}

if ( ! function_exists( 'enc' ) ) {
	function enc($data) {
		$data_on = base64_encode(serialize($data));
		return preg_replace('/\=+/', '-', $data_on);
	}
}

if ( ! function_exists( 'create_paging' ) ) {
	function create_paging( $paging,$total_pages,$results_row,$data) {
		header('Content-Type: application/json');
		return $result = [
			"page" => $paging,
			"total_page" => $total_pages,
			"total_results" => $results_row,
			"results" => $data
		];
	}
}

if ( ! function_exists( 'randStrGen' ) ){
	function randStrGen( $len ){
		$result = "";
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789$11";
		$charArray = str_split( $chars );
		for( $i = 0; $i < $len; $i++ ){
			$randItem = array_rand( $charArray );
			$result .= "".$charArray[$randItem];
		}
		return $result;
	}
}

if ( ! function_exists( 'checkEmail' ) ) {
	function checkEmail( $email ) {
	   if ( strpos( $email, '@' ) !== false ) {
		  $split = explode( '@', $email );
		  return ( strpos( $split['1'], '.' ) !== false ? true : false);
	   } else {
		  return false;
	   }
	}
}
