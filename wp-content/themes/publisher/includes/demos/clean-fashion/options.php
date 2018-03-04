<?php

/**
 * Returns settings for default demo
 *
 * ->Medias
 * ->Options
 * ->Widgets
 *
 * @return array
 */
function publisher_demo_raw_options() {

	$style_id       = 'clean';
	$demo_id        = 'fashion';
	$prefix         = $style_id . '-' . $demo_id . '-'; // prevent caching when user installs multiple demos continuously
	$demo_path      = PUBLISHER_THEME_PATH . 'includes/demos/' . $style_id . '-' . $demo_id . '/';
	$demo_image_url = publisher_get_demo_images_url( $style_id, $demo_id );

	return array(

		//
		// ->Medias
		//
		'media'   => array(

			'multi_steps' => FALSE,

			// Step 1
			array(
				array(
					'the_id' => 'bs-logo',
					'file'   => $demo_image_url . $prefix . 'logo.png',
					'resize' => FALSE,
				),
				array(
					'the_id' => 'bs-media-ad-728',
					'file'   => $demo_image_url . $prefix . 'ad-728.jpg',
					'resize' => FALSE,
				),
				array(
					'the_id' => 'bs-media-ad-300',
					'file'   => $demo_image_url . $prefix . 'ad-300.jpg',
					'resize' => FALSE,
				),
			),

		), // media


		//
		// ->Posts
		//
		'posts'   => array(
			'multi_steps' => FALSE,
			array(

				array(
					'the_id'            => 'bs-front-page',
					'post_title'        => 'CleanFashion - Front page',
					'post_content_file' => $demo_path . 'homepage-1.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),
				array(
					'the_id'            => 'bs-homepage-2',
					'post_title'        => 'CleanFashion - Homepage 2',
					'post_content_file' => $demo_path . 'homepage-2.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),
				array(
					'the_id'            => 'bs-homepage-3',
					'post_title'        => 'CleanFashion - Homepage 3',
					'post_content_file' => $demo_path . 'homepage-3.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),
				array(
					'the_id'            => 'bs-homepage-4',
					'post_title'        => 'CleanFashion - Homepage 4',
					'post_content_file' => $demo_path . 'homepage-4.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),
				array(
					'the_id'            => 'bs-homepage-5',
					'post_title'        => 'CleanFashion - Homepage 5',
					'post_content_file' => $demo_path . 'homepage-5.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),
				array(
					'the_id'            => 'bs-homepage-6',
					'post_title'        => 'CleanFashion - Homepage 6',
					'post_content_file' => $demo_path . 'homepage-6.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),
				array(
					'the_id'            => 'bs-homepage-7',
					'post_title'        => 'CleanFashion - Homepage 7',
					'post_content_file' => $demo_path . 'homepage-7.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),
				array(
					'the_id'            => 'bs-homepage-8',
					'post_title'        => 'CleanFashion - Homepage 8 - Blog',
					'post_content_file' => $demo_path . 'homepage-8.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),
				array(
					'the_id'            => 'bs-homepage-9',
					'post_title'        => 'CleanFashion - Homepage 9 - Blog',
					'post_content_file' => $demo_path . 'homepage-9.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),
				array(
					'the_id'            => 'bs-homepage-10',
					'post_title'        => 'CleanFashion - Homepage 10 - Infinity',
					'post_content_file' => $demo_path . 'homepage-10.txt',
					'post_type'         => 'page',
					'post_meta'         => array(
						array(
							'meta_key'   => 'page_layout',
							'meta_value' => '1-col',
						),
						array(
							'meta_key'   => '_hide_title',
							'meta_value' => 1,
						),
					),
				),


				//
				// BetterAds posts
				//
				array(
					'the_id'     => 'bs-post-ad-728',
					'post_title' => '728 Gray Banner',
					'post_type'  => 'better-banner',
					'post_meta'  => array(
						array(
							'meta_key'   => 'type',
							'meta_value' => 'image'
						),
						array(
							'meta_key'   => 'img',
							'meta_value' => '%%bf_product_demo_media_url:{bs-media-ad-728}:\'full\'%%'
						),
					)
				),
				array(
					'the_id'     => 'bs-post-ad-300',
					'post_title' => '300 Blue Banner',
					'post_type'  => 'better-banner',
					'post_meta'  => array(
						array(
							'meta_key'   => 'type',
							'meta_value' => 'image'
						),
						array(
							'meta_key'   => 'img',
							'meta_value' => '%%bf_product_demo_media_url:{bs-media-ad-300}:\'full\'%%'
						),
					)
				),
			)
		), // post


		//
		// ->Options
		//
		'options' => array(

			'multi_steps' => FALSE,

			//step one
			array(
				//
				// Panel options
				//
				array(
					'type'              => 'option',
					'option_name'       => publisher_get_theme_panel_id(),
					'option_value_file' => $demo_path . 'options.json',
				),

				// Theme Style
				array(
					'type'         => 'option',
					'option_name'  => publisher_get_theme_panel_id() . '_current_style',
					'option_value' => $style_id,
				),

				// Theme Demo
				array(
					'type'         => 'option',
					'option_name'  => publisher_get_theme_panel_id() . '_current_demo',
					'option_value' => $demo_id,
				),

				//
				// Update front page
				//
				array(
					'type'         => 'option',
					'option_name'  => 'page_on_front',
					'option_value' => '%%bs-front-page%%',
				),
				array(
					'type'         => 'option',
					'option_name'  => 'show_on_front',
					'option_value' => 'page',
				),

				//
				// Aside Ad
				//
				array(
					'type'          => 'option',
					'merge_options' => TRUE,
					'option_name'   => 'better_ads_manager',
					'option_value'  => array(
						'header_aside_logo_type'   => 'banner',
						'header_aside_logo_banner' => '%%bs-post-ad-728%%',
						'header_aside_logo_align'  => 'right',
					),
				),
			)
		), // options


		//
		// ->Widgets
		//
		'widgets' => array(
			'multi_steps' => FALSE,
			array(
				//
				// Primary sidebar
				//
				'primary-sidebar' => array(
					'remove_all_widgets' => TRUE,
					array(
						'widget_id'       => 'better-social-counter',
						'widget_settings' => array(
							'title' => 'Stay With Us',
							'order' => 'vimeo,pinterest,github,instagram,steam,envato',
						)
					),
					array(
						'widget_id'       => 'better-ads',
						'widget_settings' => array(
							'title'   => '',
							'type'    => 'banner',
							'banner'  => '%%bs-post-ad-300%%',
							'count'   => 1,
							'columns' => 1,
						)
					),
					array(
						'widget_id'       => 'bs-recent-posts',
						'widget_settings' => array(
							'title'                    => 'Latest News',
							'listing'                  => 'listing-thumbnail-2',
							'count'                    => 4,
							'bf-widget-title-bg-color' => '#e62019',
							'bf-widget-title-icon'     => array(
								'icon'   => 'fa-rss',
								'type'   => 'fontawesome',
								'height' => '',
								'width'  => '',
							),
						)
					),
					array(
						'widget_id'       => 'bs-popular-categories',
						'widget_settings' => array(
							'title' => 'Popular Categories',
						)
					),
				),
			),
		), // widgets

	);
} // publisher_demo_raw_setting