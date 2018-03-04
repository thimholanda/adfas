<?php

// Active and new shortcodes
add_filter( 'better-framework/shortcodes', 'publisher_theme_core_init_pagin', 10 );

if ( ! function_exists( 'publisher_theme_core_init_pagin' ) ) {
	/**
	 * Initializes BS Pagin
	 *
	 * @param $shortcodes
	 *
	 * @return mixed
	 */
	function publisher_theme_core_init_pagin( $shortcodes ) {

		require_once Publisher_Theme_Core()->get_dir_path() . 'listing-pagin/functions.php';
		require_once Publisher_Theme_Core()->get_dir_path() . 'listing-pagin/class-publisher-theme-listing-pagin-manager.php';
		require_once Publisher_Theme_Core()->get_dir_path() . 'listing-pagin/class-publisher-theme-listing-shortcode.php';

		return $shortcodes;
	}
}
