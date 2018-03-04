<?php


/**
 * Compatibility for versions before 1.1
 *
 * @return bool
 */
function publisher_version_1_1_copatibility() {

	$sidebars = wp_get_sidebars_widgets();

	$widgets_in_sidebar = array();

	foreach ( $sidebars['aside-logo'] as $widget_numbers ) {
		if ( preg_match( "/^(.*?)\-(\d.*)+/i", $widget_numbers, $match ) ) {

			$widget_id_base = &$match[1];
			$widget_number  = &$match[2];

			$widgets_in_sidebar[ $widget_id_base ][] = $widget_number;
		}
	}

	foreach ( $widgets_in_sidebar as $id_base => $widget_numbers ) {

		if ( $id_base != 'better-ads' ) {
			continue;
		}

		$option_name = "widget_$id_base";

		$option = get_option( $option_name );

		if ( $option && is_array( $option ) ) {

			$ads_manager = get_option( 'better_ads_manager' );

			$fields = array(
				'type',
				'banner',
				'campaign',
				'count',
				'columns',
				'orderby',
				'order',
				'align',
			);

			foreach ( $fields as $id ) {
				if ( ! empty( $option[ $widget_numbers[0] ][ $id ] ) ) {
					$ads_manager[ 'header_aside_logo_' . $id ] = $option[ $widget_numbers[0] ][ $id ];
				}
			}

			update_option( 'better_ads_manager', $ads_manager );

			break; // only first ads widget

		}
	}

	return TRUE;
}
