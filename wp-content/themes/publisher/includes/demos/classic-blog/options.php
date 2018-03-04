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

	$style_id       = 'classic';
	$demo_id        = 'blog';
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
					'the_id' => 'bs-media-profile',
					'file'   => $demo_image_url . $prefix . 'profile.jpg',
					'resize' => FALSE,
				),
				array(
					'the_id' => 'bs-media-email',
					'file'   => $demo_image_url . $prefix . 'email-illustration.png',
					'resize' => FALSE,
				),
				array(
					'the_id' => 'bs-logo',
					'file'   => $demo_image_url . $prefix . 'logo.png',
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
				//
				// Homepage
				//
				array(
					'the_id'            => 'bs-front-page',
					'post_title'        => 'Classic Blog - Front page',
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
					'post_title'        => 'Classic Blog - Homepage 2',
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
					'post_title'        => 'Classic Blog - Homepage 3',
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
					'post_title'        => 'Classic Blog - Homepage 4',
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
					'post_title'        => 'Classic Blog - Homepage 5',
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
					'post_title'        => 'Classic Blog - Homepage 6',
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
					'post_title'        => 'Classic Blog - Homepage 7',
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
					'post_title'        => 'Classic Blog - Homepage 8',
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
					'post_title'        => 'Classic Blog - Homepage 9',
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
					'post_title'        => 'Classic Blog - Homepage 10',
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
			)
		), // posts


		//
		// -> Options
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
		),


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
						'widget_id'       => 'bs-about',
						'widget_settings' => array(
							'title'          => 'About Me',
							'show_title'     => 0,
							'about_link_url' => 'http://themeforest.net/item/x/15801051',
							'content'        => 'Malis scripta euismod vis id, aperiri consectetuer consequuntur in est.',
							'logo_img'       => '%%bf_product_demo_media_url:{bs-media-profile}:\'full\'%%',
							'logo_text'      => 'Publisher WordPress Theme',
							'link_facebook'  => '#',
							'link_twitter'   => '#',
							'link_google'    => '#',
							'link_instagram' => '#',
							'link_dribbble'  => '#',
						)
					),
					array(
						'widget_id'       => 'better-social-counter',
						'widget_settings' => array(
							'title'   => 'Stay With Me',
							'order'   => 'instagram,pinterest,envato,vimeo',
							'columns' => '4',
							'colored' => '0',
						)
					),
					array(
						'widget_id'       => 'bs-instagram',
						'widget_settings' => array(
							'title'       => 'Instagram',
							'user_id'     => 'nallien',
							'photo_count' => 9,
							'style'       => 3,
						)
					),
					array(
						'widget_id'       => 'bs-subscribe-newsletter',
						'widget_settings' => array(
							'title'         => '',
							'feedburner-id' => '#test',
							'msg'           => 'Subscribe to my newsletter',
							'image'         => '%%bf_product_demo_media_url:{bs-media-email}:\'full\'%%',
						)
					),
					array(
						'widget_id'       => 'bs-popular-categories',
						'widget_settings' => array(
							'title' => 'Popular Categories',
							'count' => 5,
						)
					),
				),

				//
				// Footer Column 1
				//
				'footer-1'        => array(
					'remove_all_widgets' => TRUE,
					array(
						'widget_id'       => 'bs-about',
						'widget_settings' => array(
							'title'          => 'About Me',
							'show_title'     => 0,
							'about_link_url' => '',
							'content'        => 'Malis consectetuer consequuntur.',
							'logo_img'       => '%%bf_product_demo_media_url:{bs-media-profile}:\'full\'%%',
							'logo_text'      => 'Publisher WordPress Theme',
							'link_facebook'  => '#',
							'link_twitter'   => '#',
							'link_google'    => '#',
							'link_instagram' => '#',
							'link_dribbble'  => '#',
						)
					),
				),

				//
				// Footer Column 2
				//
				'footer-2'        => array(
					'remove_all_widgets' => TRUE,
					array(
						'widget_id'       => 'bs-recent-posts',
						'widget_settings' => array(
							'title'   => 'Recent Posts',
							'listing' => 'simple-thumbnail-readable-meta',
							'count'   => 4,
						)
					),
				),


				//
				// Footer Column 3
				//
				'footer-3'        => array(
					'remove_all_widgets' => TRUE,
					array(
						'widget_id'       => 'bs-subscribe-newsletter',
						'widget_settings' => array(
							'bf-widget-title-bg-color' => '#2d2d2d',
							'bf-widget-bg-color'       => '#494949',
							'title'                    => 'Newsletter',
							'feedburner-id'            => '#test',
							'msg'                      => 'Subscribe to my newsletter',
							'image'                    => '%%bf_product_demo_media_url:{bs-media-email}:\'full\'%%',
						)
					),
				),
			),
		), // widgets

	);
} // publisher_demo_raw_setting