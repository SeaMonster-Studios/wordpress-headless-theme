<?php

if ( ! defined( 'ABSPATH' ) ) exit;

class SMS_WP_Reboot
{
	function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ));

		if (!is_admin()) {
			add_action('wp_enqueue_scripts', 'my_jquery_enqueue', 11);
		}
	}
}

new SMS_WP_Reboot;
