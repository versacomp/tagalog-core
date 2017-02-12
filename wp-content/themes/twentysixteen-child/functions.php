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

    $whitelist_array[] = 'http://tagalog.lipayon.com/my-homework-bergen';

	if( !is_user_logged_in() ) {
		$url = v_getUrl();

		if($url !== 'http://tagalog.lipayon.com/my-homework-bergen') {
            $whitelist = apply_filters('v_forcelogin_whitelist', array());
            $redirect_url = apply_filters('v_forcelogin_redirect', $url);
            if (preg_replace('/\?.*/', '', $url) != preg_replace('/\?.*/', '', wp_login_url()) && !in_array($url, $whitelist)) {
                wp_safe_redirect(wp_login_url($redirect_url), 302);
                exit();
            }
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



function remove_dashboard_widgets () {

	remove_meta_box('dashboard_quick_press','dashboard','side'); //Quick Press widget
	remove_meta_box('dashboard_recent_drafts','dashboard','side'); //Recent Drafts
	remove_meta_box('dashboard_primary','dashboard','side'); //WordPress.com Blog
	remove_meta_box('dashboard_secondary','dashboard','side'); //Other WordPress News
	remove_meta_box('dashboard_incoming_links','dashboard','normal'); //Incoming Links
	remove_meta_box('dashboard_plugins','dashboard','normal'); //Plugins
	remove_meta_box('dashboard_right_now','dashboard', 'normal'); //Right Now
	remove_meta_box('rg_forms_dashboard','dashboard','normal'); //Gravity Forms
	remove_meta_box('dashboard_recent_comments','dashboard','normal'); //Recent Comments
	remove_meta_box('icl_dashboard_widget','dashboard','normal'); //Multi Language Plugin
	remove_meta_box('dashboard_activity','dashboard', 'normal'); //Activity
	remove_meta_box('normal-sortables','dashboard', 'normal'); //Activity
	remove_meta_box('side-sortables','dashboard', 'normal'); //Activity
	//remove_action('welcome_panel','wp_welcome_panel');

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');