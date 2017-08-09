<?php

function vssp_activation() {
	
	global $wpdb;
	
	// VSSP Version Config
	$old_config = get_option( 'vssp_settings' );

	$defaults = array(
		'version' => VS_SPLASH_PAGE_VERSION,
		'cookie_name' => 'vssp_cookie_' . wp_create_nonce( 'vssp_cookie_name' )
	);

	$new_config	= wp_parse_args( $old_config, $defaults );
	
	update_option( 'vssp_settings', $new_config );
	
	// VSSP Default Options
	$defaults	= array(
		'enable_vs'	=> '0',
		'text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		'text_color' => '#fff',
		'text_size' => '18',
		'button_text' => strip_tags( __( 'Enter Website', 'vssp-textdomain' ) ),
		'button_text_size' => '14',
		'button_bg_color' => '#fff',
		'button_text_color' => '#000',
		'background_image'	=> VS_SPLASH_PAGE_ROOT_URL.'assets/images/sample-bg.jpg',
		'background_video' => VS_SPLASH_PAGE_ROOT_URL.'assets/videos/sample-video.mp4',
		'background_type' => 'image',
		'cookie_expiration' => 30,
	);

	$old_options = get_option( 'vssp_options' );
	$new_options = wp_parse_args( $old_options, $defaults );
	
	delete_option( 'vssp_options' );
	update_option( 'vssp_options', $new_options );
}

register_activation_hook( VS_SPLASH_PAGE_ROOT_PATH . '/init.php', 'vssp_activation' );