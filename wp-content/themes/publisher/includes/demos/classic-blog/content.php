<?php

/**
 * Returns content for default demo
 *
 * ->Taxonomies
 * ->Medias
 * ->Posts
 * ->Options
 * ->Widgets
 * ->Menus
 *
 * @return array
 */
function publisher_demo_raw_content() {

	$style_id = 'classic';
	$demo_id  = 'blog';

	$prefix         = $style_id . '-' . $demo_id . '-'; // prevent caching when user installs multiple demos continuously
	$demo_path      = PUBLISHER_THEME_PATH . 'includes/demos/' . $style_id . '-' . $demo_id . '/';
	$demo_image_url = publisher_get_demo_images_url( $style_id, $demo_id );

	$photo_credit_1 = wp_kses( sprintf( __( 'Photo credit: <a href="%s" target="blank" rel="nofollow">Sergey Sharkov - Nallien.com</a>', 'publisher' ), 'http://nallien.com/' ) );

	return array(

		//
		// ->Taxonomies
		//
		'taxonomy' => array(
			'multi_steps' => false,
			array(

				//
				// Style cats
				//
				array(
					'the_id'   => 'bs-style',
					'name'     => 'Style',
					'taxonomy' => 'category',
				),
				array(
					'the_id'   => 'bs-outfits',
					'name'     => 'Outfits',
					'taxonomy' => 'category',
					'parent'   => '%%bs-style%%',
				),
				array(
					'the_id'   => 'bs-wardrobe-rehab',
					'name'     => 'Wardrobe Rehab',
					'taxonomy' => 'category',
					'parent'   => '%%bs-style%%',
				),


				//
				// Travel cats
				//
				array(
					'the_id'    => 'bs-travel',
					'name'      => 'Travel',
					'taxonomy'  => 'category',
					'term_meta' => array(
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-15',
						),
					),
				),
				array(
					'the_id'   => 'bs-travel-guides',
					'name'     => 'Travel Guides',
					'taxonomy' => 'category',
					'parent'   => '%%bs-travel%%',
				),
				array(
					'the_id'   => 'bs-packing',
					'name'     => 'Packing',
					'taxonomy' => 'category',
					'parent'   => '%%bs-travel%%',
				),
				array(
					'the_id'   => 'bs-travel-tips',
					'name'     => 'Travel Tips',
					'taxonomy' => 'category',
					'parent'   => '%%bs-travel%%',
				),


				//
				// Life cats
				//
				array(
					'the_id'    => 'bs-life',
					'name'      => 'Life',
					'taxonomy'  => 'category',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'blog-5',
						),
					),
				),

			)
		), // tax


		//
		// ->Medias
		//
		'media'    => array(

			'multi_steps'           => true,
			'uninstall_multi_steps' => false,


			array(
				'the_id' => 'bs-media-profile',
				'file'   => $demo_image_url . $prefix . 'profile.jpg',
				'resize' => false,
			),
			array(
				'the_id' => 'bs-media-email',
				'file'   => $demo_image_url . $prefix . 'email-illustration.png',
				'resize' => false,
			),
			array(
				'the_id' => 'bs-logo',
				'file'   => $demo_image_url . $prefix . 'logo.png',
				'resize' => false,
			),
			array(
				'the_id'      => 'bs-media-1',
				'file'        => $demo_image_url . $prefix . 'thumb-1.jpg',
				'resize'      => true,
				'description' => $photo_credit_1,
			),
			array(
				'the_id'      => 'bs-media-2',
				'file'        => $demo_image_url . $prefix . 'thumb-2.jpg',
				'resize'      => true,
				'description' => $photo_credit_1,
			),
			array(
				'the_id'      => 'bs-media-3',
				'file'        => $demo_image_url . $prefix . 'thumb-3.jpg',
				'resize'      => true,
				'description' => $photo_credit_1,
			),
			array(
				'the_id' => 'bs-media-4',
				'file'   => $demo_image_url . $prefix . 'thumb-4.jpg',
				'resize' => true
			),
			array(
				'the_id'      => 'bs-media-5',
				'file'        => $demo_image_url . $prefix . 'thumb-5.jpg',
				'resize'      => true,
				'description' => $photo_credit_1,
			),
			array(
				'the_id'      => 'bs-media-6',
				'file'        => $demo_image_url . $prefix . 'thumb-6.jpg',
				'resize'      => true,
				'description' => $photo_credit_1,
			),
			array(
				'the_id'      => 'bs-media-7',
				'file'        => $demo_image_url . $prefix . 'thumb-7.jpg',
				'resize'      => true,
				'description' => $photo_credit_1,
			),
			array(
				'the_id' => 'bs-media-8',
				'file'   => $demo_image_url . $prefix . 'thumb-8.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-9',
				'file'   => $demo_image_url . $prefix . 'thumb-9.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-10',
				'file'   => $demo_image_url . $prefix . 'thumb-10.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-11',
				'file'   => $demo_image_url . $prefix . 'thumb-11.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-12',
				'file'   => $demo_image_url . $prefix . 'thumb-12.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-post-content-1',
				'file'   => $demo_image_url . $prefix . 'post-content-1.jpg',
				'resize' => false,
			),
			array(
				'the_id' => 'bs-media-post-content-2',
				'file'   => $demo_image_url . $prefix . 'post-content-2.jpg',
				'resize' => false,
			),
			array(
				'the_id' => 'bs-media-ad-300',
				'file'   => $demo_image_url . $prefix . 'ad-300.jpg',
				'resize' => false,
			),
			array(
				'the_id' => 'bs-media-ad-728',
				'file'   => $demo_image_url . $prefix . 'ad-728.jpg',
				'resize' => false,
			),
		),


		//
		// ->Posts
		//
		'posts'    => array(
			'multi_steps' => false,
			array(
				//
				// Homepage
				//
				array(
					'the_id'            => 'bs-front-page',
					'post_title'        => 'Front page',
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
					'post_title'        => 'Homepage 2',
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
					'post_title'        => 'Homepage 3',
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
					'post_title'        => 'Homepage 4',
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
					'post_title'        => 'Homepage 5',
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
					'post_title'        => 'Homepage 6',
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
					'post_title'        => 'Homepage 7',
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
					'post_title'        => 'Homepage 8',
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
					'post_title'        => 'Homepage 9',
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
					'post_title'        => 'Homepage 10',
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
				// Style posts
				//
				array(
					'the_id'            => 'bs-post-style-1',
					'post_title'        => 'Getting ready for summer',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-1%%',
					'post_terms'        => array(
						'category' => '%%bs-outfits%%',
					),
				),
				array(
					'the_id'            => 'bs-post-style-2',
					'post_title'        => 'Collarless suede jacket',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-2%%',
					'post_terms'        => array(
						'category' => '%%bs-wardrobe-rehab%%',
					),
				),
				array(
					'the_id'            => 'bs-post-style-3',
					'post_title'        => 'Pandora essence collection',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-3%%',
					'post_terms'        => array(
						'category' => '%%bs-outfits%%,%%bs-life%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => $photo_credit_1,
						)
					),
				),
				array(
					'the_id'            => 'bs-post-style-4',
					'post_title'        => 'Striped d ring detail blouse',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-4%%',
					'post_terms'        => array(
						'category' => '%%bs-wardrobe-rehab%%',
					),
				),
				array(
					'the_id'            => 'bs-post-style-5',
					'post_title'        => 'Black and white striped tee',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-5%%',
					'post_terms'        => array(
						'category' => '%%bs-wardrobe-rehab%%,%%bs-life%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => $photo_credit_1,
						)
					),
				),
				array(
					'the_id'            => 'bs-post-style-6',
					'post_title'        => 'Flute sleeves',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-6%%',
					'post_terms'        => array(
						'category' => '%%bs-outfits%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => $photo_credit_1,
						)
					),
				),
				array(
					'the_id'            => 'bs-post-style-7',
					'post_title'        => 'Black eyelet dress',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-7%%',
					'post_terms'        => array(
						'category' => '%%bs-wardrobe-rehab%%,%%bs-life%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => $photo_credit_1,
						)
					),
				),
				array(
					'the_id'            => 'bs-post-style-8',
					'post_title'        => 'The new way to wear your shirt',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-8%%',
					'post_terms'        => array(
						'category' => '%%bs-outfits%%,%%bs-life%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => $photo_credit_1,
						)
					),
				),
				array(
					'the_id'            => 'bs-post-style-9',
					'post_title'        => 'Nude and white',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-9%%',
					'post_terms'        => array(
						'category' => '%%bs-outfits%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => $photo_credit_1,
						)
					),
				),
				array(
					'the_id'            => 'bs-post-style-10',
					'post_title'        => 'Styling faux suede',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-10%%',
					'post_terms'        => array(
						'category' => '%%bs-wardrobe-rehab%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => $photo_credit_1,
						)
					),
				),
				array(
					'the_id'            => 'bs-post-style-10',
					'post_title'        => 'How to wear mesh in the day',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-11%%',
					'post_terms'        => array(
						'category' => '%%bs-outfits%%,%%bs-life%%',
					),
				),


				//
				// Travel posts
				//
				array(
					'the_id'            => 'bs-post-travel-1',
					'post_title'        => 'Emilio pucci point collar shirt',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-12%%',
					'post_terms'        => array(
						'category' => '%%bs-travel-tips%%,%%bs-packing%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => $photo_credit_1,
						)
					),
				),
				array(
					'the_id'            => 'bs-post-travel-2',
					'post_title'        => 'Modern simplicity',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-1%%',
					'post_terms'        => array(
						'category' => '%%bs-packing%%,%%bs-travel-guides%%',
					),
				),
				array(
					'the_id'            => 'bs-post-travel-3',
					'post_title'        => 'Mint velvet lfw',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-2%%',
					'post_terms'        => array(
						'category' => '%%bs-travel-tips%%,%%bs-travel-guides%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => '_featured_embed_code',
							'meta_value' => 'https://soundcloud.com/lifeofdesiigner/desiigner-panda',
						)
					),
					'post_format'       => 'audio',
				),
				array(
					'the_id'            => 'bs-post-travel-4',
					'post_title'        => 'Mothers day ideas 2016',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-3%%',
					'post_terms'        => array(
						'category' => '%%bs-packing%%,%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-travel-5',
					'post_title'        => 'It\'s furry cold outside',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-4%%',
					'post_terms'        => array(
						'category' => '%%bs-travel-tips%%,%%bs-travel-guides%%',
					),
				),
				array(
					'the_id'            => 'bs-post-travel-6',
					'post_title'        => 'Flared cuff shirt',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-5%%',
					'post_terms'        => array(
						'category' => '%%bs-packing%%,%%bs-travel-guides%%',
					),
				),
				array(
					'the_id'            => 'bs-post-travel-7',
					'post_title'        => 'London sky gardens',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-6%%',
					'post_terms'        => array(
						'category' => '%%bs-travel-tips%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => $photo_credit_1,
						)
					),
				),
				array(
					'the_id'            => 'bs-post-travel-8',
					'post_title'        => 'White flared sleeve shirt',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-7%%',
					'post_terms'        => array(
						'category' => '%%bs-travel-guides%%,%%bs-packing%%',
					),
				),
				array(
					'the_id'            => 'bs-post-travel-9',
					'post_title'        => 'Can i wear black for new year\'s eve?',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-8%%',
					'post_terms'        => array(
						'category' => '%%bs-travel-tips%%,%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-travel-10',
					'post_title'        => 'Wearing red knitwear',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-9%%',
					'post_terms'        => array(
						'category' => '%%bs-packing%%',
					),
				),
				array(
					'the_id'            => 'bs-post-travel-11',
					'post_title'        => 'How to syle a blazer',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-10%%',
					'post_terms'        => array(
						'category' => '%%bs-travel-guides%%,%%bs-travel-tips%%',
					),
				),
				array(
					'the_id'            => 'bs-post-travel-12',
					'post_title'        => 'Black friday 2015',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-11%%',
					'post_terms'        => array(
						'category' => '%%bs-travel-guides%%,%%bs-packing%%,%%bs-life%%',
					),
				),

			)
		),


		//
		// ->Options
		//
		'options'  => array(

			'multi_steps' => false,

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
					'merge_options' => true,
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
		'widgets'  => array(
			'multi_steps' => false,
			array(
				//
				// Primary sidebar
				//
				'primary-sidebar' => array(
					'remove_all_widgets' => true,

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
					'remove_all_widgets' => true,
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
					'remove_all_widgets' => true,
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
					'remove_all_widgets' => true,
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


		//
		// ->Menus
		//
		'menus'    => array(
			'multi_step' => false,

			array(
				//
				// Main navigation
				//
				array(
					'menu-name'     => 'Main Navigation',
					'menu-location' => 'main-menu',
					'recently-edit' => true,
					'items'         => array(
						array(
							'the_id'    => 'bs-menu-main-home',
							'item_type' => 'page',
							'page_id'   => '%%bs-front-page%%',
							'title'     => 'Home',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-front-page%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 1',
							'item_meta' => array(
								array(
									'meta_key'   => 'badge_label',
									'meta_value' => 'Default',
								),
							),
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-2%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 2',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-3%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 3',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-4%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 4',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-5%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 5',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-6%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 6',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-7%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 7',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-8%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 8',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-9%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 9',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-10%%',
							'parent-id' => '%%bs-menu-main-home%%',
							'title'     => 'Homepage 10',
							'item_meta' => array(
								array(
									'meta_key'   => 'badge_label',
									'meta_value' => 'Infinity',
								),
							),
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-style%%',
							'taxonomy'  => 'category',
							'item_meta' => array(
								array(
									'meta_key'   => 'mega_menu',
									'meta_value' => 'tabbed-grid-posts',
								),
								array(
									'meta_key'   => 'drop_menu_anim',
									'meta_value' => 'slide-bottom-in',
								),
							),
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-packing%%',
							'taxonomy'  => 'category',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-travel%%',
							'taxonomy'  => 'category',
							'item_meta' => array(
								array(
									'meta_key'   => 'mega_menu',
									'meta_value' => 'grid-posts',
								),
								array(
									'meta_key'   => 'drop_menu_anim',
									'meta_value' => 'slide-fade',
								),
							)
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-life%%',
							'taxonomy'  => 'category',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-travel-tips%%',
							'taxonomy'  => 'category',
						),
					),
				),

				//
				// Topbar navigation
				//
				array(
					'menu-name'     => 'Topbar Navigation',
					'menu-location' => 'top-menu',
					'items'         => array(
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-front-page%%',
							'title'     => 'Home',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-travel-guides%%',
							'taxonomy'  => 'category',
						),
						array(
							'the_id'    => 'bs-menu-top-lifestyle',
							'item_type' => 'term',
							'term_id'   => '%%bs-travel%%',
							'taxonomy'  => 'category',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-packing%%',
							'taxonomy'  => 'category',
							'parent-id' => '%%bs-menu-top-lifestyle%%',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-travel-guides%%',
							'taxonomy'  => 'category',
							'parent-id' => '%%bs-menu-top-lifestyle%%',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-travel-tips%%',
							'taxonomy'  => 'category',
							'parent-id' => '%%bs-menu-top-lifestyle%%',
						),
						array(
							'item_type' => 'custom',
							'title'     => 'Purchase Theme',
							'target'    => '_blank',
							'url'       => 'http://themeforest.net/item/x/15801051?ref=Better-Studio',
						),
					)
				),

				//
				// Footer navigation
				//
				array(
					'menu-name'     => 'Footer Navigation',
					'menu-location' => 'footer-menu',
					'items'         => array(
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-front-page%%',
							'title'     => 'Home',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-travel%%',
							'taxonomy'  => 'category',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-style%%',
							'taxonomy'  => 'category',
						),
						array(
							'item_type' => 'custom',
							'title'     => 'Purchase Theme',
							'target'    => '_blank',
							'url'       => 'http://themeforest.net/item/x/15801051?ref=Better-Studio',
						),
					)
				),
			),

		), // menus
	);
}