<?php
/**
 * bs-likebox.php
 *---------------------------
 * [bs-likebox] short code & widget
 *
 */

/**
 * Publisher Likebox Shortcode
 */
class Publisher_Likebox_Shortcode extends BF_Shortcode {


	/**
	 * Flag used to determine print Facebook SDK in footer
	 *
	 * @var bool
	 */
	public static $print_footer_sdk = FALSE;


	function __construct( $id, $options ) {

		$id = 'bs-likebox';

		$this->name = __( 'FB Likebox', 'publisher' );

		$this->description = '';

		$_options = array(
			'defaults'       => array(
				'title'           => '',
				'show_title'      => 0,
				'url'             => '',
				'show_faces'      => 1,
				'show_posts'      => 0,
				'bs-show-desktop' => TRUE,
				'bs-show-tablet'  => TRUE,
				'bs-show-phone'   => TRUE,
			),
			'have_widget'    => TRUE,
			'have_vc_add_on' => TRUE,
		);

		$_options = wp_parse_args( $_options, $options );

		parent::__construct( $id, $_options );

		// Hooked to print Facebook JS SDK
		add_action( 'wp_footer', array( $this, 'wp_footer' ) );

	}


	/**
	 * Callback: used to print Facebook SDK in footer
	 *
	 * Action filter: wp_footer
	 */
	public static function wp_footer() {

		// print footer if needed
		if ( self::$print_footer_sdk ) {

			?>
			<div id="fb-root"></div>
			<script>
				(function (d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s);
					js.id = id;
					js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<?php

		}

	}


	/**
	 * Filter custom css codes for shortcode widget!
	 *
	 * @param $fields
	 *
	 * @return array
	 */
	function register_custom_css( $fields ) {
		return $fields;
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

		self::$print_footer_sdk = TRUE;

		ob_start();

		publisher_set_prop( 'shortcode-bs-likebox-atts', $atts );

		publisher_get_view( 'shortcodes', 'bs-likebox' );

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
					"heading"     => __( 'Facebook Page Link', 'publisher' ),
					"param_name"  => 'url',
					"value"       => $this->defaults['url'],
					'group'       => __( 'Facebook', 'publisher' ),
				),
				array(
					"type"        => 'bf_switch',
					"admin_label" => FALSE,
					"heading"     => __( 'Show Posts', 'publisher' ),
					"param_name"  => 'show_posts',
					"value"       => $this->defaults['show_posts'],
					'on-label'    => __( 'Show', 'publisher' ),
					'off-label'   => __( 'Hide', 'publisher' ),
					'group'       => __( 'Facebook', 'publisher' ),
				),

				array(
					"type"        => 'bf_switch',
					"admin_label" => FALSE,
					"heading"     => __( 'Show Faces', 'publisher' ),
					"param_name"  => 'show_faces',
					"value"       => $this->defaults['show_posts'],
					'on-label'    => __( 'Show', 'publisher' ),
					'off-label'   => __( 'Hide', 'publisher' ),
					'group'       => __( 'Facebook', 'publisher' ),
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


/**
 * Publisher Likebox Widget
 */
class Publisher_Likebox_Widget extends BF_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		// Back end form fields
		$this->fields = array(
			array(
				'name'    => __( 'Title (Optional)', 'publisher' ),
				'attr_id' => 'title',
				'type'    => 'text',
			),
			array(
				'name'    => __( 'Facebook Page Link', 'publisher' ),
				'attr_id' => 'url',
				'desc'    => __( 'EG. http://www.facebook.com/envato', 'publisher' ),
				'type'    => 'text',
			),
			array(
				'name'      => __( 'Show Posts', 'publisher' ),
				'attr_id'   => 'show_posts',
				'id'        => 'show_posts',
				'type'      => 'switch',
				'on-label'  => __( 'Show', 'publisher' ),
				'off-label' => __( 'Hide', 'publisher' ),
			),
			array(
				'name'      => __( 'Show Faces', 'publisher' ),
				'attr_id'   => 'show_faces',
				'id'        => 'show_faces',
				'type'      => 'switch',
				'on-label'  => __( 'Show', 'publisher' ),
				'off-label' => __( 'Hide', 'publisher' ),
			),
		);

		parent::__construct(
			'bs-likebox',
			__( 'Publisher - Like Box', 'publisher' ),
			array(
				'description' => __( 'Display a Facebook Like Box', 'publisher' )
			)
		);
	}
}
