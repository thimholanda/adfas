<?php

add_filter( 'better-framework/product-pages/install-plugin/config', 'publisher_plugin_installer_config' );

/**
 * Ads exclusive and public plugins to plugin installer
 *
 * @param $plugins
 *
 * @return mixed
 */
function publisher_plugin_installer_config( $plugins ) {

	$plugins['js_composer']                 = array(
		'name'        => __( 'Visual Composer', 'publisher' ),
		'slug'        => 'js_composer',
		'required'    => TRUE,
		'description' => __( '#1 page builder plugin for WordPress - take full control over your site.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/js_composer.png' ),
		'version'     => '4.12.1',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/js_composer.zip' )
	);
	$plugins['revslider']                   = array(
		'name'        => __( 'Slider Revolution', 'publisher' ),
		'slug'        => 'revslider',
		'required'    => FALSE,
		'description' => __( '#1 WordPress slider plugin ever created and used!', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/revslider.png' ),
		'version'     => '5.2.6',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/revslider.zip' )
	);
	$plugins['better-social-counter']       = array(
		'name'        => __( 'Better Social Counter', 'publisher' ),
		'slug'        => 'better-social-counter',
		'required'    => FALSE,
		'description' => __( 'Complete solution for showing social networks stats on site.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-social-counter.png' ),
		'version'     => '1.4.8.2',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-social-counter.zip' )
	);
	$plugins['better-weather']              = array(
		'name'        => __( 'Better Weather', 'publisher' ),
		'slug'        => 'better-weather',
		'required'    => FALSE,
		'description' => __( 'The best way to show weather to the world.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-weather.png' ),
		'version'     => '3.1.1',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-weather.zip' )
	);
	$plugins['better-adsmanager']           = array(
		'name'        => __( 'Better Ads Manager', 'publisher' ),
		'slug'        => 'better-adsmanager',
		'required'    => FALSE,
		'description' => __( 'Advanced ads manager with huge options + ads blockers fallback.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-adsmanager.png' ),
		'version'     => '1.4',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-adsmanager.zip' )
	);
	$plugins['better-post-views']           = array(
		'name'        => __( 'Better Post Views', 'publisher' ),
		'slug'        => 'better-post-views',
		'required'    => FALSE,
		'description' => __( 'Count post views per day and week and show 7 days popular posts.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-post-views.png' ),
		'version'     => '1.1.0',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-post-views.zip' )
	);
	$plugins['better-reviews']              = array(
		'name'        => __( 'Better Reviews', 'publisher' ),
		'slug'        => 'better-reviews',
		'required'    => FALSE,
		'description' => __( 'Review products in 3 type with stylish design.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-reviews.png' ),
		'version'     => '1.0.6.2',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-reviews.zip' )
	);
	$plugins['better-playlist']             = array(
		'name'        => __( 'Better Playlist', 'publisher' ),
		'slug'        => 'better-playlist',
		'required'    => FALSE,
		'description' => __( 'The best way to Youtube playlist\'s and Vimeo album\'s in WordPress', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-playlist.png' ),
		'version'     => '1.1.0',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-playlist.zip' )
	);
	$plugins['better-amp']                  = array(
		'name'        => __( 'Better AMP', 'publisher' ),
		'slug'        => 'better-amp',
		'required'    => FALSE,
		'description' => __( 'Enables your site to load 4x faster in everywhere!', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-amp.png' ),
		'version'     => '1.1.3',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-amp.zip' )
	);
	$plugins['better-google-custom-search'] = array(
		'name'        => __( 'Better Google Custom Search', 'publisher' ),
		'slug'        => 'better-google-custom-search',
		'required'    => FALSE,
		'description' => __( 'Replace the default WordPress search engine with search powered by Google.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-google-custom-search.png' ),
		'version'     => '1.0.1',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-google-custom-search.zip' )
	);
	$plugins['better-disqus-comments']      = array(
		'name'        => __( 'Better Disqus Comments', 'publisher' ),
		'slug'        => 'better-disqus-comments',
		'required'    => FALSE,
		'description' => __( 'Use DISQUS comments for theme with this plugin.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-disqus-comments.png' ),
		'version'     => '1.0.1',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-disqus-comments.zip' )
	);
	$plugins['better-facebook-comments']    = array(
		'name'        => __( 'Better Facebook Comments', 'publisher' ),
		'slug'        => 'better-facebook-comments',
		'required'    => FALSE,
		'description' => __( 'Use Facebook comments for theme with this plugin.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/better-facebook-comments.png' ),
		'version'     => '1.2',
		'local_path'  => bf_get_theme_dir( 'includes/plugins/better-facebook-comments.zip' )
	);
	$plugins['custom-sidebars']             = array(
		'name'        => __( 'Custom sidebars', 'publisher' ),
		'slug'        => 'custom-sidebars',
		'required'    => FALSE,
		'description' => __( 'Create and customize sidebars for pages with easy user interface.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/custom-sidebars.png' ),
		'type'        => 'global'
	);
	$plugins['woocommerce']                 = array(
		'name'        => __( 'WooCommerce', 'publisher' ),
		'slug'        => 'woocommerce',
		'required'    => FALSE,
		'description' => __( 'Powerful and extendable eCommerce plugin that helps you sell anything.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/woocommerce.png' ),
		'type'        => 'global'
	);
	$plugins['bbpress']                     = array(
		'name'        => __( 'bbPress', 'publisher' ),
		'slug'        => 'bbpress',
		'required'    => FALSE,
		'description' => __( 'Create forums! Publisher is fully compatible with bbPress.', 'publisher' ),
		'thumbnail'   => bf_get_theme_uri( 'includes/plugins/images/bbpress.png' ),
		'type'        => 'global'
	);

	return $plugins;
}
