<?php

/**
 * Class BS_Theme_Pages_Base
 */
abstract class BF_Product_Pages_Base {

	public static $config = array();

	public function __construct() {

		self::init_config();
	}

	public function error( $error_message ) {

		//todo: print error message

		printf( '<div class="update-nag">%s</div>', $error_message );
	}


	public static function init_config() {

		if ( ! self::$config ) {

			self::$config         = apply_filters( 'better-framework/product-pages/config', array() );
			self::$config['URI']  = BF_PRODUCT_PAGES_URI;
			self::$config['path'] = BF_PRODUCT_PAGES_PATH;
		}

	}

	public static function get_config() {

		self::init_config();

		return self::$config;
	}

	public static function get_product_info( $index, $default = FALSE ) {

		if ( isset( self::$config[ $index ] ) ) {
			return self::$config[ $index ];
		}

		return $default;
	}

	/**
	 * handle api request
	 *
	 * @see \BetterFramework_Oculus::request
	 *
	 * @param string $action
	 * @param array  $data
	 * @param array  $auth
	 * @param bool   $use_wp_error
	 *
	 * @return array|bool|object|WP_Error
	 */
	protected function api_request( $action, $data = array(), $auth = array(), $use_wp_error = FALSE ) {

		if ( ! class_exists( 'BetterFramework_Oculus' ) ) {
			return FALSE;
		}

		return BetterFramework_Oculus::request( $action, $auth, $data, $use_wp_error );
	} //api_request
}
