<?php

if ( ! is_admin() ) {
	return;
}

// Performs the Bf setup
add_action( 'better-framework/after_setup', 'publisher_rebuild_thumbnail_init' );

if ( ! function_exists( 'publisher_rebuild_thumbnail_init' ) ) {
	/**
	 * Thumbnail rebuilder idealization
	 */
	function publisher_rebuild_thumbnail_init() {

		if ( ! class_exists( 'Publisher_Theme_Rebuild_Thumbnails' ) ) {
			include_once Publisher_Theme_Core()->get_dir_path( 'rebuild-thumbnails/class-publisher-rebuild-thumbnails.php' );
		}

		new Publisher_Theme_Rebuild_Thumbnails();

	}
}
