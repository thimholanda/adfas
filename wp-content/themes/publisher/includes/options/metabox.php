<?php
/**
 * metabox.php
 *---------------------------
 * Registers options for posts and pages
 *
 */

add_filter( 'better-framework/metabox/options', 'publisher_metabox_options', 100 );


if ( ! function_exists( 'publisher_metabox_options' ) ) {
	/**
	 * Setup custom metaboxe
	 *
	 * @param $options
	 *
	 * @return array
	 */
	function publisher_metabox_options( $options ) {

		$fields = array();

		/**
		 * => Post Options
		 */
		$fields['_post_options']            = array(
			'name' => __( 'Post', 'publisher' ),
			'id'   => '_post_options',
			'type' => 'tab',
			'icon' => 'bsai-page-text',
		);
		$fields['bs_featured_image_credit'] = array(
			'name'       => __( 'Featured image credit', 'publisher' ),
			'id'         => 'bs_featured_image_credit',
			'desc'       => __( 'Simple note about featured image credit that will be shown in bottom of featured image.', 'publisher' ),
			'std'        => '',
			'input-desc' => __( 'You can use HTML.', 'publisher' ),
			'type'       => 'editor',
			'lang'       => 'html',
			'min-lines'  => 4,
			'max-lines'  => 6,
		);
		$fields['_featured_embed_code']     = array(
			'name' => __( 'Featured Video/Audio Code', 'publisher' ),
			'id'   => '_featured_embed_code',
			'desc' => __( 'Paste YouTube, Vimeo or self hosted video URL then player automatically will be generated.', 'publisher' ),
			'type' => 'textarea',
			'std'  => '',
		);

		$fields['page_layout'] = array(
			'name'             => __( 'Page Layout', 'publisher' ),
			'id'               => 'page_layout',
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered affect-editor-on-change',
			'desc'             => __( 'Override page layout for this post.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);

		// Page template
		if ( ! is_admin() || bf_get_admin_current_post_type() == 'post' ) {
			$fields['post_template'] = array(
				'name'             => __( 'Post template', 'publisher' ),
				'id'               => 'post_template',
				'std'              => 'default',
				'type'             => 'image_radio',
				'section_class'    => 'style-floated-left bordered',
				'desc'             => __( 'Select default template for post.', 'publisher' ),
				'deferred-options' => array(
					'callback' => 'publisher_get_single_template_option',
					'args'     => array(
						TRUE,
					),
				),
			);

			$fields['_bs_primary_category'] = array(
				'name'    => __( 'Primary Category', 'publisher' ),
				'desc'    => __( 'When you have multiple categories for a post, auto detection chooses one in alphabetical order. These used for show an label above image in listings and breadcrumb.', 'publisher' ),
				'id'      => '_bs_primary_category',
				'std'     => 'auto-detect',
				'type'    => 'select',
				'options' => array(
					'auto-detect' => __( '-- Auto Detect --', 'publisher' ),
					array(
						'label'   => __( 'Categories', 'publisher' ),
						'options' => array( 'category_walker' => 'category_walker' ),
					)
				)
			);

			$fields['_bs_source_name'] = array(
				'name' => __( 'Source name', 'publisher' ),
				'id'   => '_bs_source_name',
				'type' => 'text',
				'std'  => '',
				'desc' => __( 'This name will appear at the end of the article in the "source" section.', 'publisher' ),
			);
			$fields['_bs_source_url']  = array(
				'name' => __( 'Source url', 'publisher' ),
				'id'   => '_bs_source_url',
				'type' => 'text',
				'std'  => '',
				'desc' => __( 'Full url for source', 'publisher' ),
			);
			$fields['_bs_via_name']    = array(
				'name' => __( 'Via name', 'publisher' ),
				'id'   => '_bs_via_name',
				'type' => 'text',
				'std'  => '',
				'desc' => __( 'This name will appear at the end of the article in the "via" section.', 'publisher' ),
			);
			$fields['_bs_via_url']     = array(
				'name' => __( 'Via url', 'publisher' ),
				'id'   => '_bs_via_url',
				'type' => 'text',
				'std'  => '',
				'desc' => __( 'Full url for via', 'publisher' ),
			);
		}
		$fields['post_related']  = array(
			'name'    => __( 'Related Posts', 'publisher' ),
			'id'      => 'post_related',
			'desc'    => __( 'Enabling this will be adds related posts in in bottom of post content.', 'publisher' ),
			'type'    => 'select',
			'std'     => 'default',
			'options' => array(
				'default'               => __( '-- Default [ From Theme Panel ] --', 'publisher' ),
				'show'                  => __( 'Show - Simple', 'publisher' ),
				'infinity-related-post' => __( 'Show - Infinity Ajax Load', 'publisher' ),
				'hide'                  => __( 'Hide', 'publisher' ),
			),
		);
		$fields['post_comments'] = array(
			'name'    => __( 'Comments', 'publisher' ),
			'id'      => 'post_comments',
			'desc'    => __( 'Select to show or hide comments in bottom of post content.', 'publisher' ),
			'type'    => 'select',
			'std'     => 'default',
			'options' => array(
				'default'        => __( '-- Default [ From Theme Panel ] --', 'publisher' ),
				'show-simple'    => __( 'Show, Normal Comments', 'publisher' ),
				'show-ajaxified' => __( 'Ajax - Show Comments Button', 'publisher' ),
				'hide'           => __( 'Hide', 'publisher' ),
			),
		);

		// page fields
		if ( ! is_admin() || bf_get_admin_current_post_type() == 'page' ) {

			$fields['_hide_title'] = array(
				'name'      => __( 'Hide Page Title?', 'publisher' ),
				'id'        => '_hide_title',
				'type'      => 'switch',
				'std'       => '0',
				'on-label'  => __( 'Yes', 'publisher' ),
				'off-label' => __( 'No', 'publisher' ),
				'desc'      => __( 'Enable this for hiding page title', 'publisher' ),
			);

		}

		if ( ! is_admin() || bf_get_admin_current_post_type() == 'page' ) {

			/**
			 * => Header Options
			 */
			$fields['header_options'] = array(
				'name' => __( 'Header', 'publisher' ),
				'id'   => 'header_options',
				'type' => 'tab',
				'icon' => 'bsai-header',
			);
			$fields[]                 = array(
				'name'  => __( 'Header', 'publisher' ),
				'type'  => 'group',
				'state' => 'open',
			);
			$fields['header_style']   = array(
				'name'             => __( 'Header Style', 'publisher' ),
				'id'               => 'header_style',
				'desc'             => __( 'Override header style for this page.', 'publisher' ),
				'std'              => 'default',
				'type'             => 'image_radio',
				'section_class'    => 'style-floated-left bordered',
				'deferred-options' => array(
					'callback' => 'publisher_header_style_option_list',
					'args'     => array(
						TRUE,
					),
				),
			);
			$fields['header_layout']  = array(
				'name'    => __( 'Header Boxed', 'publisher' ),
				'id'      => 'header_layout',
				'desc'    => __( 'Select header layout.', 'publisher' ),
				'std'     => 'default',
				'type'    => 'select',
				'options' => array(
					'default'    => __( '-- Default --', 'publisher' ),
					'boxed'      => __( 'Boxed header', 'publisher' ),
					'full-width' => __( 'Full width header', 'publisher' ),
				),
			);
			$fields['main_nav_menu']  = array(
				'name'             => __( 'Main Navigation Menu', 'publisher' ),
				'id'               => 'main_nav_menu',
				'desc'             => __( 'Replace & change main menu for this page.', 'publisher' ),
				'type'             => 'select',
				'std'              => 'default',
				'deferred-options' => array(
					'callback' => 'bf_get_menus_option',
					'args'     => array(
						TRUE,
						__( '-- Default Main Navigation --', 'publisher' )
					),
				),
			);


			/**
			 * -> Logo
			 */
			$fields[]                        = array(
				'name'  => __( 'Page Custom Logo', 'publisher' ),
				'type'  => 'group',
				'state' => 'open',
			);
			$fields['logo_image']            = array(
				'name'         => __( 'Logo Image', 'publisher' ),
				'id'           => 'logo_image',
				'desc'         => __( 'You can override default site logo for this page.', 'publisher' ),
				'std'          => '',
				'type'         => 'media_image',
				'media_title'  => __( 'Select or Upload Logo', 'publisher' ),
				'media_button' => __( 'Select Image', 'publisher' ),
				'upload_label' => __( 'Upload Logo', 'publisher' ),
				'remove_label' => __( 'Remove Logo', 'publisher' ),
				'save-std'     => FALSE,
			);
			$fields['logo_image_retina']     = array(
				'name'         => __( 'Logo Image Retina (2x)', 'publisher' ),
				'id'           => 'logo_image_retina',
				'desc'         => __( 'You can override default site logo for this page. It requires WP Retina 2x plugin.', 'publisher' ),
				'std'          => '',
				'type'         => 'media_image',
				'media_title'  => __( 'Select or Upload Retina Logo', 'publisher' ),
				'media_button' => __( 'Select Retina Image', 'publisher' ),
				'upload_label' => __( 'Upload Retina Logo', 'publisher' ),
				'remove_label' => __( 'Remove Retina Logo', 'publisher' ),
				'save-std'     => FALSE,
			);
			$fields[]                        = array(
				'name'  => __( 'Header Padding', 'publisher' ),
				'type'  => 'group',
				'state' => 'close',
			);
			$fields['header_top_padding']    = array(
				'name'             => __( 'Header Top Padding', 'publisher' ),
				'id'               => 'header_top_padding',
				'suffix'           => __( 'Pixel', 'publisher' ),
				'desc'             => __( 'In pixels without px, ex: 20. <br>Leave empty for default value.', 'publisher' ),
				'type'             => 'text',
				'std'              => '',
				'css-echo-default' => FALSE,
				'css'              => array(
					array(
						'selector' => array(
							'body.page-id-%%id%% .site-header .header-inner',
						),
						'prop'     => array( 'padding-top' => '%%value%%px !important' ),
					)
				),
			);
			$fields['header_bottom_padding'] = array(
				'name'             => __( 'Header Bottom Padding', 'publisher' ),
				'id'               => 'header_bottom_padding',
				'suffix'           => __( 'Pixel', 'publisher' ),
				'desc'             => __( 'In pixels without px, ex: 20. <br>Leave empty for default value. Values lower than 60px will break the style.', 'publisher' ),
				'type'             => 'text',
				'std'              => '',
				'css-echo-default' => FALSE,
				'css'              => array(
					array(
						'selector' => array(
							'body.page-id-%%id%% .site-header .header-inner',
						),
						'prop'     => array( 'padding-bottom' => '%%value%%px !important' ),
					)
				),
			);


		}


		/**
		 *
		 * Adds custom CSS options for metabox
		 *
		 */
		bf_inject_panel_custom_css_fields( $fields );


		//
		// Support custom post types
		//
		$pages = array( 'post', 'page' );
		if ( publisher_get_option( 'advanced_post_options_types' ) != '' ) {
			$pages = array_merge( explode( ',', publisher_get_option( 'advanced_post_options_types' ) ), $pages );
		}


		/**
		 * => General Post Options
		 */
		$options['better_post_options'] = array(
			'config'   => array(
				'title'    => bf_get_admin_current_post_type() == 'page' ? __( 'Better Page Options', 'publisher' ) : __( 'Better Post Options', 'publisher' ),
				'pages'    => $pages,
				'context'  => 'normal',
				'prefix'   => FALSE,
				'priority' => 'high'
			),
			'panel-id' => publisher_get_theme_panel_id(),
			'fields'   => $fields
		);

		return $options;

	} // publisher_metabox_options
} // if