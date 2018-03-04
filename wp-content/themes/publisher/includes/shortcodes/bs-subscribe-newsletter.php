<?php

/**
 * bs-subscribe-newsletter.php
 *---------------------------
 * [bs-subscribe-newsletter] short code & widget
 *
 */
class Publisher_Subscribe_Newsletter_Shortcode extends BF_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-subscribe-newsletter';

		$this->name = __( 'Newsletter', 'publisher' );

		$this->description = '';

		$_options = array(
			'defaults'       => array(
				'title'           => publisher_translation_get( 'widget_newsletter' ),
				'show_title'      => 1,
				'feedburner-id'   => '',
				'msg'             => '',
				'image'           => '',
				'bs-show-desktop' => TRUE,
				'bs-show-tablet'  => TRUE,
				'bs-show-phone'   => TRUE,
			),
			'have_widget'    => TRUE,
			'have_vc_add_on' => TRUE,
		);

		$_options = wp_parse_args( $_options, $options );

		parent::__construct( $id, $_options );

	}


	/**
	 * Handle displaying of shortcode
	 *
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	function display( array $atts, $content = '' ) {

		ob_start();

		publisher_set_prop( 'shortcode-bs-subscribe-newsletter-atts', $atts );

		publisher_get_view( 'shortcodes', 'bs-subscribe-newsletter' );

		publisher_clear_props();

		return ob_get_clean();

	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {

		vc_map( array(
			"name"           => $this->name,
			"base"           => $this->id,
			"description"    => $this->description,
			"weight"         => 10,
			"wrapper_height" => 'full',

			"category" => __( 'Publisher', 'publisher' ),
			"params"   => array(
				array(
					"type"        => 'textfield',
					"admin_label" => FALSE,
					"heading"     => __( 'Feedburner ID', 'publisher' ),
					"param_name"  => 'feedburner-id',
					"value"       => $this->defaults['feedburner-id'],
					'group'       => __( 'Newsletter', 'publisher' ),
				),
				array(
					"type"         => 'bf_media_image',
					"admin_label"  => FALSE,
					"heading"      => __( 'Image', 'publisher' ),
					"param_name"   => 'image',
					"value"        => $this->defaults['image'],
					'upload_label' => __( 'Upload Image', 'publisher' ),
					'remove_label' => __( 'Remove', 'publisher' ),
					'media_title'  => __( 'Remove', 'publisher' ),
					'media_button' => __( 'Select as Image', 'publisher' ),
					'group'        => __( 'Newsletter', 'publisher' ),
				),
				array(
					"type"        => 'textarea',
					"admin_label" => FALSE,
					"heading"     => __( 'Message', 'publisher' ),
					"param_name"  => 'msg',
					"value"       => $this->defaults['msg'],
					'group'       => __( 'Newsletter', 'publisher' ),
				),
				array(
					"type"        => 'textfield',
					"admin_label" => FALSE,
					"heading"     => __( 'Title', 'publisher' ),
					"param_name"  => 'title',
					"value"       => $this->defaults['title'],
					'group'       => __( 'Heading', 'publisher' ),
				),
				array(
					"type"        => 'bf_switchery',
					"admin_label" => FALSE,
					"heading"     => __( 'Show Title?', 'publisher' ),
					"param_name"  => 'show_title',
					"value"       => $this->defaults['show_title'],
					'group'       => __( 'Heading', 'publisher' ),
				),
				array(
					"type"          => 'bf_switchery',
					"heading"       => __( 'Show on Desktop', 'publisher' ),
					"param_name"    => 'bs-show-desktop',
					"admin_label"   => FALSE,
					"value"         => $this->defaults['bs-show-desktop'],
					'section_class' => 'style-floated-left bordered bf-css-edit-switch',
					'group'         => __( 'Design options', 'publisher' ),
				),
				array(
					"type"          => 'bf_switchery',
					"heading"       => __( 'Show on Tablet Portrait', 'publisher' ),
					"param_name"    => 'bs-show-tablet',
					"admin_label"   => FALSE,
					"value"         => $this->defaults['bs-show-tablet'],
					'section_class' => 'style-floated-left bordered bf-css-edit-switch',
					'group'         => __( 'Design options', 'publisher' ),
				),
				array(
					"type"          => 'bf_switchery',
					"heading"       => __( 'Show on Phone', 'publisher' ),
					"param_name"    => 'bs-show-phone',
					"admin_label"   => FALSE,
					"value"         => $this->defaults['bs-show-phone'],
					'section_class' => 'style-floated-left bordered bf-css-edit-switch',
					'group'         => __( 'Design options', 'publisher' ),
				),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS box', 'publisher' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'publisher' ),
				)
			)
		) );

	} // register_vc_add_on
}


class Publisher_Subscribe_Newsletter_Widget extends BF_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		// Back end form fields
		$this->fields = array(
			array(
				'name'    => __( 'Title', 'publisher' ),
				'attr_id' => 'title',
				'type'    => 'text',
			),
			array(
				'name'       => __( 'FeedBurner ID', 'publisher' ),
				'input-desc' => __( 'Enter Feedburner ID.', 'publisher' ),
				'attr_id'    => 'feedburner-id',
				'type'       => 'text',
			),
			array(
				'name'         => __( 'Image', 'publisher' ),
				'attr_id'      => 'image',
				'type'         => 'media_image',
				'upload_label' => __( 'Upload Image', 'publisher' ),
				'remove_label' => __( 'Remove', 'publisher' ),
				'media_title'  => __( 'Remove', 'publisher' ),
				'media_button' => __( 'Select Image', 'publisher' ),
			),
			array(
				'name'    => __( 'Message', 'publisher' ),
				'attr_id' => 'msg',
				'type'    => 'textarea',
			),
		);

		parent::__construct(
			'bs-subscribe-newsletter',
			__( 'Publisher - Newsletter', 'publisher' ),
			array(
				'description' => __( 'Widget display NewsLetter Subscribe form it support Feedburner.', 'publisher' )
			)
		);

	}
}