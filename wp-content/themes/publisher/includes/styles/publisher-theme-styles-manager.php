<?php

/**
 * Base class of options
 */
class Publisher_Theme_Styles_Manager {

	/**
	 * Contains list of current active styles
	 *
	 * @var array
	 */
	public static $styles = array( 'default' );


	/**
	 * Contains instance of styles classes
	 *
	 * @var array
	 */
	public $style_instances = array();


	/**
	 * Contains current active style ID
	 *
	 * @var string
	 */
	public static $current_style = 'default';


	/**
	 * Contains current active demo ID
	 *
	 * @var mixed|string
	 */
	public static $current_demo = '';


	/**
	 * Contains styles dir path
	 *
	 * @var string
	 */
	public static $style_dir = '';


	/**
	 * Contains styles directory URI
	 *
	 * @var string
	 */
	public static $style_uri = '';


	/**
	 * Base theme styles initializer
	 */
	public function __construct() {

		//
		// Cache current state
		//
		self::$current_style = publisher_get_style( TRUE );
		self::$current_demo  = publisher_get_demo_id();
		self::$style_dir     = get_template_directory() . '/includes/styles/';
		self::$style_uri     = get_template_directory_uri() . '/includes/styles/';


		// loads all styles when bf panel is saving to fix issues!
		if ( defined( 'DOING_AJAX' ) && isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'bf_ajax' ) {
			$all_styles = publisher_styles_config();
			$styles     = array_keys( $all_styles );
		} else {
			if ( self::$current_style == 'default' ) {
				$styles = array( 'default' );
			} else {
				$styles = array( 'default', self::$current_style );
			}
		}

		// Set styles
		self::set_styles( $styles );

		$all_demos = publisher_demos_config();

		foreach ( $styles as $style ) {

			// default style is in base fields and there is no preparation for that
			if ( $style == 'default' ) {
				continue;
			}

			$class = $this->get_class_name( $style );

			// add style options
			include_once self::get_path( $style . '/bs-theme-style-' . $style . '.php' );

			$style_demo_id = $style . '-' . self::$current_demo;

			// Add demo of style to options
			if ( isset( $all_demos[ $style_demo_id ] ) && isset( $all_demos[ $style_demo_id ]['options'] ) && $all_demos[ $style_demo_id ]['options'] ) {

				include_once self::get_path( $style . '/' . self::$current_demo . '/bs-theme-style-' . $style . '-' . self::$current_demo . '.php' );

				$demo_class = $this->get_class_name( $style, self::$current_demo );
				$this->add_style_instance( new $demo_class );

			} // Add style
			else {
				$this->add_style_instance( new $class );

			}

		}

		add_filter( 'better-framework/panel/options', array( $this, 'init_panel_options' ), 10 );
		add_filter( 'better-framework/taxonomy/options', array( $this, 'init_category_metabox' ), 10 );

	}


	/**
	 * Used to get path of styles directory
	 *
	 * @param $append
	 *
	 * @return string
	 */
	public static function get_path( $append ) {
		return self::$style_dir . $append;
	}


	/**
	 * Used to get path of styles URI
	 *
	 * @param $append
	 *
	 * @return string
	 */
	public static function get_uri( $append ) {
		return self::$style_uri . $append;
	}


	/**
	 * Convert string to class name
	 *
	 * @param string $name
	 *
	 * @return string
	 */
	public function convert_class_name( $name = '' ) {
		$class = str_replace(
			array( '/', '-', ' ' ),
			'_',
			$name
		);

		$class = explode( '_', $class );
		$class = array_map( 'ucwords', $class );

		return implode( '_', $class );
	}


	/**
	 * Creates class name from style and demo ID's
	 *
	 * @param string $style
	 * @param string $demo
	 *
	 * @return string
	 */
	public function get_class_name( $style = '', $demo = '' ) {

		$class = 'Publisher_Theme_Style_' . $this->convert_class_name( $style );

		if ( ! empty( $demo ) ) {
			$class .= '_' . $this->convert_class_name( $demo );
		}

		return $class;

	}


	/**
	 * Used to set styles from outside
	 *
	 * @param array $styles
	 */
	public static function set_styles( $styles ) {
		if ( is_array( $styles ) ) {
			self::$styles = $styles;
		} else {
			self::$styles = array( $styles );
		}
	}


	/**
	 * Used to get current active styles
	 *
	 * @return array
	 */
	public static function get_styles() {
		return self::$styles;
	}


	/**
	 * @param $instance
	 */
	public function add_style_instance( $instance ) {
		$this->style_instances[] = $instance;
	}


	/**
	 * Modify each style or demo options with overriding this function on child classes
	 */
	public function customize_panel_fields() {

		foreach ( $this->style_instances as $style ) {

			// customize panel fields
			$style->customize_panel_fields();

			// customize panel typo
			$style->customize_panel_typo();

		}

	}


	/**
	 * Callback: Init's BF options
	 *
	 * Filter: better-framework/panel/options
	 *
	 * @param $options
	 *
	 * @return mixed
	 */
	public function init_panel_options( $options ) {

		// Init base options
		Publisher_Theme_Panel_Fields::init_base_fields();

		// modify fields for styles and demos
		$this->customize_panel_fields();

		// Language  name for smart admin texts
		$lang = bf_get_current_lang();
		if ( $lang != 'none' ) {
			$lang = bf_get_language_name( $lang );
		} else {
			$lang = '';
		}

		$options[ publisher_get_theme_panel_id() ] = array(
			'panel-name'      => _x( 'Publisher Options', 'Panel title', 'publisher' ),
			'panel-desc'      => '<p>' . __( 'Configure theme settings, change colors, typography, layout and more...', 'publisher' ) . '</p>',
			'panel-desc-lang' => '<p>' . __( 'Theme %s Language Options.', 'publisher' ) . '</p>',
			'theme-panel'     => TRUE,
			'fields'          => Publisher_Theme_Panel_Fields::$fields,

			'texts' => array(

				'panel-desc-lang'     => '<p>' . __( '%s Language Options.', 'publisher' ) . '</p>',
				'panel-desc-lang-all' => '<p>' . __( 'All Languages Options.', 'publisher' ) . '</p>',

				'reset-button'     => ! empty( $lang ) ? sprintf( __( 'Reset %s Options', 'publisher' ), $lang ) : __( 'Reset Options', 'publisher' ),
				'reset-button-all' => __( 'Reset All Options', 'publisher' ),

				'reset-confirm'     => ! empty( $lang ) ? sprintf( __( 'Are you sure to reset %s options?', 'publisher' ), $lang ) : __( 'Are you sure to reset options?', 'publisher' ),
				'reset-confirm-all' => __( 'Are you sure to reset all options?', 'publisher' ),

				'save-button'     => ! empty( $lang ) ? sprintf( __( 'Save %s Options', 'publisher' ), $lang ) : __( 'Save Options', 'publisher' ),
				'save-button-all' => __( 'Save All Options', 'publisher' ),

				'save-confirm-all' => __( 'Are you sure to save all options? this will override specified options per languages', 'publisher' )

			),

			'config' => array(
				'name'                => __( 'Theme Options', 'publisher' ),
				'parent'              => 'bs-product-pages-welcome',
				'slug'                => 'better-studio/publisher',
				'notice-icon'         => PUBLISHER_THEME_URI . 'images/admin/notice-logo.png',
				'page_title'          => __( 'Theme Options', 'publisher' ),
				'menu_title'          => __( 'Theme Options', 'publisher' ),
				'capability'          => 'manage_options',
				'menu_slug'           => __( 'Publisher Theme Options', 'publisher' ),
				'icon_url'            => NULL,
				'position'            => '3.3',
				'exclude_from_export' => FALSE,
				'on_admin_bar'        => TRUE
			),
		);

		Publisher_Theme_Panel_Fields::$fields = ''; // clear memory

		return $options;

	} // init_panel_options


	/**
	 * Modify each style or demo options with overriding this function on child classes
	 */
	public function customize_category_fields() {

		foreach ( $this->style_instances as $style ) {
			$style->customize_category_fields();
		}

	}


	/**
	 * Callback: Init's BF category metabox
	 *
	 * Filter: better-framework/taxonomy/options
	 *
	 * @param $options
	 *
	 * @return mixed
	 */
	public function init_category_metabox( $options ) {

		// Init base options
		Publisher_Theme_Category_Fields::init_base_fields();

		// modify fields for styles and demos
		$this->customize_category_fields();

		//
		// Support to custom taxonomies
		//
		$cat_taxonomies = array( 'category' );
		if ( publisher_get_option( 'advanced_category_options_tax' ) != '' ) {
			$cat_taxonomies = array_merge( explode( ',', publisher_get_option( 'advanced_category_options_tax' ) ), $cat_taxonomies );
		}


		$options['better-category-options'] = array(
			'config'   => array(
				'taxonomies' => $cat_taxonomies,
				'name'       => __( 'Better Category Options', 'publisher' )
			),
			'panel-id' => publisher_get_theme_panel_id(),

			'fields' => Publisher_Theme_Category_Fields::$fields
		);

		Publisher_Theme_Category_Fields::$fields = ''; // clear memory

		return $options;

	} // init_category_metabox

} // Publisher_Theme_Styles_Manager