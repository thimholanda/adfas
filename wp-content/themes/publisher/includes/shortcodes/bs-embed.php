<?php
/**
 * bs-embed.php
 *---------------------------
 * [bs-embed] short code & widget
 *
 */

/**
 * Publisher Embed Shortcode
 */
class Publisher_Embed_Shortcode extends BF_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-embed';

		$this->name = __( 'Video / Embed', 'publisher' );

		$this->description = '';

		$_options = array(
			'defaults'       => array(
				'title'           => publisher_translation_get( 'widget_video' ),
				'show_title'      => 1,
				'url'             => '',
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

		publisher_set_prop( 'shortcode-bs-embed-atts', $atts );

		publisher_get_view( 'shortcodes', 'bs-embed' );

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
					"type"        => 'textarea',
					"admin_label" => FALSE,
					"heading"     => __( 'Embed or Video URL', 'publisher' ),
					"param_name"  => 'url',
					"value"       => $this->defaults['url'],
					'group'       => __( 'General', 'publisher' ),
				),
				array(
					"type"        => 'textfield',
					"admin_label" => TRUE,
					"heading"     => __( 'Title', 'publisher' ),
					"param_name"  => 'title',
					"value"       => $this->defaults['title'],
					'group'       => __( 'General', 'publisher' ),
				),
				array(
					"type"        => 'bf_switchery',
					"admin_label" => FALSE,
					"heading"     => __( 'Show Title?', 'publisher' ),
					"param_name"  => 'show_title',
					"value"       => $this->defaults['show_title'],
					'group'       => __( 'General', 'publisher' ),
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


/**
 * Publisher Embed Widget
 */
class Publisher_Embed_Widget extends BF_Widget {

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
				'name'    => __( 'Embed or Video URL', 'publisher' ),
				'attr_id' => 'url',
				'type'    => 'textarea',
				'desc'    => __( 'Separate multiple embeds per line.', 'publisher' ),
			),
		);

		parent::__construct(
			'bs-embed',
			__( 'Publisher - Video / Embed', 'publisher' ),
			array(
				'description' => __( 'Display video and audio in sidebar.', 'publisher' )
			)
		);
	}
}