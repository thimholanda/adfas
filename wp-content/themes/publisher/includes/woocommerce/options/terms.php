<?php
/**
 * terms.php
 *---------------------------
 * Registers options for WooCommerce terms
 *
 */

add_filter( 'better-framework/taxonomy/options', 'publisher_wc_terms_options', 100 );

if ( ! function_exists( 'publisher_wc_terms_options' ) ) {
	/**
	 * Setup custom WooCommerce terms options
	 *
	 * @param $options
	 *
	 * @return array
	 */
	function publisher_wc_terms_options( $options ) {

		$fields = array();

		/**
		 * => Style
		 */
		$fields[]              = array(
			'name' => __( 'Style', 'publisher' ),
			'id'   => 'tab_style',
			'type' => 'tab',
			'icon' => 'bsai-paint',
		);
		$fields['page_layout'] = array(
			'name'             => __( 'Page Layout', 'publisher' ),
			'id'               => 'page_layout',
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Select and override page layout for this page.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);

		// todo add header options

		/**
		 *
		 * Adds custom CSS options for metabox
		 *
		 */
		bf_inject_panel_custom_css_fields( $fields );

		$options[] = array(
			'config'   => array(
				'taxonomies' => array( 'product_cat', 'product_tag' ),
				'name'       => __( 'Better Options', 'publisher' )
			),
			'panel-id' => publisher_get_theme_panel_id(),
			'fields'   => $fields
		);

		return $options;

	} // publisher_tag_options
} // if
