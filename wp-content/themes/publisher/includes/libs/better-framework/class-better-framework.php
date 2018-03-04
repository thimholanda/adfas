<?php


// Load general handy functions
require BF_PATH . 'functions/path.php';
bf_require( 'functions/query.php' );
bf_require( 'functions/content.php' );
bf_require( 'functions/other.php' );
bf_require( 'functions/enqueue.php' );
bf_require( 'functions/shortcodes.php' );
bf_require( 'functions/archive.php' );
bf_require( 'functions/sidebar.php' );
bf_require( 'functions/menu.php' );
bf_require( 'functions/options.php' );
bf_require( 'functions/multilingual.php' );


/**
 * Handy Function for accessing to BetterFramework
 *
 * @return Better_Framework
 */
function Better_Framework() {
	return Better_Framework::self();
}

// Fire Up BetterFramework
Better_Framework();

/**
 * Class Better_Framework
 */
class Better_Framework {


	/**
	 * Version of BF
	 *
	 * @var string
	 */
	public $version = '2.6.4';


	/**
	 * Defines which sections should be include in BF
	 *
	 * @since  1.0
	 * @access public
	 * @var array
	 */
	public $sections = array(
		'admin_panel'       => TRUE,    // For initializing BF theme option panel generator
		'admin-page'        => TRUE,    // For initializing BF theme option panel generator
		'admin-menus'       => TRUE,    // For initializing BF theme option panel generator
		'meta_box'          => TRUE,    // For initializing BF meta box generator
		'user-meta-box'     => TRUE,    // For initializing BF user meta box generator
		'taxonomy_meta_box' => FALSE,   // For initializing BF taxonomy meta box generator
		'load_in_frontend'  => FALSE,   // For loading all BF in frontend, disable this for better performance
		'better-menu'       => FALSE,   // Includes better menu
		'custom-css-fe'     => TRUE,    // For initializing BF Front End Custom CSS Generator
		'custom-css-be'     => TRUE,    // For initializing BF Back End ( WP Admin ) Custom CSS Generator
		'custom-css-pages'  => FALSE,   // For initializing BF Pages Custom CSS
		'custom-css-users'  => TRUE,    // For initializing BF Users Custom CSS
		'assets_manager'    => TRUE,    // For initializing BF custom css generator
		'vc-extender'       => FALSE,   // For initializing VC functionality extender
		'woocommerce'       => FALSE,   // For initializing WooCommerce functionality
		'bbpress'           => FALSE,   // For initializing bbPress functionality
		'product-pages'     => FALSE,   // For initializing Products Page
		'product-updater'   => FALSE,   // For initializing Products Updater
	);


	/**
	 * Inner array of instances
	 *
	 * @var array
	 */
	protected static $instances = array();


	/**
	 * PHP Constructor Function
	 *
	 * @param array $sections default features
	 *
	 * @since  1.0
	 * @access public
	 */
	public function __construct( $sections = array() ) {

		// define features of BF
		$this->sections = wp_parse_args( $sections, $this->sections );
		$this->sections = apply_filters( 'better-framework/sections', $this->sections );

		/**
		 * BF General Functionality For Both Front End and Back End
		 */
		self::factory( 'general' );

		self::factory( 'assets-manager' );

		/**
		 * BF BetterMenu For Improving WP Menu Features
		 */
		if ( $this->sections['better-menu'] == TRUE ) {
			self::factory( 'better-menu' );
		}


		/**
		 * BF Widgets Manager
		 */
		self::factory( 'widgets-manager' );


		/**
		 * BF Shortcodes Manager
		 */
		if ( $this->sections['vc-extender'] == TRUE ) {
			bf_require_once( 'vc-extend/class-bf-vc-shortcode-extender.php' );
		}
		self::factory( 'shortcodes-manager' );


		/**
		 * BF Custom Generator For Front End
		 */
		if ( $this->sections['custom-css-fe'] ) {
			self::factory( 'custom-css-fe' );
		}

		/**
		 * BF Pages and Posts Front End Custom Generator
		 */
		if ( $this->sections['custom-css-pages'] ) {
			self::factory( 'custom-css-pages' );
		}

		/**
		 * BF Users Front End Custom Generator
		 */
		if ( $this->sections['custom-css-users'] ) {
			self::factory( 'custom-css-users' );
		}


		/**
		 * BF Custom Generator For Back End
		 */
		if ( $this->sections['custom-css-be'] ) {
			self::factory( 'custom-css-be' );
		}


		/**
		 * BF WooCommerce
		 */
		if ( $this->sections['woocommerce'] == TRUE && function_exists( 'is_woocommerce' ) ) {
			self::factory( 'woocommerce' );
		}


		/**
		 * BF bbPress
		 */
		if ( $this->sections['bbpress'] == TRUE && class_exists( 'bbpress' ) ) {
			self::factory( 'bbpress' );
		}


		/**
		 * BF Admin Page
		 */
		if ( $this->sections['admin-page'] == TRUE ) {
			self::factory( 'admin-page', FALSE, TRUE );
		}


		/**
		 * BF Admin Menus
		 */
		if ( $this->sections['admin-menus'] == TRUE ) {
			self::factory( 'admin-menus' );
		}


		/**
		 * BF Admin Panel Generator
		 */
		if ( $this->sections['admin_panel'] == TRUE ) {
			self::factory( 'admin-panel' );
		}


		/**
		 * Products Page
		 */
		if ( $this->sections['product-pages'] == TRUE ) {
			self::factory( 'product-pages' );
		}


		/**
		 * Products Updater
		 */
		if ( $this->sections['product-updater'] == TRUE ) {
			self::factory( 'product-updater' );
		}


		/**
		 * Disable Loading BF Fully in Front End
		 */
		if ( ! is_admin() && $this->sections['load_in_frontend'] == FALSE ) {
			return;
		}


		/**
		 * BF Core Functionality That Used in Back End
		 */
		self::factory( 'admin-notice' );
		self::factory( 'core', FALSE, TRUE );
		self::factory( 'color' );
		self::factory( 'icon-factory' );


		/**
		 * BF Taxonomy Meta Box Generator
		 */
		if ( $this->sections['taxonomy_meta_box'] == TRUE ) {
			self::factory( 'taxonomy-meta' );
		}


		/**
		 * BF Post & Page Meta Box Generator
		 */
		if ( $this->sections['meta_box'] == TRUE ) {
			self::factory( 'meta-box' );
		}


		/**
		 * BF Post & Page Meta Box Generator
		 */
		if ( $this->sections['user-meta-box'] == TRUE ) {
			self::factory( 'user-meta-box' );
		}


		/**
		 * BF Visual Composer Extender
		 */
		if ( $this->sections['vc-extender'] == TRUE ) {
			self::factory( 'vc-extender' );
		}


		// Admin style and scripts
		if ( is_admin() ) {
			// Hook BF admin assets enqueue
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

			// Hook BF admin ajax requests
			add_action( 'wp_ajax_bf_ajax', array( $this, 'admin_ajax' ) );
			add_action( 'better-framework/panel/image-upload', array( $this, 'handle_file_upload' ) );
		}

	}


	/**
	 * Build the required object instance
	 *
	 * @param string $object
	 * @param bool   $fresh
	 * @param bool   $just_include
	 *
	 * @return null
	 */
	public static function factory( $object = 'options', $fresh = FALSE, $just_include = FALSE ) {

		if ( isset( self::$instances[ $object ] ) && ! $fresh ) {
			return self::$instances[ $object ];
		}

		switch ( $object ) {

			/**
			 * Main BetterFramework Class
			 */
			case 'self':
				$class = 'Better_Framework';
				break;

			/**
			 * General Helper Functions
			 */
			case 'helper':
				bf_require_once( 'core/class-bf-helper.php' );

				$class = 'BF_Helper';
				break;

			/**
			 * Query Helper Functions
			 */
			case 'query-helper':
				bf_require_once( 'core/class-bf-query.php' );

				$class = 'BF_Query';
				break;

			/**
			 * Custom Fonts Manager
			 */
			case 'fonts-manager':
				bf_require_once( 'core/fonts-manager/class-bf-fonts-manager.php' );

				$class = 'BF_Fonts_Manager';
				break;

			/**
			 * BF General Functionality For Both Front End and Back End
			 */
			case 'general':
				self::factory( 'helper' );

				// todo: this file was deprecated and should be removed in v3
				bf_require_once( 'core/class-bf-query.php' );

				bf_require_once( 'metabox/functions.php' );      // Post meta box public functions
				bf_require_once( 'taxonomy/functions.php' );     // Taxonomy public functions
				bf_require_once( 'user-metabox/functions.php' ); // Taxonomy public functions
				bf_require_once( 'admin-panel/functions.php' );  // Admin Panel public functions
				self::factory( 'fonts-manager' );
				self::factory( 'options' );

				// todo: this file was deprecated and should delete in v3
				bf_require_once( 'core/class-bf-posts.php' );

				return TRUE;
				break;

			/**
			 * BF_Options Used For Retrieving Theme Panel Options
			 */
			case 'options':
				bf_require_once( 'admin-panel/class-bf-options.php' );

				$class = 'BF_Options';
				break;

			/**
			 * BF BetterMenu For Improving WP Menu Features
			 */
			case 'better-menu':
				bf_require_once( 'menu/class-bf-menus.php' );

				$class = 'BF_Menus';
				break;

			/**
			 * BF Visual Composer Extender
			 */
			case 'vc-extender':
				bf_require_once( 'vc-extend/class-bf-vc-extender.php' );

				$class = 'BF_VC_Extender';
				break;

			/**
			 * BF Post & Page Meta Box Generator
			 */
			case 'meta-box':
				bf_require_once( 'metabox/class-bf-metabox-core.php' );

				$class = 'BF_Metabox_Core';
				break;

			/**
			 * BF Users Meta Box Generator
			 */
			case 'user-meta-box':
				bf_require_once( 'user-metabox/class-bf-user-metabox-core.php' );

				$class = 'BF_User_Metabox_Core';
				break;

			/**
			 * BF Taxonomy Meta Box Generator
			 */
			case 'taxonomy-meta':
				bf_require_once( 'core/field-generator/class-bf-admin-fields.php' );
				bf_require_once( 'taxonomy/class-bf-taxonomy-front-end-generator.php' );
				bf_require_once( 'taxonomy/class-bf-taxonomy-meta-field.php' );
				bf_require_once( 'taxonomy/class-bf-taxonomy-core.php' );

				$class = 'BF_Taxonomy_Core';
				break;

			/**
			 * BF Admin Panel Generator
			 */
			case 'admin-panel':
				self::factory( 'admin-menus' );
				bf_require_once( 'admin-panel/class-bf-admin-panel.php' );

				$class = 'BF_Admin_Panel';
				break;

			/**
			 * BF Admin Page
			 */
			case 'admin-page':
				self::factory( 'admin-menus' );
				bf_require_once( 'admin-page/class-bf-admin-page.php' );

				$class = 'BF_Admin_Page';
				break;


			/**
			 * BF Admin Menus
			 */
			case 'admin-menus':
				bf_require_once( 'admin-menus/class-bf-admin-menus.php' );

				$class = 'BF_Admin_Menus';
				break;


			/**
			 * BF Shortcodes Manager
			 */
			case 'shortcodes-manager':
				bf_require_once( 'shortcode/class-bf-shortcodes-manager.php' );

				$class = 'BF_Shortcodes_Manager';
				break;

			/**
			 * BF Widgets
			 */
			case 'widgets-manager':

				bf_require_once( 'widget/class-bf-widget.php' );
				bf_require_once( 'widget/class-bf-widgets-manager.php' );

				$class = 'BF_Widgets_Manager';
				break;


			/**
			 * BF Widgets Field Generator
			 */
			case 'widgets-field-generator':
				bf_require_once( 'core/field-generator/class-bf-admin-fields.php' );
				bf_require_once( 'widget/class-bf-widgets-field-generator.php' );

				return TRUE;
				break;

			/**
			 * BF Core Functionality That Used in Back End
			 */
			case 'admin-notice':
				bf_require_once( 'core/class-bf-admin-notices.php' );

				$class = 'BF_Admin_Notices';
				break;

			/**
			 * BF Core Functionality That Used in Back End
			 */
			case 'core':
				bf_require_once( 'core/walkers/class-walker-better-categorydropdown.php' );
				bf_require_once( 'core/field-generator/class-bf-ajax-select-callbacks.php' );
				bf_require_once( 'core/field-generator/class-bf-admin-fields.php' );
				bf_require_once( 'core/class-bf-html-generator.php' );

				return TRUE;
				break;

			/**
			 * BF Custom Generator For Front End
			 */
			case 'custom-css':
				bf_require_once( 'core/custom-css/class-bf-custom-css.php' );

				return TRUE;
				break;


			/**
			 * BF Custom Generator For Front End
			 */
			case 'custom-css-fe':
				self::factory( 'custom-css' );
				bf_require_once( 'core/custom-css/class-bf-front-end-css.php' );

				$class = 'BF_Front_End_CSS';
				break;

			/**
			 * BF Custom Generator For Back End
			 */
			case 'custom-css-be':
				self::factory( 'custom-css' );
				bf_require_once( 'core/custom-css/class-bf-back-end-css.php' );

				$class = 'BF_Back_End_CSS';
				break;

			/**
			 * BF Custom Generator Pages and Posts in Front end
			 */
			case 'custom-css-pages':
				self::factory( 'custom-css' );
				bf_require_once( 'core/custom-css/class-bf-pages-css.php' );

				$class = 'BF_Pages_CSS';
				break;

			/**
			 * BF Custom Generator Pages and Posts in Front end
			 */
			case 'custom-css-users':
				self::factory( 'custom-css' );
				bf_require_once( 'core/custom-css/class-bf-users-css.php' );

				$class = 'BF_Users_CSS';
				break;


			/**
			 * BF Color Used For Retrieving User Color Schema and Some Helper Functions For Changing Colors
			 */
			case 'color':
				bf_require_once( 'libs/class-bf-color.php' );

				$class = 'BF_Color';
				break;

			/**
			 * BF Color Used For Retrieving User Color Schema and Some Helper Functions For Changing Colors
			 */
			case 'breadcrumb':
				bf_require_once( 'libs/class-bf-breadcrumb.php' );

				$class = 'BF_Breadcrumb';
				break;

			/**
			 * BF Icon Factory Used For Handling FontIcons Actions
			 */
			case 'icon-factory':
				bf_require_once( 'libs/icons/class-bf-icons-factory.php' );

				$class = 'BF_Icons_Factory';
				break;

			/**
			 * BF WooCommerce
			 */
			case 'woocommerce':
				bf_require_once( 'woocommerce/abstract-class-bf-woocommerce.php' );

				return TRUE;

			/**
			 * BF bbPress
			 */
			case 'bbpress':
				bf_require_once( 'bbpress/abstract-class-bf-bbpress.php' );

				return TRUE;

			/**
			 * Assets Manager
			 */
			case 'assets-manager':
				bf_require_once( 'core/class-bf-assets-manager.php' );

				$class = 'BF_Assets_Manager';
				break;

			/**
			 * Products Manager
			 */
			case 'product-pages':
				bf_require_once( 'product-pages/init.php' );

				return TRUE;

				break;

			/**
			 * Products Updater
			 */
			case 'product-updater':
				bf_require_once( 'product-updater/init.php' );

				return TRUE;

				break;

			default:
				return NULL;
		}


		// Just prepare/includes files
		if ( $just_include ) {
			return;
		}

		// don't cache fresh objects
		if ( $fresh ) {
			return new $class;
		}

		self::$instances[ $object ] = new $class;

		return self::$instances[ $object ];
	}


	/**
	 * Used for accessing alive instance of Better_Framework
	 *
	 * static
	 * @since 1.0
	 * @return Better_Framework
	 */
	public static function self() {

		return self::factory( 'self' );

	}


	/**
	 * Used for getting options from BF_Options
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Options
	 */
	public static function options( $fresh = FALSE ) {
		return self::factory( 'options', $fresh );
	}


	/**
	 * Used for accessing shortcodes from BF_Shortcodes_Manager
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Shortcodes_Manager
	 */
	public static function shortcodes( $fresh = FALSE ) {
		return self::factory( 'shortcodes-manager', $fresh );
	}


	/**
	 * Used for accessing taxonomy meta from BF_Taxonomy_Core
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Taxonomy_Core
	 */
	public static function taxonomy_meta( $fresh = FALSE ) {
		return self::factory( 'taxonomy-meta', $fresh );
	}


	/**
	 * Used for accessing post meta from BF_Metabox_Core
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Metabox_Core
	 */
	public static function post_meta( $fresh = FALSE ) {
		return self::factory( 'meta-box', $fresh );
	}


	/**
	 * Used for accessing widget manager from BF_Widgets_Manager
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Widgets_Manager
	 */
	public static function widget_manager( $fresh = FALSE ) {
		return self::factory( 'widgets-manager', $fresh );
	}


	/**
	 * Used for accessing widget manager from BF_Widgets_Manager
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Breadcrumb
	 */
	public static function breadcrumb( $fresh = FALSE ) {
		return self::factory( 'breadcrumb', $fresh );
	}


	/**
	 * Used for accessing BF_Admin_Notices for adding notice to admin panel
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Admin_Notices
	 */
	public static function admin_notices( $fresh = FALSE ) {
		return self::factory( 'admin-notice', $fresh );
	}


	/**
	 * Used for accessing BF_Assets_Manager for enqueue styles and scripts
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Assets_Manager
	 */
	public static function assets_manager( $fresh = FALSE ) {
		return self::factory( 'assets-manager', $fresh );
	}


	/**
	 * Used for accessing BF_Helper
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Helper
	 */
	public static function helper( $fresh = FALSE ) {
		return self::factory( 'helper', $fresh );
	}


	/**
	 * Used for accessing BF_Query
	 *
	 * Deprecated!
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Query
	 */
	public static function helper_query( $fresh = FALSE ) {
		return self::factory( 'query-helper', $fresh );
	}


	/**
	 * Used for accessing BF_Icons_Factory
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Icons_Factory
	 */
	public static function icon_factory( $fresh = FALSE ) {
		return self::factory( 'icon-factory', $fresh );
	}


	/**
	 * Used for accessing BF_Fonts_Manager
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Fonts_Manager
	 */
	public static function fonts_manager( $fresh = FALSE ) {
		return self::factory( 'fonts-manager', $fresh );
	}


	/**
	 * Used for accessing BF_User_Metabox_Core
	 *
	 * @param bool $fresh
	 *
	 * @return BF_User_Metabox_Core
	 */
	public static function user_meta( $fresh = FALSE ) {
		return self::factory( 'user-meta-box', $fresh );
	}


	/**
	 * Used for accessing Better_Admin_Panel
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Admin_Panel
	 */
	public static function admin_panel( $fresh = FALSE ) {
		return self::factory( 'admin-panel' );
	}


	/**
	 * Used for accessing Better_Admin_Page
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Admin_Page
	 */
	public static function admin_page( $fresh = FALSE ) {
		return self::factory( 'admin-page' );
	}


	/**
	 * Used for accessing BF_Admin_Menus
	 *
	 * @param bool $fresh
	 *
	 * @return BF_Admin_Menus
	 */
	public static function admin_menus( $fresh = FALSE ) {
		return self::factory( 'admin-menus' );
	}


	/**
	 * Gets a WP_Theme object for a theme.
	 *
	 * @param bool $parent
	 * @param bool $fresh
	 * @param bool $cache_this
	 *
	 * @return  WP_Theme
	 */
	public static function theme( $parent = TRUE, $fresh = FALSE, $cache_this = TRUE ) {

		if ( isset( self::$instances['theme'] ) && ! $fresh ) {
			return self::$instances['theme'];
		}

		$theme = wp_get_theme();

		if ( $parent && ( '' != $theme->get( 'Template' ) ) ) {
			$theme = wp_get_theme( $theme->get( 'Template' ) );
		}

		if ( $cache_this == TRUE ) {
			return self::$instances['theme'] = $theme;
		} else {
			return $theme;
		}

	}


	/**
	 * Reference To HTML Generator Class
	 *
	 * static
	 * @since 1.0
	 * @return BF_HTML_Generator
	 */
	public static function html() {
		return new BF_HTML_Generator;
	}


	/**
	 * Callback: Handle BF Admin Enqueue's
	 *
	 * Action: admin_enqueue_scripts
	 *
	 * @since   1.0
	 *
	 * @return  object
	 */
	public function admin_enqueue_scripts() {

		/*
		 * enqueue admin-scripts in all pages
		 *
		// enqueue scripts if features enabled
		if( $this->sections['admin_panel'] == true  ||
			$this->sections['meta_box'] == true     ||
			$this->sections['better-menu'] == true  ||
			$this->sections['taxonomy_meta_box'] == true
		){
			if( $this->get_current_page_type() != '' ){*/

		// Wordpress 3.5
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		// BetterFramework Admin scripts
		bf_enqueue_script( 'better-framework-admin' );

		if ( ( $type = $this->get_current_page_type() ) == '' ) {
			$type = '0';
		}

		$better_framework_loc = array(
			'bf_ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'       => wp_create_nonce( 'bf_nonce' ),
			'type'        => $type,
			'lang'        => bf_get_current_lang(),

			// Localized Texts
			'translation' => array(
				'reset_panel'  => array(
					'header'     => __( 'Reset options', 'publisher' ),
					'title'      => __( 'Are you sure to reset options?', 'publisher' ),
					'body'       => __( 'With resetting panel all your changes will be lost and will be replaced with default settings.', 'publisher' ),
					'button_yes' => __( 'Yes, Reset options', 'publisher' ),
					'button_no'  => __( 'No', 'publisher' ),
					'resetting'  => __( 'Resetting options', 'publisher' ),
				),
				'import_panel' => array(
					'prompt' => __( 'Do you really wish to override your current settings?', 'publisher' ),
				),
				'icon_modal'   => array(
					'custom_icon' => __( 'Custom icon', 'publisher' ),
				)
			)
		);

		wp_localize_script( 'bf-better-framework-admin', 'better_framework_loc', apply_filters( 'better-framework/localized-items', $better_framework_loc ) );

		// BetterFramework admin style
		bf_enqueue_style( 'better-framework-admin' );

		if ( $this->get_current_page_type() == 'metabox' ) {
			bf_enqueue_modal( 'icon' ); // safe enqueue for fixing visual composer bug
		}

		bf_enqueue_style( 'better-studio-admin-icon' );
	}


	/**
	 * Used for finding current page type
	 *
	 * @return string
	 */
	public function get_current_page_type() {

		global $pagenow;

		$type = '';

		switch ( $pagenow ) {

			case 'post-new.php':
			case 'post.php':
				$type = 'metabox';
				break;

			case 'term.php':
			case 'edit-tags.php':
				$type = 'taxonomy';
				break;

			case 'widgets.php':
				$type = 'widgets';
				break;

			case 'nav-menus.php':
				$type = 'menus';
				break;

			case 'profile.php':
			case 'user-new.php':
			case 'user-edit.php':
				$type = 'users';
				break;

			case 'index.php':
				$type = 'dashboard';
				break;

			default:
				if ( isset( $_GET['page'] ) && ( preg_match( '/^better-studio-/', $_GET['page'] ) || preg_match( '/^better-studio\//', $_GET['page'] ) ) ) {
					$type = 'panel';
				}

		}

		return $type;
	}


	/**
	 * Handle Ajax File Uploads
	 *
	 * @param string $data The variable that includes all options in array
	 *
	 * @since 1.0
	 * @return void
	 */
	public function handle_file_upload( $data ) {

		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		$movefile = wp_handle_upload(
			$data,
			array(
				'test_form' => FALSE
			)
		);

		if ( array_key_exists( 'error', $movefile ) ) {
			$upResults = array(
				'status' => 'error',
				'msg'    => $movefile['error']
			);
		} else {
			$upResults = array(
				'status' => 'succeed',
				'url'    => $movefile['url'],
				'path'   => $movefile['file']
			);
		}

		echo json_encode( $upResults );
		die;

	}

	public static function callback_token( $callback ) {

		return wp_create_nonce( sprintf( 'bf-custom-callback:%s', $callback ) );
	}

	/**
	 * Handle All Ajax Requests in Back-End
	 *
	 * @since 1.0
	 * @return mixed
	 */
	public function admin_ajax() {

		// Check Nonce
		if ( ! isset( $_REQUEST['nonce'] ) || ! isset( $_REQUEST['reqID'] ) ) {
			die(
			json_encode(
				array(
					'status' => 'error',
					'msg'    => __( 'Security Error!', 'publisher' )
				)
			)
			);
		}

		$_nonce = wp_verify_nonce( $_REQUEST['nonce'], 'bf_nonce' );

		// Check Nonce
		if ( $_nonce === FALSE ) {
			die(
			json_encode(
				array(
					'status' => 'error',
					'msg'    => __( 'Security Error!', 'publisher' )
				)
			)
			);
		}

		switch ( $_REQUEST['reqID'] ) {

			// Option Panel, Save Settings
			case( 'save_admin_panel_options' ):

				wp_parse_str( ltrim( rtrim( stripslashes( $_REQUEST['data'] ), '&' ), '&' ), $options );

				$data = array(
					'id'   => $_REQUEST['panelID'],
					'lang' => $_REQUEST['lang'],
					'data' => $options
				);

				do_action( 'better-framework/panel/save', $data );
				break;

			// Ajax Image Uploader
			case( 'image_upload' ):
				$data = $_FILES[ $_REQUEST['file_id'] ];
				do_action( 'better-framework/panel/image-upload', $data, $_REQUEST['file_id'] );
				break;

			// Add Custom Icon
			case( 'add_custom_icon' ):
				do_action( 'better-framework/icons/add-custom-icon', $_REQUEST['icon'] );
				break;

			// Remove Custom Icon
			case( 'remove_custom_icon' ):
				do_action( 'better-framework/icons/remove-custom-icon', $_REQUEST['icon'] );
				break;

			// Option Panel, Reset Settings
			case( 'reset_options_panel' ):

				/**
				 * Fires for handling panel reset
				 *
				 * @since 1.0.0
				 *
				 * @param string $args reset panel data
				 */
				do_action( 'better-framework/panel/reset', array(
					'id'      => $_REQUEST['panelID'],
					'lang'    => $_REQUEST['lang'],
					'options' => $_REQUEST['to_reset']
				) );
				break;

			// Option Panel, Ajax Action
			case( 'ajax_action' ):

				$callback = isset( $_REQUEST['callback'] ) ? $_REQUEST['callback'] : '';

				$args = isset( $_REQUEST['args'] ) ? $_REQUEST['args'] : '';

				$error_message = isset( $_REQUEST['error-message'] ) ? $_REQUEST['error-message'] : __( 'An error occurred while doing action.', 'publisher' );

				//Security issue fix
				if ( empty( $_REQUEST['bf_call_token'] ) || self::callback_token( $callback ) !== $_REQUEST['bf_call_token'] ) {

					echo json_encode(
						array(
							'status' => 'error',
							'msg'    => __( 'the security token is not valid!', 'publisher' )
						)
					);

					return;
				}
				if ( ! empty( $callback ) && is_callable( $callback ) ) {

					if ( $args ) {

						$to_return = call_user_func_array( $callback, $args );

					} else {

						$to_return = call_user_func( $callback );

					}

					if ( is_array( $to_return ) ) {
						echo json_encode( $to_return );
					} else {
						echo json_encode(
							array(
								'status' => 'error',
								'msg'    => $error_message
							)
						);
					}

				} else {
					echo json_encode(
						array(
							'status' => 'error',
							'msg'    => $error_message
						)
					);
				}
				break;

			// Option Panel, Ajax Field
			case( 'ajax_field' ):

				if ( isset( $_REQUEST['callback'] ) &&
				     is_callable( $_REQUEST['callback'] ) &&
				     is_array(
					     $to_return = call_user_func_array( $_REQUEST['callback'], array(
						     $_REQUEST['key'],
						     $_REQUEST['exclude']
					     ) )
				     )
				) {
					echo count( $to_return ) === 0 ? - 1 : json_encode( $to_return );
				}

				break;

			// Option Panel, Import Settings
			case( 'import' ):

				$data = $_FILES['bf-import-file-input'];

				/**
				 * Fires for handling panel import
				 *
				 * @since 1.1.0
				 *
				 * @param string $data contain import file data
				 * @param string $args contain import arguments
				 */
				do_action( 'better-framework/panel/import', $data, $_REQUEST );

				break;

		}
		die;
	}

}