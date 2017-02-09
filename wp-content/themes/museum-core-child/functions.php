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



/* Remove the "Dashboard" from the admin menu for non-admin users */
function wpse52752_remove_dashboard () {
	global $current_user, $menu, $submenu;
	get_currentuserinfo();

	if( ! in_array( 'administrator', $current_user->roles ) ) {
		reset( $menu );
		$page = key( $menu );
		while( ( __( 'Dashboard' ) != $menu[$page][0] ) && next( $menu ) ) {
			$page = key( $menu );
		}
		if( __( 'Dashboard' ) == $menu[$page][0] ) {
			unset( $menu[$page] );
		}
		reset($menu);
		$page = key($menu);
		while ( ! $current_user->has_cap( $menu[$page][1] ) && next( $menu ) ) {
			$page = key( $menu );
		}
		if ( preg_match( '#wp-admin/?(index.php)?$#', $_SERVER['REQUEST_URI'] ) &&
		     ( 'index.php' != $menu[$page][2] ) ) {
			wp_redirect( get_option( 'siteurl' ) . '/wp-admin/edit.php');
		}
	}
}
add_action('admin_menu', 'wpse52752_remove_dashboard');