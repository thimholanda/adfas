<?php

$temp_dir = get_template_directory();

// include it manually earlier to get styles work!
include_once $temp_dir . '/includes/libs/better-framework/functions/multilingual.php';

// Init style manager
include_once $temp_dir . '/includes/styles/publisher-theme-panel-fields.php';
include_once $temp_dir . '/includes/styles/publisher-theme-category-fields.php';
include_once $temp_dir . '/includes/styles/publisher-theme-style.php';
include_once $temp_dir . '/includes/styles/publisher-theme-styles-manager.php';

if ( ! function_exists( 'publisher_styles_config' ) ) {
	/**
	 * List of all styles with configuration
	 *
	 * @return array
	 */
	function publisher_styles_config() {

		/*
		 * attrs for styles:
		 * - img
		 * - label
		 * - views
		 * - options
		 * - functions
		 * - css
		 * - js
		 */

		return array(
			'clean'   => array(
				'img'   => '',
				'label' => __( 'Clean', 'publisher' ),
				'views' => TRUE,
			),
			'classic' => array(
				'img'   => '',
				'label' => __( 'Classic Blog', 'publisher' ),
				'views' => TRUE,
			),
		);
	} // publisher_styles_config
}


if ( ! function_exists( 'bf_get_panel_default_style' ) ) {
	/**
	 * Handy function to get panels default style field id
	 *
	 * @param string $panel_id
	 *
	 * @return string
	 */
	function bf_get_panel_default_style( $panel_id = '' ) {

		if ( $panel_id == publisher_get_theme_panel_id() ) {
			return publisher_get_style() == 'default' ? 'clean' : publisher_get_style();
		}

		return 'default';
	}
}


if ( ! function_exists( 'publisher_get_style' ) ) {
	/**
	 * Used to get current active style.
	 *
	 * Default style: general
	 *
	 * @return  string
	 */
	function publisher_get_style( $force_style = FALSE ) {

		global $publisher_theme_core_globals_cache;

		// return from cache
		if ( $force_style && isset( $publisher_theme_core_globals_cache['theme-style-raw'] ) ) {
			return $publisher_theme_core_globals_cache['theme-style-raw'];
		} elseif ( isset( $publisher_theme_core_globals_cache['theme-style'] ) ) {
			return $publisher_theme_core_globals_cache['theme-style'];
		}

		$lang = bf_get_current_language_option_code();

		// current lang style or default none lang
		$style = get_option( publisher_get_theme_panel_id() . $lang . '_current_style' );

		// check
		if ( $style == FALSE ) {
			$style = get_option( publisher_get_theme_panel_id() . '_current_style' );
			if ( $style == FALSE ) {
				$style = 'default';
			}
		}

		$raw_style = $style;

		// validate it for views or only options
		if ( $style != 'default' ) {
			$all_styles = publisher_styles_config();

			if ( ! isset( $all_styles[ $style ] ) || ! isset( $all_styles[ $style ]['views'] ) || $all_styles[ $style ]['views'] == FALSE ) {
				$style = 'default';
			}
		}

		// compatibility
		if ( ! isset( $all_styles[ $style ] ) ) {
			$style = 'default';
		}

		// compatibility
		if ( ! isset( $all_styles[ $raw_style ] ) ) {
			$raw_style = 'default';
		}

		// cache it
		$publisher_theme_core_globals_cache['theme-style']     = $style;
		$publisher_theme_core_globals_cache['theme-style-raw'] = $raw_style;

		return $style;
	}
}

// Init styles
new Publisher_Theme_Styles_Manager();
