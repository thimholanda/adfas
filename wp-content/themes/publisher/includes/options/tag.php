<?php
/**
 * tag.php
 *---------------------------
 * Registers options for tag
 *
 */

add_filter( 'better-framework/taxonomy/options', 'publisher_tag_options', 100 );

if ( ! function_exists( 'publisher_tag_options' ) ) {
	/**
	 * Setup custom taxonomy options
	 *
	 * @param $options
	 *
	 * @return array
	 */
	function publisher_tag_options( $options ) {

		$fields = array();

		/**
		 * => Style
		 */
		$fields[]                       = array(
			'name' => __( 'Style', 'publisher' ),
			'id'   => 'tab_style',
			'type' => 'tab',
			'icon' => 'bsai-paint',
		);
		$fields['page_layout']          = array(
			'name'             => __( 'Page Layout', 'publisher' ),
			'id'               => 'page_layout',
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Select and override page layout for this tag.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);
		$fields['page_listing']         = array(
			'name'             => __( 'Posts Listing', 'publisher' ),
			'id'               => 'page_listing',
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Select and override posts listing for this tag.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_listing_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);
		$fields['term_posts_count']     = array(
			'name' => __( 'Number of Post to Show', 'publisher' ),
			'id'   => 'term_posts_count',
			'desc' => wp_kses( sprintf( __( 'Leave this empty for default. <br>Default: %s', 'publisher' ), publisher_get_option( 'archive_tag_posts_count' ) != '' ? publisher_get_option( 'archive_tag_posts_count' ) : get_option( 'posts_per_page' ) ), bf_trans_allowed_html() ),
			'type' => 'text',
			'std'  => '',
		);
		$fields['term_pagination_type'] = array(
			'name'             => __( 'Tag pagination', 'publisher' ),
			'id'               => 'term_pagination_type',
			'std'              => 'default',
			'type'             => 'select',
			'desc'             => __( 'Select pagination of this tag.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_pagination_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);

		/**
		 * => Title
		 */
		$fields[]                        = array(
			'name' => __( 'Title', 'publisher' ),
			'id'   => 'tab_title',
			'type' => 'tab',
			'icon' => 'bsai-title',
		);
		$fields['term_custom_pre_title'] = array(
			'name' => __( 'Custom Pre Title', 'publisher' ),
			'id'   => 'term_custom_pre_title',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Customize tag pre title with this option for making tag page more specific.', 'publisher' ),
		);
		$fields['term_custom_title']     = array(
			'name' => __( 'Custom Tag Title', 'publisher' ),
			'id'   => 'term_custom_title',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Change tag title or leave empty for default title', 'publisher' ),
		);
		$fields['hide_term_title']       = array(
			'name'      => __( 'Hide Tag Title', 'publisher' ),
			'id'        => 'hide_term_title',
			'type'      => 'switch',
			'std'       => '0',
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'Enable this for hiding tag title', 'publisher' ),
		);
		$fields['hide_term_description'] = array(
			'name'      => __( 'Hide Tag Description', 'publisher' ),
			'id'        => 'hide_term_description',
			'type'      => 'switch',
			'std'       => '0',
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'Enable this for hiding tag description', 'publisher' ),
		);


		/**
		 *
		 * Adds custom CSS options for metabox
		 *
		 */
		bf_inject_panel_custom_css_fields( $fields );


		//
		// Support to custom taxonomies
		//
		$tag_taxonomies = array( 'post_tag' );

		if ( publisher_get_option( 'advanced_tag_options_tax' ) != '' ) {
			$tag_taxonomies = array_merge( explode( ',', publisher_get_option( 'advanced_tag_options_tax' ) ), $tag_taxonomies );
		}

		$options[] = array(
			'config'   => array(
				'taxonomies' => $tag_taxonomies,
				'name'       => __( 'Better Tag Options', 'publisher' )
			),
			'panel-id' => publisher_get_theme_panel_id(),
			'fields'   => $fields
		);

		return $options;

	} // publisher_tag_options
} // if
