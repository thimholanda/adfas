<?php
/**
 * bs-sliders.php
 *---------------------------
 * [bs-sldiers-{1,2,3}] shortcode
 *
 */


/**
 * Publisher Slider 1
 */
class Publisher_Slider_1_Shortcode extends Publisher_Theme_Listing_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-slider-1';

		$this->name = __( 'Slider 1', 'publisher' );

		$this->description = '';

		$_options = array(
			'defaults'       => array(
				'title'      => '',
				'hide_title' => 1,
				'icon'       => '',

				'category'    => '',
				'tag'         => '',
				'post_ids'    => '',
				'post_type'   => '',
				'offset'      => '',
				'count'       => 4,
				'order_by'    => 'date',
				'order'       => 'DESC',
				'time_filter' => '',

				'style' => 'slider-1',

				'animation'       => 'fade',
				'slideshow_speed' => 7000,
				'animation_speed' => 600,

				'tabs'            => FALSE,
				'tabs_cat_filter' => '',
			),
			'have_widget'    => FALSE,
			'have_vc_add_on' => TRUE,
		);

		$_options = wp_parse_args( $_options, $options );

		parent::__construct( $id, $_options );

	}


	/**
	 * Display the inner content of listing
	 *
	 * @param string $atts         Attribute of shortcode or ajax action
	 * @param string $tab          Tab
	 * @param string $pagin_button Ajax action button
	 */
	function display_content( &$atts, $tab = '', $pagin_button = '' ) {
		publisher_set_prop( 'bs-slider-1', $atts );
		publisher_get_view( 'shortcodes', 'bs-slider-1' );
	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {

		vc_map(
			array(
				"name"           => $this->name,
				"base"           => $this->id,
				"icon"           => $this->icon,
				"description"    => $this->description,
				"weight"         => 10,
				"wrapper_height" => 'full',
				"category"       => __( 'Publisher', 'publisher' ),
				"params"         => array_merge(
					$this->vc_map_listing_filters(),
					array(
						array(
							"type"        => 'bf_select',
							"admin_label" => TRUE,
							"heading"     => __( 'Animation', 'publisher' ),
							"param_name"  => 'animation',
							"value"       => $this->defaults['animation'],
							"options"     => array(
								'slide' => __( 'Slide', 'publisher' ),
								'fade'  => __( 'Fade', 'publisher' ),
							),
							'group'       => __( 'Slider', 'publisher' ),
						),
						array(
							"type"        => 'textfield',
							"admin_label" => TRUE,
							"heading"     => __( 'Slideshow Speed', 'publisher' ),
							"param_name"  => 'slideshow_speed',
							"value"       => $this->defaults['slideshow_speed'],
							'description' => __( 'Set the speed of the slideshow cycling, in milliseconds', 'publisher' ),
							'group'       => __( 'Slider', 'publisher' ),
						),
						array(
							"type"        => 'textfield',
							"admin_label" => TRUE,
							"heading"     => __( 'Animation Speed', 'publisher' ),
							"param_name"  => 'animation_speed',
							"value"       => $this->defaults['animation_speed'],
							'description' => __( 'Set the speed of animations, in milliseconds', 'publisher' ),
							'group'       => __( 'Slider', 'publisher' ),
						),
						array(
							"type"        => 'textfield',
							"admin_label" => TRUE,
							"heading"     => __( 'Title', 'publisher' ),
							"param_name"  => 'title',
							"value"       => $this->defaults['title'],
							'group'       => __( 'Heading', 'publisher' ),
						),
						array(
							"type"        => 'bf_switchery',
							"admin_label" => FALSE,
							"heading"     => __( 'Hide Title?', 'publisher' ),
							"param_name"  => 'hide_title',
							"value"       => $this->defaults['hide_title'],
							'group'       => __( 'Heading', 'publisher' ),
						),
					),
					$this->vc_map_design_options()
				)
			)
		);
	} // register_vc_add_on

} // Publisher_Slider_1_Shortcode


/**
 * Publisher Slider 2
 */
class Publisher_Slider_2_Shortcode extends Publisher_Theme_Listing_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-slider-2';

		$this->name = __( 'Slider 2', 'publisher' );

		$this->description = '';

		$_options = array(
			'defaults'       => array(
				'title'      => '',
				'hide_title' => 1,
				'icon'       => '',

				'category'    => '',
				'tag'         => '',
				'post_ids'    => '',
				'post_type'   => '',
				'offset'      => '',
				'count'       => 4,
				'order_by'    => 'date',
				'order'       => 'DESC',
				'time_filter' => '',

				'style' => 'slider-2',

				'animation'       => 'fade',
				'slideshow_speed' => 7000,
				'animation_speed' => 600,

				'tabs'            => FALSE,
				'tabs_cat_filter' => '',
			),
			'have_widget'    => FALSE,
			'have_vc_add_on' => TRUE,
		);

		$_options = wp_parse_args( $_options, $options );

		parent::__construct( $id, $_options );

	}


	/**
	 * Display the inner content of listing
	 *
	 * @param string $atts         Attribute of shortcode or ajax action
	 * @param string $tab          Tab
	 * @param string $pagin_button Ajax action button
	 */
	function display_content( &$atts, $tab = '', $pagin_button = '' ) {
		publisher_set_prop( 'bs-slider-2', $atts );
		publisher_get_view( 'shortcodes', 'bs-slider-2' );
	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {
		vc_map(
			array(
				"name"           => $this->name,
				"base"           => $this->id,
				"icon"           => $this->icon,
				"description"    => $this->description,
				"weight"         => 10,
				"wrapper_height" => 'full',
				"category"       => __( 'Publisher', 'publisher' ),
				"params"         => array_merge(
					$this->vc_map_listing_filters(),
					array(
						array(
							"type"        => 'bf_select',
							"admin_label" => TRUE,
							"heading"     => __( 'Animation', 'publisher' ),
							"param_name"  => 'animation',
							"value"       => $this->defaults['animation'],
							"options"     => array(
								'slide' => __( 'Slide', 'publisher' ),
								'fade'  => __( 'Fade', 'publisher' ),
							),
							'group'       => __( 'Slider', 'publisher' ),
						),
						array(
							"type"        => 'textfield',
							"admin_label" => TRUE,
							"heading"     => __( 'Slideshow Speed', 'publisher' ),
							"param_name"  => 'slideshow_speed',
							"value"       => $this->defaults['slideshow_speed'],
							'description' => __( 'Set the speed of the slideshow cycling, in milliseconds', 'publisher' ),
							'group'       => __( 'Slider', 'publisher' ),
						),
						array(
							"type"        => 'textfield',
							"admin_label" => TRUE,
							"heading"     => __( 'Animation Speed', 'publisher' ),
							"param_name"  => 'animation_speed',
							"value"       => $this->defaults['animation_speed'],
							'description' => __( 'Set the speed of animations, in milliseconds', 'publisher' ),
							'group'       => __( 'Slider', 'publisher' ),
						),
						array(
							"type"        => 'textfield',
							"admin_label" => TRUE,
							"heading"     => __( 'Title', 'publisher' ),
							"param_name"  => 'title',
							"value"       => $this->defaults['title'],
							'group'       => __( 'Heading', 'publisher' ),
						),
						array(
							"type"        => 'bf_switchery',
							"admin_label" => FALSE,
							"heading"     => __( 'Hide Title?', 'publisher' ),
							"param_name"  => 'hide_title',
							"value"       => $this->defaults['hide_title'],
							'group'       => __( 'Heading', 'publisher' ),
						),
					),
					$this->vc_map_design_options()
				)
			)
		);
	} // register_vc_add_on

} // Publisher_Slider_2_Shortcode


/**
 * Publisher Slider 3
 */
class Publisher_Slider_3_Shortcode extends Publisher_Theme_Listing_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-slider-3';

		$this->name = __( 'Slider 3', 'publisher' );

		$this->description = '';

		$_options = array(
			'defaults'       => array(
				'title'      => '',
				'hide_title' => 1,
				'icon'       => '',

				'category'    => '',
				'tag'         => '',
				'post_ids'    => '',
				'post_type'   => '',
				'offset'      => '',
				'count'       => 4,
				'order_by'    => 'date',
				'order'       => 'DESC',
				'time_filter' => '',

				'style' => 'slider-3',

				'animation'       => 'fade',
				'slideshow_speed' => 7000,
				'animation_speed' => 600,

				'tabs'            => FALSE,
				'tabs_cat_filter' => '',
			),
			'have_widget'    => FALSE,
			'have_vc_add_on' => TRUE,
		);

		$_options = wp_parse_args( $_options, $options );

		parent::__construct( $id, $_options );

	}


	/**
	 * Display the inner content of listing
	 *
	 * @param string $atts         Attribute of shortcode or ajax action
	 * @param string $tab          Tab
	 * @param string $pagin_button Ajax action button
	 */
	function display_content( &$atts, $tab = '', $pagin_button = '' ) {
		publisher_set_prop( 'bs-slider-3', $atts );
		publisher_get_view( 'shortcodes', 'bs-slider-3' );
	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {
		vc_map(
			array(
				"name"           => $this->name,
				"base"           => $this->id,
				"icon"           => $this->icon,
				"description"    => $this->description,
				"weight"         => 10,
				"wrapper_height" => 'full',
				"category"       => __( 'Publisher', 'publisher' ),
				"params"         => array_merge(
					$this->vc_map_listing_filters(),
					array(
						array(
							"type"        => 'bf_select',
							"admin_label" => TRUE,
							"heading"     => __( 'Animation', 'publisher' ),
							"param_name"  => 'animation',
							"value"       => $this->defaults['animation'],
							"options"     => array(
								'slide' => __( 'Slide', 'publisher' ),
								'fade'  => __( 'Fade', 'publisher' ),
							),
							'group'       => __( 'Slider', 'publisher' ),
						),
						array(
							"type"        => 'textfield',
							"admin_label" => TRUE,
							"heading"     => __( 'Slideshow Speed', 'publisher' ),
							"param_name"  => 'slideshow_speed',
							"value"       => $this->defaults['slideshow_speed'],
							'description' => __( 'Set the speed of the slideshow cycling, in milliseconds', 'publisher' ),
							'group'       => __( 'Slider', 'publisher' ),
						),
						array(
							"type"        => 'textfield',
							"admin_label" => TRUE,
							"heading"     => __( 'Animation Speed', 'publisher' ),
							"param_name"  => 'animation_speed',
							"value"       => $this->defaults['animation_speed'],
							'description' => __( 'Set the speed of animations, in milliseconds', 'publisher' ),
							'group'       => __( 'Slider', 'publisher' ),
						),
						array(
							"type"        => 'textfield',
							"admin_label" => TRUE,
							"heading"     => __( 'Title', 'publisher' ),
							"param_name"  => 'title',
							"value"       => $this->defaults['title'],
							'group'       => __( 'Heading', 'publisher' ),
						),
						array(
							"type"        => 'bf_switchery',
							"admin_label" => FALSE,
							"heading"     => __( 'Hide Title?', 'publisher' ),
							"param_name"  => 'hide_title',
							"value"       => $this->defaults['hide_title'],
							'group'       => __( 'Heading', 'publisher' ),
						),
					),
					$this->vc_map_design_options()
				)
			)
		);
	} // register_vc_add_on

} // Publisher_Slider_3_Shortcode
