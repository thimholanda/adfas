<?php

/**
 * Class BF_Demo_Install_Plugin_Adapter
 */
class BF_Demo_Install_Plugin_Adapter {

	/**
	 * @var BF_Product_Plugin_Factory
	 */
	private $_hanlder;

	/**
	 * @var BF_Product_Demo_Manager
	 */
	private $_demo_manager;

	/**
	 * BF_Demo_Install_Plugin_Adapter constructor.
	 */
	public function __construct() {

		$this->init();

		$this->_hanlder      = new BF_Product_Plugin_Factory();
		$this->_demo_manager = new BF_Product_Plugin_Manager();
	}

	/**
	 * include classes
	 */
	private function init() {

		if ( ! class_exists( 'BF_Product_Plugin_Factory' ) ) {

			$class_path = BF_Product_Pages::get_path( 'install-plugin/class-bf-product-plugin-factory.php' );

			if ( file_exists( $class_path ) ) {
				require_once $class_path;
			}
		}

		if ( ! class_exists( 'BF_Product_Plugin_Factory' ) ) {

			trigger_error( 'BF_Product_Plugin_Factory Was not found. BF_Demo_Install_Plugin_Adapter class need this class to handle plugin installation' );

			return;
		}

		if ( ! class_exists( 'BF_Product_Plugin_Manager' ) ) {

			$class_path = BF_Product_Pages::get_path( 'install-plugin/class-bf-product-plugin-manager.php' );

			if ( file_exists( $class_path ) ) {
				require_once $class_path;
			}
		}

		if ( ! class_exists( 'BF_Product_Plugin_Manager' ) ) {

			trigger_error( 'BF_Product_Plugin_Manager Was not found. BF_Demo_Install_Plugin_Adapter class need this class to handle plugin installation' );

			return;
		}
	}

	/**
	 * @see BF_Product_Plugin_Factory::install_start paranms
	 *
	 * @param array  $calculated_steps calculated plguin installation/update steps via
	 *
	 * @see \BF_Product_Plugin_Manager::calculate_process_steps
	 *
	 *
	 *
	 *
	 * @param int    $step
	 * @param string $plugin_ID
	 *
	 * @return bool true on success false otherwise
	 */
	public function install_start( $calculated_steps, $step, $plugin_ID ) {

		//validate $calculated_steps steps
		if ( ! isset( $calculated_steps['steps'] ) || ! is_array( $calculated_steps['steps'] ) ) {

			return FALSE;
		}

		$plugins_list = $this->_demo_manager->get_plugins_data();
		if ( ! isset( $plugins_list[ $plugin_ID ] ) ) {

			return FALSE;
		}


		//convert index number to plugin installation action
		$array_index    = $step - 1;
		$plugin_actions = array_keys( $calculated_steps['steps'] );

		if ( isset( $plugin_actions[ $array_index ] ) ) {
			$plugin_action = &$plugin_actions[ $array_index ];
		} else {

			return FALSE;
		}


		$plugin_data = &$plugins_list[ $plugin_ID ];

		return $this->_hanlder->install_start( $plugin_data, $plugin_action, $step, $plugin_ID );
	}

	public function install_stop() {

		$this->_hanlder->install_stop();
	}
}