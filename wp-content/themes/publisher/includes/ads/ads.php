<?php


if ( ! function_exists( 'publisher_is_ad_plugin_active' ) ) {
	/**
	 * Detect the BetterAds manager v1.4 is active or not
	 *
	 * @return bool
	 */
	function publisher_is_ad_plugin_active() {
		return class_exists( 'Better_Ads_Manager' ) && function_exists( 'better_ads_inject_ad_field_to_fields' );
	}
}


if ( ! function_exists( 'publisher_get_ad_location_data' ) ) {
	/**
	 * Return data of Ad location by its ID prefix
	 *
	 * @param string $ad_location_prefix
	 *
	 * @return array
	 */
	function publisher_get_ad_location_data( $ad_location_prefix = '' ) {

		if ( ! publisher_is_ad_plugin_active() ) {
			return array(
				'type'            => '',
				'banner'          => '',
				'campaign'        => '',
				'count'           => '',
				'columns'         => '',
				'orderby'         => '',
				'order'           => '',
				'align'           => '',
				'active_location' => '',
			);
		}

		return better_ads_get_ad_location_data( $ad_location_prefix );
	}
}


// Only when BetterAds v1.4 installed
if ( ! publisher_is_ad_plugin_active() ) {
	return;
}


add_filter( 'better-ads/options', 'publisher_better_ads_options_top', 10 );

if ( ! function_exists( 'publisher_better_ads_options_top' ) ) {
	/**
	 * Publisher ads
	 *
	 * @param $fields
	 *
	 * @return array
	 */
	function publisher_better_ads_options_top( $fields ) {

		/**
		 *
		 * Header Ads
		 *
		 */
		$fields[] = array(
			'name' => __( 'Header Ads', 'publisher' ),
			'id'   => 'header_ads',
			'type' => 'tab',
			'icon' => 'bsai-header',
		);

		better_ads_inject_ad_field_to_fields(
			$fields,
			array(
				'group'       => TRUE,
				'group_title' => __( 'Aside Logo Ad', 'publisher' ),
				'group_state' => 'open',
				'id_prefix'   => 'header_aside_logo',
			)
		);

		return $fields;
	}
}
