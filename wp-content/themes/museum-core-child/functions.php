<?php

// Force login to view site
function v_getUrl() {
	$url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
	$url .= '://' . $_SERVER['SERVER_NAME'];
	$url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
	$url .= $_SERVER['REQUEST_URI'];
	return $url;
}
function v_forcelogin() {
	if( !is_user_logged_in() ) {
		$url = v_getUrl();
		$whitelist = apply_filters('v_forcelogin_whitelist', array());
		$redirect_url = apply_filters('v_forcelogin_redirect', $url);
		if( preg_replace('/\?.*/', '', $url) != preg_replace('/\?.*/', '', wp_login_url()) && !in_array($url, $whitelist) ) {
			wp_safe_redirect( wp_login_url( $redirect_url ), 302 ); exit();
		}
	}
}
add_action('init', 'v_forcelogin');


function annointed_admin_bar_remove() {
	global $wp_admin_bar;

	/* Remove their stuff */
	$wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

