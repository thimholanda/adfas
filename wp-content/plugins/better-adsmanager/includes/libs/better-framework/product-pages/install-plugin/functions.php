<?php


/**
 * enqueue static files.
 */

function bf_install_plugins_enqueue_scripts() {

	if ( bf_is_product_page( 'install-plugin' ) ) {

		bf_enqueue_script( 'bf-modal' );
		bf_enqueue_style( 'bf-modal' );

		$ver = BF_Product_Pages::Run()->get_version();

		wp_enqueue_style( 'bs-product-plugin-styles', BF_Product_Pages::get_url( 'install-plugin/assets/css/bs-plugin-install.css' ), array(), $ver );

		wp_enqueue_script( 'bs-product-plugin-scripts', BF_Product_Pages::get_url( 'install-plugin/assets/js/bs-plugin-install.js' ), array(), $ver );

		wp_localize_script( 'bs-product-plugin-scripts', 'bs_plugin_install_loc', array(
			'on_error' => array(
				'button_ok'       => __( 'Ok', 'better-studio' ),
				'default_message' => __( 'Cannot install plugin.', 'better-studio' ),
				'body'            => __( 'please try again several minutes later or contact better studio team support.', 'better-studio' ),
				'header'          => __( 'plugin installation failed', 'better-studio' ),
				'rollback_error'  => __( 'unable to remove temporary plugin files', 'better-studio' ),
				'title'           => __( 'an error occurred while installing plugin', 'better-studio' ),

			)
		) );
	}

}

add_action( 'admin_enqueue_scripts', 'bf_install_plugins_enqueue_scripts' );

/**
 * get plugins config array
 *
 * @return array  {
 *
 *  Plugin_ID => array {
 *
 * @type string  $name        plugin name
 * @type string  $slug        plugin slug( plugin directory )
 * @type boolean $required    is plugin required?
 * @type string  $version     plugin version number
 * @type string  $description plugin description
 * @type string  $thumbnail   plugin image  URI
 * @type string  $local_path  path to zip file if plugin not exists in wordpress.org plugin repository
 *
 * }
 *
 * ...
 * }
 */
function bf_get_plugins_config() {

	$result = array();

	foreach ( apply_filters( 'better-framework/product-pages/install-plugin/config', array() ) as $id => $plugin ) {
		if ( ! isset( $plugin['type'] ) ) {
			$plugin['type'] = empty( $plugin['local_path'] ) ? 'global' : 'local';
		}
		$result[ $id ] = $plugin;
	}

	return $result;
}

/**
 * Display notice if required plugins was not installed
 */
function bf_required_plugin_notice() {
	if ( $plugins = bf_get_plugins_config() ) {

		$add_notice            = FALSE;
		$last_required_plugins = get_option( 'bs-require-plugin-install' );
		$required_plugins      = array();

		if ( ! class_exists( 'BS_Product_Plugin_Factor' ) ) {
			require_once BF_Product_Pages::get_path( 'install-plugin/class-bf-product-plugin-factory.php' );
		}

		foreach ( $plugins as $plugin_ID => $plugin ) {

			if ( ! empty( $plugin['required'] ) && $plugin['required'] ) {

				if ( ! BF_Product_Plugin_Factory::is_plugin_installed( $plugin_ID )
				     ||
				     ! BF_Product_Plugin_Factory::is_plugin_active( $plugin_ID )
				) {
					$required_plugins[] = $plugin['name'];
				}
			}
		}

		if ( $last_required_plugins === FALSE ) {
			$add_notice = TRUE;
		} else {
			sort( $required_plugins );
			if ( $required_plugins != $last_required_plugins ) {
				$add_notice = TRUE;
			}
		}

		if ( ! $add_notice ) {
			return;
		}


		if ( empty( $required_plugins ) ) {
			delete_option( 'bs-require-plugin-install' );
			Better_Framework::admin_notices()->remove_notice( 'bs-product-required-plugins' );

		} else {

			update_option( 'bs-require-plugin-install', $required_plugins );

			$link = admin_url( 'admin.php?page=' . BF_Product_Pages::$menu_slug . '-install-plugin' );

			if ( count( $required_plugins ) > 1 ) {

				if ( count( $required_plugins ) === 2 ) {
					$msg = wp_kses( sprintf(
						__( 'The <strong>%s</strong> and <strong>%s</strong> plugins are required for %s to work properly. Install and activate them from <a href="%s">Plugin Installer</a>.', 'better-studio' ),
						@$required_plugins['0'],
						@$required_plugins['1'],
						BF_Product_Pages::get_product_info( 'product_name', '' ),
						$link
					), bf_trans_allowed_html() );
				} else {
					$msg = wp_kses( sprintf( __( 'Some required plugins was not installed currently. Install and activate them from <a href="%s">Plugin Installer</a>.', 'better-studio' ), $link ), bf_trans_allowed_html() );
				}

			} else {
				$msg = wp_kses( sprintf(
					__( 'The <strong>%s</strong> plugin is required for %s to work properly. Install and activate it from <a href="%s">Plugin Installer</a>.', 'better-studio' ),
					@$required_plugins['0'],
					BF_Product_Pages::get_product_info( 'product_name', '' ),
					$link
				), bf_trans_allowed_html() );
			}

			Better_Framework::admin_notices()->add_notice( array(
				'msg'       => $msg,
				'id'        => 'bs-product-required-plugins',
				'type'      => 'fixed',
				'state'     => 'danger',
				'thumbnail' => BF_Product_Pages::get_product_info( 'notice-icon', '' ),
				'product'   => 'theme:themename',
			) );
		}

	}
}

add_action( 'in_admin_header', 'bf_required_plugin_notice', 17 );


function bf_update_plugin_schedule() {

	if ( ! class_exists( 'BF_Product_Plugin_Factory' ) ) {
		require_once BF_Product_Pages::get_path( 'install-plugin/class-bf-product-plugin-factory.php' );
	}

	if ( ! class_exists( 'BF_Product_Plugin_Manager' ) ) {
		require_once BF_Product_Pages::get_path( 'install-plugin/class-bf-product-plugin-manager.php' );
	}

	$obj    = new BF_Product_Plugin_Manager();
	$status = $obj->update_plugins( TRUE );
	if ( ! empty( $status->remote_plugins ) && is_array( $status->remote_plugins ) ) {
		$plugins_update = get_site_transient( 'update_plugins' );
		if ( empty( $plugins_update->response ) ) {
			$plugins_update->response = array();
		}

		$r = &$plugins_update->response;
		foreach ( $status->remote_plugins as $p_file => $plugin_data ) {
			$r[ $p_file ]          = (object) $plugin_data;
			$r[ $p_file ]->plugin  = $p_file;
			$r[ $p_file ]->package = 'FETCH_FROM_BETTER_STUDIO/' . $plugin_data['slug'];
		}

		set_site_transient( 'update_plugins', $plugins_update );
	}
}

add_action( 'wp_update_plugins', 'bf_update_plugin_schedule' );

/**
 *
 *
 * @param mixed $value
 *
 * @return mixed
 */
function bf_update_plugins_list( $value ) {

	if ( bf_is_doing_ajax() && isset( $_REQUEST['action'] ) && $_REQUEST['action'] === 'update-plugin' ) {
		if ( ! empty( $value->response ) && is_array( $value->response ) ) {

			if ( ! class_exists( 'BF_Product_Plugin_Factory' ) ) {
				require_once BF_Product_Pages::get_path( 'install-plugin/class-bf-product-plugin-factory.php' );
			}
			$installer = new BF_Product_Plugin_Factory();
			add_filter( 'http_request_args', 'bf_remove_reject_unsafe_urls', 99 );

			foreach ( $value->response as $p_file => $plugin_data ) {
				if ( isset( $plugin_data->package ) && preg_match( '/^FETCH_FROM_BETTER_STUDIO\/.+/i', $plugin_data->package ) ) {
					$dl_link = $installer->get_bundled_plugin_download_link( $plugin_data->slug );

					$value->response[ $p_file ]->package = $dl_link;
				}
			}
		}
	}

	return $value;
}

add_action( 'site_transient_update_plugins', 'bf_update_plugins_list' );

if ( ! function_exists( 'bf_remove_reject_unsafe_urls' ) ) {
	function bf_remove_reject_unsafe_urls( $args ) {
		$args['reject_unsafe_urls'] = FALSE;

		return $args;
	}
}

function bf_update_plugin_bulk( $bool, $package ) {
	if ( preg_match( '/^FETCH_FROM_BETTER_STUDIO\/(.+)/i', $package, $match ) ) {
		$plugin_slug = &$match[1];

		if ( ! class_exists( 'BF_Product_Plugin_Factory' ) ) {
			require_once BF_Product_Pages::get_path( 'install-plugin/class-bf-product-plugin-factory.php' );
		}

		$installer = new BF_Product_Plugin_Factory();
		if ( $url = $installer->get_bundled_plugin_download_link( $plugin_slug ) ) {

			return $installer->download_package( $url );
		}
	}

	return $bool;
}

add_filter( 'upgrader_pre_download', 'bf_update_plugin_bulk', 999, 2 );


/**
 * callback: remove visual composer register admin notice
 * action  : vc_after_mapping
 */
function bf_remove_vc_register_notice() {
	global $_bs_vc_access_changes;

	if ( function_exists( 'vc_user_access' ) ) {
		$instance = vc_user_access();
		if ( is_callable( array( $instance, 'setValidAccess' ) ) ) {
			$instance->setValidAccess( FALSE );
		}
		if ( is_callable( array( $instance, 'getValidAccess' ) ) ) {
			$_bs_vc_access_changes = vc_user_access()->getValidAccess();
		}
	}
}

add_action( 'vc_after_mapping', 'bf_remove_vc_register_notice' );

/**
 * callback: Hide register revolution slider admin notice
 *
 * action  : better-framework/product-pages/install-plugin/install-finished,
 *           better-framework/product-pages/install-plugin/active-finished
 *
 * @param string|array $data
 *
 * @return bool
 */
function bf_remove_revslider_register_notice( $data ) {
	if ( is_string( $data ) ) {
		$slug = $data;
	} else if ( isset( $data['slug'] ) ) {
		$slug = $data['slug'];
	} else {
		return FALSE;
	}

	if ( $slug === 'revslider' ) {
		update_option( 'revslider-valid-notice', 'false' );
	}

	return TRUE;
}

add_action( 'better-framework/product-pages/install-plugin/install-finished', 'bf_remove_revslider_register_notice' );
add_action( 'better-framework/product-pages/install-plugin/active-finished', 'bf_remove_revslider_register_notice' );

/**
 * callback: undo changes on visual composer user access
 * action  : vc_after_init
 */
function bf_undo_vc_access_changes() {
	global $_bs_vc_access_changes;

	if ( ! is_null( $_bs_vc_access_changes ) ) {
		vc_user_access()->setValidAccess( $_bs_vc_access_changes );
		unset( $_bs_vc_access_changes );
	}
}

add_action( 'vc_after_init', 'bf_undo_vc_access_changes' );

function bf_force_check_plugins_update() {
	BF_Product_Pages::Run()->plugins_menu_instance()->update_plugins( TRUE );
}

add_action( 'load-update.php', 'bf_force_check_plugins_update' );
add_action( 'load-update-core.php', 'bf_force_check_plugins_update' );


function bf_append_plugins_update_badge( $menu ) {
	if ( empty( $menu['parent'] ) || $menu['id'] === BF_Product_Pages::$menu_slug . '-install-plugin' ) {
		if ( $update_status = get_option( 'bs-product-plugins-status' ) ) {
			if ( ! empty( $update_status->remote_plugins ) && is_array( $update_status->remote_plugins ) ) {

				/**
				 * Just display number of updates for activated plugins
				 * @see BF_Product_Plugin_Manager::render_content
				 */
				if ( ! class_exists( 'BS_Product_Plugin_Factor' ) ) {
					require_once BF_Product_Pages::get_path( 'install-plugin/class-bf-product-plugin-factory.php' );
				}
				$activated_plugins_updates = 0;
				foreach ( $update_status->remote_plugins as $plugin ) {
					if ( isset( $plugin['slug'] ) &&
					     BF_Product_Plugin_Factory::is_plugin_installed( $plugin['slug'] ) &&
					     BF_Product_Plugin_Factory::is_plugin_active( $plugin['slug'] )
					) {
						$activated_plugins_updates ++;
					}
				}
				if ( $activated_plugins_updates ) {
					$menu_title_index = $menu['parent'] ? 'menu_title' : 'parent_title';

					$menu[ $menu_title_index ] .= ' &nbsp;<span class="bs-admin-menu-badge"><span class="plugin-count">'
					                              . number_format_i18n( $activated_plugins_updates ) .
					                              '</span></span>';
				}
			}
		}
	}

	return $menu;
}

add_filter( 'better-framework/product-pages/register-menu/params', 'bf_append_plugins_update_badge' );