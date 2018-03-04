<?php

if ( ! class_exists( 'BF_Product_Multi_Step_Item' ) ) {
	if ( is_admin() ) {
		require_once BF_PRODUCT_PAGES_PATH . 'backend.php';
	} else {
		require_once BF_PRODUCT_PAGES_PATH . 'frontend.php';
	}
}

/**
 * Class BF_Product_Demo_Manager
 */
class BF_Product_Demo_Manager extends BF_Product_Multi_Step_Item {

	/**
	 * module id
	 *
	 * @var string
	 */
	public $id = 'install-demo';

	/**
	 * plugin installation step name have this prefix
	 *
	 * @var string
	 */
	public $plugin_installation_step_prefix = 'plugin_';

	/**
	 * demo import data context.  content or setting
	 *
	 * @var string
	 */
	public $data_context = 'content';

	protected function before_render() {

		if ( ! class_exists( 'BF_Product_Demo_Factory' ) ) {
			require_once BF_Product_Pages::get_path( 'install-demo/class-bf-product-demo-factory.php' );
		}
	}

	/**
	 * HTML output to display admin user.
	 *
	 * @param $options
	 */
	public function render_content( $options ) {

		if ( $demos_list = apply_filters( 'better-framework/product-pages/install-demo/config', array() ) ) :
			?>

			<div class="bs-product-pages-install-demo">

				<?php

				foreach ( $demos_list as $demo_id => $demo_data ) :
					?>
					<div class="bs-pages-demo-item<?php if ( BF_Product_Demo_Factory::is_demo_installed( $demo_id ) )
						echo ' installed' ?>">
						<div class="bs-pages-overlay "></div>

						<div class="bs-pages-ribbon-wrapper">
							<div class="bs-pages-ribbon">
							</div>
							<div class="bs-pages-ribbon-label">
								<i class="fa fa-check"></i>
							</div>
						</div>

						<figure>
							<img src="<?php echo esc_url( $demo_data['thumbnail'] ) ?>"
							     alt="<?php echo esc_attr( $demo_data['name'] ); ?>"
							     class="bs-demo-thumbnail">
						</figure>
						<div class="bs-pages-progressbar">
							<div class="bs-pages-progress">

							</div>

						</div>

						<footer class="bs-pages-demo-item-footer bf-clearfix">
					<span class="bs-pages-demo-name">
							<?php echo esc_html( $demo_data['name'] ); ?>
					</span>

							<div class="bs-pages-buttons" data-demo-id="<?php echo esc_attr( $demo_id ) ?>">
								<?php #if ( has_filter( 'better-framework/product-pages/install-demo/' . $demo_id ) ) :
								?>
								<span class="install-demo highlight-section">
									<a href="#"
									   class="bs-pages-primary-btn"
									   disabled="disabled"><?php esc_html_e( 'Install', 'better-studio' ) ?></a>
								</span>
								<?php #endif;
								?>
								<span class="preview-demo">
									<a href="<?php echo esc_url( $demo_data['preview_url'] ); ?>" target="_blank"
									   class="bs-pages-secondary-btn"><?php esc_html_e( 'Preview', 'better-studio' ) ?></a>
								</span>
								<span class="uninstall-demo highlight-section">
									<a href="#"
									   class="bs-pages-secondary-btn"><?php esc_html_e( 'Uninstall', 'better-studio' ) ?></a>
								</span>
							</div>
							<div class="messages">
								<div class="installing highlight-section">
									<i class="fa fa-refresh fa-spin"></i>
									<?php esc_html_e( 'Installing...', 'better-studio' ) ?>
								</div>
								<div class="uninstalling highlight-section">
									<i class="fa fa-refresh fa-spin"></i>
									<?php esc_html_e( 'uninstalling...', 'better-studio' ) ?>
								</div>
								<div class="installed highlight-section">
									<i class="fa fa-check"></i>
									<?php esc_html_e( 'Installed', 'better-studio' ) ?>
								</div>
								<div class="uninstalled highlight-section">
									<i class="fa fa-check"></i>
									<?php esc_html_e( 'Uninstalled', 'better-studio' ) ?>
								</div>
								<div class="failed">
									<?php esc_html_e( 'process canceled', 'better-studio' ) ?>
								</div>
							</div>
						</footer>
					</div>
				<?php endforeach ?>

				<div class="clearfix"></div>
			</div>

			<?php

		else:

			//TODO: add alert class to this message
			echo 'no demo registered';

		endif;
	}


	/**
	 * @return null|BF_Product_Plugin_Manager object on success null otherwise
	 */
	protected function get_plugin_manager_instance() {

		$plugin_installer = BF_Product_Pages::Run()->get_item_handler_instance( 'plugins' );

		if ( $plugin_installer ) {

			return $plugin_installer;
		}
	}

	/**
	 * @return null|BF_Demo_Install_Plugin_Adapter object on success null otherwise
	 */
	protected function get_plugin_installer_adapter() {


		if ( ! class_exists( 'BF_Demo_Install_Plugin_Adapter' ) ) {

			$class_path = BF_Product_Pages::get_path( 'install-demo/class-bf-demo-install-plugin-adapter.php' );

			if ( file_exists( $class_path ) ) {
				require_once $class_path;
			}

			return new BF_Demo_Install_Plugin_Adapter();
		}
	}

	/**
	 * Calculate how many step needs to complete installation of demo.
	 *
	 * @param string $demo_id       Demo ID
	 * @param string $context       Demo process action( install|uninstall )
	 *
	 * @return array|bool boll on failure or array on success.
	 *
	 * array {
	 *
	 * @type         $total         integer number of total steps
	 * @type         $step          array    each data type, how many step need to complete.
	 * @type         $plugins       only plugin installation process. how many step needs to complete  install plugin.
	 *
	 * }
	 *
	 */
	protected function calculate_process_steps( $demo_id, $context = 'install' ) {

		$demo_data = $this->get_demo_data( $demo_id );

		if ( empty( $demo_data ) ) {
			return FALSE;
		}

		$total = 0;
		$steps = $plugins = array();

		// calculate how many steps take to complete installation plugin process

		if ( ! empty( $demo_data['plugins'] ) && is_array( $demo_data['plugins'] ) ) {

			/**
			 * @var $plugin_manager BF_Product_Plugin_Manager
			 */
			$plugin_manager = $this->get_plugin_manager_instance();

			if ( $plugin_manager ) {

				$plugins_list = $plugin_manager->get_plugins_data();

				foreach ( $demo_data['plugins'] as $plugin_ID ) {

					if ( ! isset( $plugins_list[ $plugin_ID ] ) ) {
						continue;
					}

					$plugin_data          = &$plugins_list[ $plugin_ID ];
					$installation_process = $plugin_manager->calculate_process_steps( $plugin_data, 'install', TRUE );

					if ( isset( $installation_process['steps'] ) ) {

						$total += $installation_process['total'];
						$steps[ $this->plugin_installation_step_prefix . $plugin_ID ] = $installation_process['total'];

						$plugins[ $plugin_ID ] = $installation_process;
					}

				}

			}
		}

		if ( ! class_exists( 'BF_Product_Demo_Factory' ) ) {
			require_once BF_Product_Pages::get_path( 'install-demo/class-bf-product-demo-factory.php' );
		}

		foreach ( BF_Product_Demo_Factory::import_data_sequence() as $type ) {

			if ( ! isset( $demo_data[ $type ] ) ) {
				continue;
			}

			$data = &$demo_data[ $type ];

			if ( ( $context === 'uninstall' && ( ! isset( $data['uninstall_multi_steps'] ) || ! $data['uninstall_multi_steps'] ) )
			     ||
			     ( $context !== 'uninstall' && ( ! isset( $data['multi_steps'] ) || ! $data['multi_steps'] ) )
			) {

				$steps[ $type ] = 1;
				$total ++;
			} else {

				unset( $data['multi_steps'] );
				unset( $data['uninstall_multi_steps'] );

				$current_type_steps = count( $data );
				$steps[ $type ]     = $current_type_steps;
				$total += $current_type_steps;
			}
		}

		// uninstalling step have a extra step called clean, to make sure
		// all temporary data will deleted and uninstalling completed.
		if ( $context === 'uninstall' ) {
			$steps['clean'] = 1;
			$total ++;

		}

		return compact( 'total', 'steps', 'plugins' );
	}

	/**
	 * @param string $demo_id
	 *
	 * @return array
	 */
	protected function get_demo_data( $demo_id ) {

		return bf_get_demo_data( $demo_id, $this->data_context );
	}

	/**
	 * ajax handler for demo install/unInstall demo requests
	 *
	 * @param Array $params
	 *
	 * @return bool true on success or false on failure.
	 *
	 * @see BS_Theme_Pages_Item::append_hidden_fields()
	 */
	public function ajax_request( $params ) {

		$required_params = array(
			'bs_pages_action' => '',
			'demo_id'         => '',
			'context'         => '',
		);

		if ( array_diff_key( $required_params, $params ) ) {
			return FALSE;
		}
		$demo_id = &$params['demo_id'];

		//set demo data context
		if ( $params['context'] === 'install' ) {

			$this->data_context = isset( $params['have_content'] ) && $params['have_content'] === 'no' ? 'setting' : 'content';
		} else if ( $params['context'] === 'uninstall' ) {

			// read data context saved in database when demo installed
			$option_name  = sprintf( 'bs_demo_id_%s', $demo_id );
			$option_value = get_option( $option_name, array() );

			if ( ! empty( $option_value['_context'] ) ) {
				$this->data_context = $option_value['_context'];
			}

		}

		$response = array();
		switch ( $params['bs_pages_action'] ) {

			case 'get_steps':

				if ( $install_steps = $this->calculate_process_steps( $params['demo_id'], $params['context'] ) ) {

					$this->set_steps_data( $params['demo_id'], $install_steps );

					$response = array(
						'steps'       => array_values( $install_steps['steps'] ),
						'types'       => array_keys( $install_steps['steps'] ),
						'steps_count' => count( $install_steps['steps'] ) - 1,
						'total'       => $install_steps['total'],
					);
				}

				//save demo data context to database, used to rollback demo
				if ( $params['context'] === 'install' ) {
					$option_name              = sprintf( 'bs_demo_id_%s', $demo_id );
					$option_value             = get_option( $option_name, array() );
					$option_value['_context'] = $this->data_context;
					update_option( $option_name, $option_value, 'no' );
				}

				break;


			case 'import':

				if ( isset( $params['current_type'] ) && isset( $params['current_step'] ) ) {

					$type  = &$params['current_type'];
					$step  = intval( $params['current_step'] );
					$index = $step - 1;


					$current_data   = FALSE;
					$demo_data      = $this->get_demo_data( $demo_id );
					$is_single_step = empty( $demo_data[ $type ]['multi_step'] );

					if ( isset( $demo_data[ $type ][ $index ] ) ) {

						$current_data = &$demo_data[ $type ][ $index ];

						if ( ! class_exists( 'BF_Product_Demo_Factory' ) ) {
							require_once BF_Product_Pages::get_path( 'install-demo/class-bf-product-demo-factory.php' );
						}

						$response = BF_Product_Demo_Factory::Run()->import_start( $current_data, $type, $index, $demo_id, $this->data_context );

						BF_Product_Demo_Factory::Run()->import_stop();

						if ( $this->is_final_step( $demo_id, $type, $step ) ) {

							$this->delete_steps_data( $demo_id );

							BF_Product_Demo_Factory::Run()->import_finished();
						}
					} else {

						//make sure its plugin installation step
						$pattern = preg_quote( $this->plugin_installation_step_prefix );
						if ( preg_match( "/^$pattern(.+)/i", $params['current_type'], $matched ) ) {

							$plugin_ID = &$matched[1];
							$step      = intval( $params['current_step'] );

							/**
							 * @var $plugin_installer BF_Demo_Install_Plugin_Adapter
							 * @var $plugin_manager   BF_Product_Plugin_Manager
							 */
							$plugin_installer = $this->get_plugin_installer_adapter();
							$plugin_manager   = $this->get_plugin_manager_instance();

							$steps_data = $this->get_steps_data( $demo_id );

							if ( $plugin_installer && $plugin_manager ) {

								$step_data = $this->get_steps_data( $demo_id );

								if ( isset( $step_data['plugins'][ $plugin_ID ] ) ) {

									$plugin_steps = &$step_data['plugins'][ $plugin_ID ];

									$plugin_installer->install_start( $plugin_steps, $step, $plugin_ID );
									$plugin_installer->install_stop();
								}
							}

							$response = TRUE;
						}
					}
				}
				break;

			case 'rollback':

				if ( isset( $params['current_type'] ) && isset( $params['current_step'] ) ) {

					$type     = &$params['current_type'];
					$step     = intval( $params['current_step'] );
					$index    = $step - 1;
					$response = TRUE;

					if ( ! class_exists( 'BF_Product_Demo_Factory' ) ) {
						require_once BF_Product_Pages::get_path( 'install-demo/class-bf-product-demo-factory.php' );
					}

					BF_Product_Demo_Factory::Run()->rollback_start( $type, $index, $demo_id, $this->data_context );
					BF_Product_Demo_Factory::Run()->rollback_stop();
				}
				break;

			case 'rollback_force':

				if ( ! class_exists( 'BF_Product_Demo_Factory' ) ) {
					require_once BF_Product_Pages::get_path( 'install-demo/class-bf-product-demo-factory.php' );
				}

				$response = TRUE;
				BF_Product_Demo_Factory::Run()->rollback_force( $demo_id, $this->data_context );
				break;
		}


		if ( $response ) {
			return $response;
		}

		return FALSE;
	} // ajax_request
}