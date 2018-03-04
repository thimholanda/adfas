<?php
/**
 * metabox.php
 *---------------------------
 * Registers options for products
 *
 */

add_filter( 'better-framework/metabox/options', 'publisher_wc_product_metabox_options', 100 );


if ( ! function_exists( 'publisher_wc_product_metabox_options' ) ) {
	/**
	 * Setup custom metaboxe
	 *
	 * @param $options
	 *
	 * @return array
	 */
	function publisher_wc_product_metabox_options( $options ) {

		$fields = array();

		/**
		 * => Post Options
		 */
		$fields['_pr_options'] = array(
			'name' => __( 'Product', 'publisher' ),
			'id'   => '_pr_options',
			'type' => 'tab',
			'icon' => 'bsai-page-text',
		);

		$fields['page_layout'] = array(
			'name'             => __( 'Product Page Layout', 'publisher' ),
			'id'               => 'page_layout',
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered affect-editor-on-change',
			'desc'             => __( 'Override page layout for this product.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);


		// todo add support to header options

		/**
		 *
		 * Adds custom CSS options for metabox
		 *
		 */
		bf_inject_panel_custom_css_fields( $fields );


		/**
		 * => General Post Options
		 */
		$options['better_wc_product_options'] = array(
			'config'   => array(
				'title'    => __( 'Product Options', 'publisher' ),
				'pages'    => 'product',
				'context'  => 'normal',
				'prefix'   => FALSE,
				'priority' => 'high'
			),
			'panel-id' => publisher_get_theme_panel_id(),
			'fields'   => $fields
		);

		return $options;

	} // publisher_wc_product_metabox_options
} // if