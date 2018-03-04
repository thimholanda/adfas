<?php
/**
 * Demo Installer Configuration
 */

add_filter( 'better-framework/product-pages/install-demo/config', 'publisher_demos_config' );

if ( ! function_exists( 'publisher_demos_config' ) ) {
	/**
	 * Adds active demos to BS Product Pages with correct config to install
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	function publisher_demos_config( $data = array() ) {

		$theme_uri = get_template_directory_uri() . '/';

		//
		// Clean style -> Demos
		//
		$data['clean-magazine'] = array(
			'thumbnail'   => $theme_uri . 'includes/demos/clean-magazine/thumbnail.png',
			'name'        => __( 'Clean Magazine', 'publisher' ),
			'preview_url' => 'http://demo.betterstudio.com/publisher/',
			'options'     => TRUE,
		);
		$data['clean-tech']     = array(
			'thumbnail'   => $theme_uri . 'includes/demos/clean-tech/thumbnail.png',
			'name'        => __( 'Clean Tech', 'publisher' ),
			'preview_url' => 'http://demo.betterstudio.com/publisher/clean-tech/',
			'options'     => TRUE,
		);
		$data['clean-blog']     = array(
			'thumbnail'   => $theme_uri . 'includes/demos/clean-blog/thumbnail.png',
			'name'        => __( 'Clean Blog', 'publisher' ),
			'preview_url' => 'http://demo.betterstudio.com/publisher/clean-blog/',
			'options'     => TRUE,
		);
		$data['clean-sport']    = array(
			'thumbnail'   => $theme_uri . 'includes/demos/clean-sport/thumbnail.png',
			'name'        => __( 'Clean Sport', 'publisher' ),
			'preview_url' => 'http://demo.betterstudio.com/publisher/clean-sport/',
			'options'     => TRUE,
		);
		$data['clean-fashion']  = array(
			'thumbnail'   => $theme_uri . 'includes/demos/clean-fashion/thumbnail.png',
			'name'        => __( 'Clean Fashion', 'publisher' ),
			'preview_url' => 'http://demo.betterstudio.com/publisher/clean-fashion/',
			'options'     => TRUE,
		);
		$data['clean-video']    = array(
			'thumbnail'   => $theme_uri . 'includes/demos/clean-video/thumbnail.png',
			'name'        => __( 'Clean Video', 'publisher' ),
			'preview_url' => 'http://demo.betterstudio.com/publisher/clean-video',
			'options'     => TRUE,
		);
		$data['clean-design']   = array(
			'thumbnail'   => $theme_uri . 'includes/demos/clean-design/thumbnail.png',
			'name'        => __( 'Clean Design', 'publisher' ),
			'preview_url' => 'http://demo.betterstudio.com/publisher/clean-design/',
			'options'     => TRUE,
		);


		//
		// Classic style -> Demos
		//
		$data['classic-blog']     = array(
			'thumbnail'   => $theme_uri . 'includes/demos/classic-blog/thumbnail.png',
			'name'        => __( 'Classic Blog', 'publisher' ),
			'preview_url' => 'http://demo.betterstudio.com/publisher/classic-blog/',
			'options'     => TRUE,
		);
		$data['classic-magazine'] = array(
			'thumbnail'   => $theme_uri . 'includes/demos/classic-magazine/thumbnail.png',
			'name'        => __( 'Classic Magazine', 'publisher' ),
			'preview_url' => 'http://demo.betterstudio.com/publisher/classic-mag/',
			'options'     => TRUE,
		);

		return $data;
	} // publisher_demos_config
}


if ( ! function_exists( 'publisher_get_demo_id' ) ) {
	/**
	 *
	 * @return mixed
	 */
	function publisher_get_demo_id() {

		global $publisher_theme_core_globals_cache;

		// return from cache
		if ( isset( $publisher_theme_core_globals_cache['theme-demo'] ) ) {
			return $publisher_theme_core_globals_cache['theme-demo'];
		}

		$demo = get_option( publisher_get_theme_panel_id() . '_current_demo' );

		// cache it
		$publisher_theme_core_globals_cache['theme-demo'] = $demo;

		return $demo;

	} // publisher_get_demo_id
}


// Adds filter for all demos content
foreach ( publisher_demos_config() as $demo_id => $demo_config ) {
	add_filter( 'better-framework/product-pages/install-demo/' . $demo_id . '/content', 'publisher_init_demo_content', 10, 2 );
	add_filter( 'better-framework/product-pages/install-demo/' . $demo_id . '/setting', 'publisher_init_demo_setting', 10, 2 );
}

if ( ! function_exists( 'publisher_init_demo_content' ) ) {
	/**
	 * Pulls selected demo data from its directory and send it to BS Product Pages demo installer
	 *
	 * @param array  $content
	 * @param string $demo_id
	 *
	 * @return array
	 */
	function publisher_init_demo_content( $content = array(), $demo_id = '' ) {

		$demos_list = publisher_demos_config();

		$theme_dir = get_template_directory() . '/';

		// check if its valid, get value from its directory
		if ( ! empty( $demos_list[ $demo_id ] ) ) {

			include_once $theme_dir . 'includes/demos/' . $demo_id . '/content.php';

			$content = call_user_func( 'publisher_demo_raw_content' );

		}

		return $content;
	} // publisher_init_demo_content
}

if ( ! function_exists( 'publisher_init_demo_setting' ) ) {
	/**
	 * Pulls selected demo data from its directory and send it to BS Product Pages demo installer
	 *
	 * @param array  $content
	 * @param string $demo_id
	 *
	 * @return array
	 */
	function publisher_init_demo_setting( $content = array(), $demo_id = '' ) {

		$demos_list = publisher_demos_config();

		$theme_dir = get_template_directory() . '/';

		// check if its valid, get value from its directory
		if ( ! empty( $demos_list[ $demo_id ] ) ) {

			include_once $theme_dir . 'includes/demos/' . $demo_id . '/options.php';

			$content = call_user_func( 'publisher_demo_raw_options' );

		}

		return $content;
	} // publisher_init_demo_setting
}


if ( ! function_exists( 'publisher_get_demo_images_url' ) ) {
	/**
	 * Used to get demo images url
	 *
	 * @return array
	 */
	function publisher_get_demo_images_url( $style_id = '', $demo_id = '' ) {

		$demo_image_url = 'http://demo-contents.betterstudio.com/themes/publisher/v1/' . $style_id . '-' . $demo_id . '/';

		if ( bf_is( 'demo-dev' ) ) {
			$demo_image_url = home_url( 'demo-images/v1/' . $style_id . '-' . $demo_id . '/' );
		}

		return $demo_image_url;
	} // publisher_get_demo_images_url
}
