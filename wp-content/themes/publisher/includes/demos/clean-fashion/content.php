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

	$style_id       = 'clean';
	$demo_id        = 'fashion';
	$prefix         = $style_id . '-' . $demo_id . '-'; // prevent caching when user installs multiple demos continuously
	$demo_path      = PUBLISHER_THEME_PATH . 'includes/demos/' . $style_id . '-' . $demo_id . '/';
	$demo_image_url = publisher_get_demo_images_url( $style_id, $demo_id );

	return array(

		//
		// ->Taxonomies
		//
		'taxonomy' => array(
			'multi_steps' => false,
			array(
				//
				// Fashion cats
				//
				array(
					'the_id'    => 'bs-fashion-today',
					'name'      => 'Fashion Today',
					'taxonomy'  => 'category',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'grid-1',
						),
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-15',
						),
						array(
							'meta_key'   => 'better_slider_gradient',
							'meta_value' => 'simple',
						),
						array(
							'meta_key'   => 'term_color',
							'meta_value' => '#E20090',
						),
						array(
							'meta_key'   => 'term_posts_count',
							'meta_value' => 6,
						),
					),
				),
				array(
					'the_id'    => 'bs-look-of-day',
					'name'      => 'Look of The Day',
					'taxonomy'  => 'category',
					'parent'    => '%%bs-fashion-today%%',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'grid-1',
						),
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-1',
						),
						array(
							'meta_key'   => 'better_slider_gradient',
							'meta_value' => 'simple',
						),
						array(
							'meta_key'   => 'term_color',
							'meta_value' => '#da9d01',
						),
					),
				),
				array(
					'the_id'    => 'bs-street-fashion',
					'name'      => 'Street fashion',
					'taxonomy'  => 'category',
					'parent'    => '%%bs-fashion-today%%',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'grid-1',
						),
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-1',
						),
						array(
							'meta_key'   => 'better_slider_gradient',
							'meta_value' => 'simple',
						),
					),
				),
				array(
					'the_id'    => 'bs-vogue',
					'name'      => 'Vogue',
					'taxonomy'  => 'category',
					'parent'    => '%%bs-fashion-today%%',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'grid-1',
						),
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-1',
						),
						array(
							'meta_key'   => 'better_slider_gradient',
							'meta_value' => 'simple',
						),
					),
				),


				//
				// Beauty cats
				//
				array(
					'the_id'    => 'bs-beauty',
					'name'      => 'Beauty',
					'taxonomy'  => 'category',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'classic-1',
						),
						array(
							'meta_key'   => 'term_posts_count',
							'meta_value' => 8,
						),
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-5',
						),
						array(
							'meta_key'   => 'better_slider_gradient',
							'meta_value' => 'simple-gr',
						),
						array(
							'meta_key'   => 'term_color',
							'meta_value' => '#de000a',
						),
					),
				),
				array(
					'the_id'    => 'bs-makeup',
					'name'      => 'Makeup',
					'taxonomy'  => 'category',
					'parent'    => '%%bs-beauty%%',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'grid-1',
						),
						array(
							'meta_key'   => 'term_posts_count',
							'meta_value' => 8,
						),
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-5',
						),
						array(
							'meta_key'   => 'better_slider_gradient',
							'meta_value' => 'simple-gr',
						),
					),
				),
				array(
					'the_id'    => 'bs-health',
					'name'      => 'Health & Fitness',
					'taxonomy'  => 'category',
					'parent'    => '%%bs-beauty%%',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'grid-1',
						),
						array(
							'meta_key'   => 'term_posts_count',
							'meta_value' => 8,
						),
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-5',
						),
						array(
							'meta_key'   => 'better_slider_gradient',
							'meta_value' => 'simple-gr',
						),
					),
				),
				array(
					'the_id'    => 'bs-hollywood-makeover',
					'name'      => 'Hollywood Makeover',
					'taxonomy'  => 'category',
					'parent'    => '%%bs-beauty%%',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'grid-1',
						),
						array(
							'meta_key'   => 'term_posts_count',
							'meta_value' => 8,
						),
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-5',
						),
						array(
							'meta_key'   => 'better_slider_gradient',
							'meta_value' => 'simple-gr',
						),
					),
				),

				//
				// Life & Love
				//
				array(
					'the_id'    => 'bs-life',
					'name'      => 'Life & Love',
					'taxonomy'  => 'category',
					'term_meta' => array(
						array(
							'meta_key'   => 'page_listing',
							'meta_value' => 'default',
						),
						array(
							'meta_key'   => 'term_posts_count',
							'meta_value' => 8,
						),
						array(
							'meta_key'   => 'better_slider_style',
							'meta_value' => 'style-7',
						),
						array(
							'meta_key'   => 'better_slider_gradient',
							'meta_value' => 'simple-gr',
						),
						array(
							'meta_key'   => 'term_color',
							'meta_value' => '#19bd00',
						),
					),
				),
			)
		), // taxonomies


		//
		// ->Medias
		//
		'media'    => array(

			'multi_steps'           => true,
			'uninstall_multi_steps' => false,

			array(
				'the_id' => 'bs-logo',
				'file'   => $demo_image_url . $prefix . 'logo.png',
				'resize' => false,
			),
			array(
				'the_id' => 'bs-media-ad-728',
				'file'   => $demo_image_url . $prefix . 'ad-728.jpg',
				'resize' => false,
			),
			array(
				'the_id' => 'bs-media-ad-300',
				'file'   => $demo_image_url . $prefix . 'ad-300.jpg',
				'resize' => false,
			),
			array(
				'the_id' => 'bs-media-1',
				'file'   => $demo_image_url . $prefix . 'thumb-1.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-2',
				'file'   => $demo_image_url . $prefix . 'thumb-2.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-3',
				'file'   => $demo_image_url . $prefix . 'thumb-3.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-4',
				'file'   => $demo_image_url . $prefix . 'thumb-4.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-5',
				'file'   => $demo_image_url . $prefix . 'thumb-5.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-6',
				'file'   => $demo_image_url . $prefix . 'thumb-6.jpg',
				'resize' => true
			),
			array(
				'the_id' => 'bs-media-7',
				'file'   => $demo_image_url . $prefix . 'thumb-7.jpg',
				'resize' => true
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
				'the_id' => 'bs-media-13',
				'file'   => $demo_image_url . $prefix . 'thumb-13.jpg',
				'resize' => true,
			),
			array(
				'the_id' => 'bs-media-14',
				'file'   => $demo_image_url . $prefix . 'thumb-14.jpg',
				'resize' => true,
			),
			array(
				'the_id' => 'bs-media-15',
				'file'   => $demo_image_url . $prefix . 'thumb-15.jpg',
				'resize' => true,
			),
			array(
				'the_id' => 'bs-media-16',
				'file'   => $demo_image_url . $prefix . 'thumb-16.jpg',
				'resize' => true,
			),
			array(
				'the_id' => 'bs-media-17',
				'file'   => $demo_image_url . $prefix . 'thumb-17.jpg',
				'resize' => true,
			),
			array(
				'the_id' => 'bs-media-18',
				'file'   => $demo_image_url . $prefix . 'thumb-18.jpg',
				'resize' => true,
			),
			array(
				'the_id' => 'bs-media-post-content-1',
				'file'   => $demo_image_url . $prefix . 'post-content-1.jpg',
				'resize' => false,
			),
		), // media


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
					'post_title'        => 'Homepage 8 - Blog',
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
					'post_title'        => 'Homepage 9 - Blog',
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
					'post_title'        => 'Homepage 10 - Infinity',
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
				// First posts
				//
				array(
					'the_id'            => 'bs-post-fashion-1',
					'post_title'        => 'Vogue festival: dolce and gabbana&#x2019;s fashion',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-2%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					),
				),
				array(
					'the_id'            => 'bs-post-beauty-1',
					'post_title'        => 'Why cindy wouldn&#x2019;t change a thing',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-15%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-hollywood-makeover%%,%%bs-makeup%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					)
				),
				array(
					'the_id'            => 'bs-post-life-1',
					'post_title'        => 'Why chiuri at dior is the right choice',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-1%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
					'post_format'       => 'audio',
					'post_meta'         => array(
						array(
							'meta_key'   => '_featured_embed_code',
							'meta_value' => 'https://soundcloud.com/lifeofdesiigner/desiigner-panda',
						)
					)
				),
				array(
					'the_id'            => 'bs-post-fashion-2',
					'post_title'        => 'Maria Grazia Chiuri confirmed at dior',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-6%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-street-fashion%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					),
				),


				//
				// Fashion posts
				//


				array(
					'the_id'            => 'bs-post-fashion-3',
					'post_title'        => 'Bill cunningham&#x2019;s fitting NYC tribute',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-7%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-vogue%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					),
				),
				array(
					'the_id'            => 'bs-post-fashion-4',
					'post_title'        => 'Scarlett&#x2019;s disappointment at latest accolade',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-8%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-street-fashion%%,%%bs-vogue%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					),
				),
				array(
					'the_id'            => 'bs-post-fashion-5',
					'post_title'        => 'Woolmark announces british isles winners',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-1%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-look-of-day%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					),
				),
				array(
					'the_id'            => 'bs-post-fashion-6',
					'post_title'        => 'Who vetoed Leo&#x2019;s baywatch role?',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-2%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-look-of-day%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					),
				),
				array(
					'the_id'            => 'bs-post-fashion-7',
					'post_title'        => 'Alicia Vikander covers august vogue',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-3%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-look-of-day%%,%%bs-vogue%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					),
				),
				array(
					'the_id'            => 'bs-post-fashion-8',
					'post_title'        => 'Vogue 100 exhibition moves to manchester',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-4%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-look-of-day%%,%%bs-vogue%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					),
				),
				array(
					'the_id'            => 'bs-post-fashion-9',
					'post_title'        => 'Scarlett becomes highest-grossing actress ever',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-11%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-street-fashion%%,%%bs-look-of-day%%',
					),
				),
				array(
					'the_id'            => 'bs-post-fashion-10',
					'post_title'        => 'A Guide to the Best Jeans for Flat Butts',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-12%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-vogue%%,%%bs-look-of-day%%',
					),
				),
				array(
					'the_id'            => 'bs-post-fashion-10',
					'post_title'        => 'Vestiaire collective launches scandinavian',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-5%%',
					'post_terms'        => array(
						'category' => '%%bs-fashion-today%%,%%bs-vogue%%%%bs-look-of-day%%',
					),
				),


				//
				// Beauty posts
				//

				array(
					'the_id'            => 'bs-post-beauty-2',
					'post_title'        => '7 Gorgeous Greige Lipsticks You Need, Stat',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-13%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-makeup%%,%%bs-health%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					)
				),
				array(
					'the_id'            => 'bs-post-beauty-3',
					'post_title'        => 'What Beyonc&#xE9; said about her wedding dress',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-14%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-hollywood-makeover%%,%%bs-health%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						),
						array(
							'meta_key'   => '_featured_embed_code',
							'meta_value' => 'https://soundcloud.com/lifeofdesiigner/desiigner-panda',
						)
					),
					'post_format'       => 'audio',
				),
				array(
					'the_id'            => 'bs-post-beauty-4',
					'post_title'        => 'The differences between Hailey and Gigi',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-16%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-makeup%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					)
				),
				array(
					'the_id'            => 'bs-post-beauty-5',
					'post_title'        => 'How to Fade the Appearance of Stretch Marks',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-17%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-hollywood-makeover%%,%%bs-health%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					)
				),
				array(
					'the_id'            => 'bs-post-beauty-6',
					'post_title'        => 'Meryl Reveals devil wears prada inspiration',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-18%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-makeup%%,%%bs-health%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					)
				),
				array(
					'the_id'            => 'bs-post-beauty-7',
					'post_title'        => 'How to Fight Frizz for Every Hair Type',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-8%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-hollywood-makeover%%',
					),
				),
				array(
					'the_id'            => 'bs-post-beauty-8',
					'post_title'        => 'Nail Art Know How: Dotted Half Moon Manicure',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-6%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-health%%,%%bs-makeup%%',
					),
				),
				array(
					'the_id'            => 'bs-post-beauty-9',
					'post_title'        => 'Prince William on the duchess&#x2019;s cooking skills',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-14%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-hollywood-makeover%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					)
				),
				array(
					'the_id'            => 'bs-post-beauty-10',
					'post_title'        => 'Nail Art Know How: The Dotted French Manicure',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-11%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-makeup%%',
					),
				),
				array(
					'the_id'            => 'bs-post-beauty-11',
					'post_title'        => '5 Perfect Mani-Pedi Combos for Every Summer Occasion',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-12%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-health%%,%%bs-hollywood-makeover%%',
					),
				),
				array(
					'the_id'            => 'bs-post-beauty-12',
					'post_title'        => 'Revamp Your Routine with Our 2016 Best Beauty Buys',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-17%%',
					'post_terms'        => array(
						'category' => '%%bs-beauty%%,%%bs-health%%,%%bs-makeup%%',
					),
					'post_meta'         => array(
						array(
							'meta_key'   => 'bs_featured_image_credit',
							'meta_value' => 'Photo credit: photographed by Pressfoto on Freepik.com',
						)
					)
				),

				//
				// Life posts
				//

				array(
					'the_id'            => 'bs-post-life-2',
					'post_title'        => 'Victoria strongly denies leave vote',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-2%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
					'post_format'       => 'video',
					'post_meta'         => array(
						array(
							'meta_key'   => '_featured_embed_code',
							'meta_value' => 'https://www.youtube.com/watch?v=708mjaHTwKc',
						)
					)
				),
				array(
					'the_id'            => 'bs-post-life-3',
					'post_title'        => 'Leonardo DiCaprio to testify in libel case',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-12%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-life-4',
					'post_title'        => 'John Lewis reveals first luxury edit',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-7%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
					'post_format'       => 'video',
					'post_meta'         => array(
						array(
							'meta_key'   => '_featured_embed_code',
							'meta_value' => 'https://www.youtube.com/watch?v=eIpKzWU5Z2s',
						)
					)
				),
				array(
					'the_id'            => 'bs-post-life-5',
					'post_title'        => 'Anne named un goodwill ambassador',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-3%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-life-6',
					'post_title'        => 'Alibaba boss defends counterfeit controversy',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-9%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-life-7',
					'post_title'        => 'Louis Vuitton in Rio: the vogue verdict',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-10%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-life-8',
					'post_title'        => 'Why Charlize is using her fame for good',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-4%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-life-9',
					'post_title'        => 'Angelina Jolie to guest edit woman&#x2019;s hour',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-2%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-life-10',
					'post_title'        => 'Kim Cattrall opens up on chronic insomnia',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-5%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-life-11',
					'post_title'        => 'Jacobs, Browne and Beyonc&#xE9; win at CFDAS',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-3%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
					),
				),
				array(
					'the_id'            => 'bs-post-life-12',
					'post_title'        => 'Scarlett&#x2019;s disappointment at latest accolade',
					'post_excerpt_file' => $demo_path . 'post-excerpt-1.txt',
					'post_content_file' => $demo_path . 'post-content-1.txt',
					'thumbnail_id'      => '%%bs-media-6%%',
					'post_terms'        => array(
						'category' => '%%bs-life%%',
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
							'meta_key'   => 'caption',
							'meta_value' => '- Advertisement -'
						),
						array(
							'meta_key'   => 'url',
							'meta_value' => 'http://themeforest.net/item/x/15801051?ref=Better-Studio'
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
							'meta_key'   => 'caption',
							'meta_value' => '- Advertisement -'
						),
						array(
							'meta_key'   => 'url',
							'meta_value' => 'http://themeforest.net/item/x/15801051?ref=Better-Studio'
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


		//
		// ->Menus
		//
		'menus'    => array(
			'multi_step' => false,

			array(

				//
				// Topbar navigation
				//
				array(
					'menu-name'     => 'Topbar Navigation',
					'menu-location' => 'top-menu',
					'items'         => array(
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-life%%',
							'taxonomy'  => 'category',
							'title'     => 'Life <i>&</i> Love',
						),
						array(
							'the_id'    => 'bs-menu-top-lifestyle',
							'item_type' => 'term',
							'term_id'   => '%%bs-beauty%%',
							'taxonomy'  => 'category',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-makeup%%',
							'taxonomy'  => 'category',
							'parent-id' => '%%bs-menu-top-lifestyle%%',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-health%%',
							'taxonomy'  => 'category',
							'parent-id' => '%%bs-menu-top-lifestyle%%',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-hollywood-makeover%%',
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
							'item_meta' => array(
								array(
									'meta_key'   => 'menu_icon',
									'meta_value' => array(
										'icon'   => 'fa-home',
										'type'   => 'fontawesome',
										'width'  => '',
										'height' => '',
									),
								),
							),
						),
						array(
							'the_id'    => 'bs-menu-top-lifestyle',
							'item_type' => 'term',
							'term_id'   => '%%bs-beauty%%',
							'taxonomy'  => 'category',
							'item_meta' => array(
								array(
									'meta_key'   => 'menu_icon',
									'meta_value' => array(
										'icon'   => 'fa-leaf',
										'type'   => 'fontawesome',
										'width'  => '',
										'height' => '',
									),
								),
							),
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-life%%',
							'taxonomy'  => 'category',
							'title'     => 'Life <i>&</i> Love',
							'item_meta' => array(
								array(
									'meta_key'   => 'menu_icon',
									'meta_value' => array(
										'icon'   => 'fa-apple',
										'type'   => 'fontawesome',
										'width'  => '',
										'height' => '',
									),
								),
							)
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-fashion-today%%',
							'taxonomy'  => 'category',
							'item_meta' => array(
								array(
									'meta_key'   => 'menu_icon',
									'meta_value' => array(
										'icon'   => 'fa-child',
										'type'   => 'fontawesome',
										'width'  => '',
										'height' => '',
									),
								),
							),
						),
						array(
							'item_type' => 'custom',
							'title'     => 'Purchase Theme',
							'target'    => '_blank',
							'url'       => 'http://themeforest.net/item/x/15801051?ref=Better-Studio',
							'item_meta' => array(
								array(
									'meta_key'   => 'menu_icon',
									'meta_value' => array(
										'icon'   => 'fa-shopping-car',
										'type'   => 'fontawesome',
										'width'  => '',
										'height' => '',
									),
								),
							),
						),
					)
				),


				//
				// Main navigation
				//
				array(
					'menu-name'     => 'Main Navigation',
					'menu-location' => 'main-menu',
					'recently-edit' => true,
					'items'         => array(
						array(
							'the_id'    => 'bs-homepages-parent',
							'item_type' => 'page',
							'page_id'   => '%%bs-front-page%%',
							'title'     => 'Home',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-front-page%%',
							'parent-id' => '%%bs-homepages-parent%%',
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
							'parent-id' => '%%bs-homepages-parent%%',
							'title'     => 'Homepage 2',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-3%%',
							'parent-id' => '%%bs-homepages-parent%%',
							'title'     => 'Homepage 3',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-4%%',
							'parent-id' => '%%bs-homepages-parent%%',
							'title'     => 'Homepage 4',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-5%%',
							'parent-id' => '%%bs-homepages-parent%%',
							'title'     => 'Homepage 5',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-6%%',
							'parent-id' => '%%bs-homepages-parent%%',
							'title'     => 'Homepage 6',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-7%%',
							'parent-id' => '%%bs-homepages-parent%%',
							'title'     => 'Homepage 7',
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-8%%',
							'parent-id' => '%%bs-homepages-parent%%',
							'title'     => 'Homepage 8',
							'item_meta' => array(
								array(
									'meta_key'   => 'badge_label',
									'meta_value' => 'Blog',
								),
							),
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-9%%',
							'parent-id' => '%%bs-homepages-parent%%',
							'title'     => 'Homepage 9',
							'item_meta' => array(
								array(
									'meta_key'   => 'badge_label',
									'meta_value' => 'Blog',
								),
							),
						),
						array(
							'item_type' => 'page',
							'page_id'   => '%%bs-homepage-10%%',
							'parent-id' => '%%bs-homepages-parent%%',
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
							'term_id'   => '%%bs-fashion-today%%',
							'taxonomy'  => 'category',
							'title'     => '<b>Fashion</b> Today',
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
							'term_id'   => '%%bs-life%%',
							'taxonomy'  => 'category',
							'title'     => 'Life <i>&</i> Love',
						),
						array(
							'item_type' => 'term',
							'term_id'   => '%%bs-beauty%%',
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
							'term_id'   => '%%bs-street-fashion%%',
							'taxonomy'  => 'category',
							'title'     => 'Street <b>Fashion</b>',
						),

					)
				),

			),

		), // menus

	);
}