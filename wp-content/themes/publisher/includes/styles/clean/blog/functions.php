<?php

add_filter( 'publisher-theme-core/editor-shortcodes/config', 'publisher_clean_blog_editor_config', 100 );

if ( ! function_exists( 'publisher_clean_blog_editor_config' ) ) {
	/**
	 * Configs the theme shortcodes library for this style
	 *
	 * @param $config
	 *
	 * @return array
	 */
	function publisher_clean_blog_editor_config( $config ) {

		// Columns sizes
		$config['size-max-width']     = 1040;
		$config['size-content-width'] = 650;

		return $config;
	}

}
