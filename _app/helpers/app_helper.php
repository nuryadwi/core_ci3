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