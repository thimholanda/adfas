<?php

/**
 * Class BS_API
 */
final class BetterFramework_Oculus {

	/**
	 * Better Studio API URI
	 *
	 * @var string
	 */
	private $base_url = 'http://core.betterstudio.com/api/v1/%s';

	/**
	 * self instance
	 *
	 * @var array
	 */
	protected static $instance;

	/**
	 * Store Authentication params - array {
	 * @type string|int $item_id       the item id in envato marketplace
	 * @type string     $purchase_code envato purchase code
	 * }
	 *
	 * @var array
	 */
	protected $auth = array();

	/**
	 * Oculus Version
	 */
	const VERSION = '1.0.1';

	/**
	 * Initialize
	 */
	public static function Run() {
		global $bs_oculus;

		if ( $bs_oculus === FALSE ) {
			return;
		}

		if ( ! $bs_oculus instanceof self ) {
			$bs_oculus = new self();
			$bs_oculus->init();
		}

		return $bs_oculus;
	}

	/**
	 * apply filters/actions
	 */
	public function init() {
		$this->include_files();

		add_action( 'admin_init', array( $this, 'register_schedule' ) );
		add_action( 'better-framework/oculus/sync/init', array( $this, 'sync_betterstudio' ) );

	}

	/**
	 * Start sync cron job
	 */
	public function sync_betterstudio() {
		$data     = apply_filters( 'better-framework/oculus/sync/data', array() );
		$response = self::request( 'sync', array(), $data, FALSE );

		if ( $response && ! empty( $response->success ) ) {
			do_action( 'better-framework/oculus/sync/done', $response, $data );
		}
	}

	/**
	 * Callback: register sync cron job
	 * action  : admin_init
	 */
	public function register_schedule() {
		if ( ! wp_next_scheduled( 'better-framework/oculus/sync/init' ) ) {
			wp_schedule_event( time(), 'daily', 'better-framework/oculus/sync/init' );
		}
	}

	/**
	 * Include oculus additional classes
	 */
	protected function include_files() {
		require BS_OCULUS_PATH . 'includes/class-bf-oculus-logger.php';
		require BS_OCULUS_PATH . 'includes/class-bf-oculus-notification.php';
	}

	/**
	 * Connect Better Studio API and Retrieve Data From Server
	 *
	 * @param string $action       {@see handle_request}
	 * @param array  $auth         authentication info {@see $auth}
	 * @param array  $data         array of data to send
	 * @param bool   $use_wp_error use wp_error object on failure or always return false
	 *
	 * @return bool|WP_Error|array|object bool|WP_Error on failure.
	 */
	public static function request( $action, $auth, $data, $use_wp_error = TRUE ) {

		try {
			$auth = wp_parse_args( $auth, apply_filters( 'better-framework/oculus/request/auth', array() ) );

			if ( ! isset( $auth['item_id'] ) || ! isset( $auth['purchase_code'] ) ) {
				throw new BF_API_Exception( 'invalid authentication data', 'invalid-auth-data' );
			}

			$instance = self::get_instance();
			$instance->set_auth_params( $auth );
			$response = $instance->handle_request( $action, $data );


			// auto clean product registration info if purchase-code was not valid!
			if ( isset( $response->result ) && isset( $response->{'error-code'} ) &&
			     $response->result === 'error' && $response->{'error-code'} === 'invalid-purchase-code'
			) {
				if ( function_exists( 'bf_register_product_clear_info' ) ) {
					bf_register_product_clear_info( $auth['item_id'] );
				}
			}

			return $response;
		} catch( Exception $e ) {

			if ( $use_wp_error ) {
				return new WP_Error( 'error-' . $e->getCode(), $e->getMessage() );
			}

			return FALSE;
		}
	}

	/**
	 * Fetch a remove url
	 *
	 * @param string $url
	 * @param array  $args wp_remote_get() $args
	 *
	 * @return string|false string on success or false|Exception on failure.
	 * @throws Exception
	 */
	protected function fetch_data( $url, $args = array() ) {
		global $wp_version;

		$defaults = array(
			'timeout'    => 30,
			'user-agent' => 'BetterStudioApi Domain:' . home_url() .
			                '; WordPress/' . $wp_version . '; Oculus/' . self::VERSION . ';',
			'headers'    => array(
				'better-studio-item-id'      => $this->auth['item_id'],
				'better-studio-item-version' => isset( $this->auth['version'] ) ? $this->auth['version'] : 0,
				'envato-purchase-code'       => $this->auth['purchase_code']
			)
		);

		$args         = wp_parse_args( $args, $defaults );
		$raw_response = wp_remote_post( $url, $args );

		if ( is_wp_error( $raw_response ) ) {
			throw new BF_API_Exception( $raw_response->get_error_message(), $raw_response->get_error_code() );
		}

		if ( 200 == wp_remote_retrieve_response_code( $raw_response ) ) {

			return wp_remote_retrieve_body( $raw_response );
		}

		return FALSE;
	}

	/**
	 * Handle API Remove Request
	 *
	 * @param string $action Api action. EX: register_product, check_update,....
	 * @param array  $data   array of data
	 *
	 * @return false|array|object array or object on success, false|Exception on failure
	 * @throws Exception
	 */

	public function handle_request( $action, $data ) {

		$url  = sprintf( $this->base_url, $action );
		$args = array(
			'body' => $data
		);

		if ( $received = $this->fetch_data( $url, $args ) ) {

			return json_decode( $received );
		}

		return FALSE;
	}

	/**
	 * Returns live instance of BS_API
	 *
	 * @return self
	 */
	private static function get_instance() {

		if ( empty( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * Set Authentication Params
	 *
	 * @param array $args
	 *
	 * @see   $auth
	 */
	public function set_auth_params( $args ) {
		$this->auth = $args;
	}
}

BetterFramework_Oculus::Run();