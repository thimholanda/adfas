<?php

/**
 * Handy Function for accessing to Publisher_Theme_Core
 *
 * @return Publisher_Theme_Core
 */
function Publisher_Theme_Core() {
	return Publisher_Theme_Core::self();
}


// Init
Publisher_Theme_Core()->init();


/**
 * Publisher Theme Core
 *
 * Core functionality of themes.
 *
 * @package  Publisher Theme Core
 * @author   BetterStudio <info@betterstudio.com>
 * @version  1.0.0
 * @access   public
 * @see      http://www.betterstudio.com
 */
class Publisher_Theme_Core {


	/**
	 * The version
	 *
	 * @var string
	 */
	private $version = '1.0.0';


	/**
	 * Directory URL
	 *
	 * @var string
	 */
	private $dir_url;


	/**
	 * Directory path
	 *
	 * @var string
	 */
	private $dir_path;


	/**
	 * Includes the config of Publisher Theme Core
	 *
	 * @var array
	 */
	public static $config = array(
		'sections' => array(
			'attr'                   => TRUE,
			'meta-tags'              => TRUE,
			'theme-helper'           => TRUE,
			'listing-pagin'          => TRUE,
			'translation'            => FALSE,
			'vc-helpers'             => FALSE,
			'social-meta-tags'       => FALSE,
			'chat-format'            => FALSE,
			'duplicate-posts'        => FALSE,
			'gallery-sliders'        => FALSE,
			'version-compatibility'  => FALSE,
			'shortcodes-placeholder' => FALSE,
			'editor-shortcodes'      => FALSE,
			'rebuild-thumbnails'     => FALSE,
		)
	);


	/**
	 * Inner array of object instances and caches
	 *
	 * @var array
	 */
	protected static $instances = array();


	/**
	 * Initializes the core
	 *
	 * @return bool
	 */
	function init() {

		/**
		 * Filter Publisher Theme Core config
		 *
		 * todo following field should passed to this filter and all sub sections should use only from this
		 * - theme name
		 * - theme slug
		 * - theme ID
		 * - notice icon
		 *
		 * @since 1.0.0
		 *
		 * @param string $config configurations
		 */
		self::$config = apply_filters( 'publisher-theme-core/config', self::$config );

		if (
			empty( self::$config['theme-slug'] ) ||
			empty( self::$config['theme-name'] ) ||
			empty( self::$config['dir-url'] ) ||
			empty( self::$config['dir-path'] )
		) {
			return FALSE;
		}


		$this->dir_url = trailingslashit( self::$config['dir-url'] );

		$this->dir_path = trailingslashit( self::$config['dir-path'] );


		if ( ! defined( 'PUBLISHER_THEME_ADMIN_ASSETS_URI' ) ) {
			define( 'PUBLISHER_THEME_ADMIN_ASSETS_URI', $this->dir_url . 'includes/admin-assets/' );
		}

		if ( ! defined( 'PUBLISHER_THEME_PATH' ) ) {
			define( 'PUBLISHER_THEME_PATH', $this->dir_path );
		}

		if ( ! defined( 'PUBLISHER_THEME_URI' ) ) {
			define( 'PUBLISHER_THEME_URI', $this->dir_url );
		}

		if ( ! defined( 'PUBLISHER_SLUG' ) ) {
			define( 'PUBLISHER_SLUG', self::$config['theme-slug'] );
		}

		if ( ! defined( 'PUBLISHER_NAME' ) ) {
			define( 'PUBLISHER_NAME', self::$config['theme-name'] );
		}


		// Initialize requested libs
		if ( isset( self::$config['sections'] ) ) {
			foreach ( (array) self::$config['sections'] as $section_id => $section ) {
				if ( $section ) {
					$this->init_section( $section_id );
				}
			}
		}

	}


	/**
	 * Used for accessing alive instance of Publisher_Theme_Core
	 *
	 * @since 1.0
	 *
	 * @return Publisher_Theme_Core
	 */
	public static function self() {
		return self::factory( 'self' );
	}


	/**
	 * Build the required object instance
	 *
	 * @param   string $object
	 * @param   bool   $fresh
	 * @param   bool   $just_include
	 *
	 * @return  null|Publisher_Theme_Core
	 */
	public static function factory( $object = 'self', $fresh = FALSE, $just_include = FALSE ) {

		if ( isset( self::$instances[ $object ] ) && ! $fresh ) {
			return self::$instances[ $object ];
		}

		switch ( $object ) {

			/**
			 * Main Publisher_Theme_Core Class
			 */
			case 'self':
				$class = 'Publisher_Theme_Core';
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
	 * Used for retrieving version
	 *
	 * @return string
	 */
	function get_version() {
		return $this->version;
	}


	/**
	 * Used for retrieving directory URL
	 *
	 * @param string $append
	 *
	 * @return string
	 */
	function get_dir_url( $append = '' ) {
		return $this->dir_url . ltrim( $append, '/' );
	}


	/**
	 * Used for retrieving directory path
	 *
	 * @param string $append
	 *
	 * @return string
	 */
	function get_dir_path( $append = '' ) {
		return $this->dir_path . ltrim( $append, '/' );
	}


	/**
	 * Core sections safe initializer.
	 *
	 * @param $section_id
	 */
	private function init_section( $section_id ) {

		// current directory path
		$dir = self::get_dir_path();

		switch ( $section_id ) {

			/**
			 * Attributes & Schema.org Helpers.
			 */
			case 'attr':

				// Core functions
				include $dir . 'attr/core.php';

				// Structural tags functions and filters
				include $dir . 'attr/structural.php';

				// Header tags functions and filters
				include $dir . 'attr/header.php';

				// Post tags functions and filters
				include $dir . 'attr/post.php';

				// Comment tags functions and filters
				include $dir . 'attr/comment.php';
				break;

			/**
			 * Meta tags
			 */
			case 'meta-tags':
				include $dir . 'meta-tags/core.php';
				include $dir . 'meta-tags/tags.php';
				break;

			/**
			 * Social Networks Meta Tag Generator
			 */
			case 'social-meta-tags':
				include $dir . 'social-meta-tags/class-publisher-theme-social-meta-tag-generator.php';
				break;

			/**
			 * Chat post format content formatter
			 */
			case 'chat-format':
				include $dir . 'chat-format/chat-format.php';
				break;

			/**
			 * Duplicate posts remover
			 */
			case 'duplicate-posts':
				include $dir . 'duplicate-posts/class-publisher-theme-duplicate-posts.php';
				break;

			/**
			 * Gallery sldier
			 */
			case 'gallery-slider':
				include $dir . 'gallery-slider/class-publisher-theme-gallery-slider.php';
				break;


			/**
			 * Shortcodes placeholder
			 */
			case 'shortcodes-placeholder':
				include $dir . 'shortcodes-placeholder/class-publisher-theme-shortcodes-placeholder.php';
				break;


			/**
			 * Template helpers
			 */
			case 'theme-helpers':
				include $dir . 'theme-helpers/core.php';
				include $dir . 'theme-helpers/template-helpers.php';
				include $dir . 'theme-helpers/template-content.php';
				include $dir . 'theme-helpers/template-comment.php';
				break;


			/**
			 * Visual Composer Helpers
			 */
			case 'vc-helpers':
				include $dir . 'vc-helpers/vc-helpers.php';
				break;


			/**
			 * Versions compatibility manager
			 */
			case 'version-compatibility':
				include $dir . 'version-compatibility/class-publisher-theme-version-compatibility.php';
				break;


			/**
			 * Listings pagination manager
			 */
			case 'listing-pagin':
				include $dir . 'listing-pagin/init.php';
				break;

			/**
			 * Theme translation panel
			 */
			case 'translation':
				include $dir . 'translation/class-publisher-translation.php';
				break;

			/**
			 * Editor shortcodes
			 */
			case 'editor-shortcodes':
				include $dir . 'editor-shortcodes/init.php';
				break;

			/**
			 * Thumbnails rebuilder
			 */
			case 'rebuild-thumbnails':
				include $dir . 'rebuild-thumbnails/init.php';
				break;

		}
	}
} // Publisher_Theme_Core
