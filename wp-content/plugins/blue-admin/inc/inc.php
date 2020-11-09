<?php

function init_ba_options()
{
	add_action('wp_head', 'ba_admin_styles');
	add_action('admin_enqueue_scripts', 'ba_admin_styles');
}
add_action('init', 'init_ba_options');

function ba_admin_styles()
{
	if(is_admin()) {
		wp_enqueue_style('style_ba', plugins_url() . '/blue-admin/assets/css/style.css', false, 1.1, false);
	}

	if (is_user_logged_in()) {
		wp_enqueue_style('adminbar_ba', plugins_url() . '/blue-admin/assets/css/adminbar.css', false, 1.1, false);
	}
}
