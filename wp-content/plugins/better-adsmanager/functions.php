<?php


/**
 * Used to get array of key->name of campaigns
 *
 * @param int  $count
 * @param bool $empty_label
 *
 * @return array
 */
function better_ads_get_campaigns_option( $count = 10, $empty_label = FALSE ) {

	$args = array(
		'posts_per_page' => $count,
	);

	if ( $empty_label ) {
		return array( 'none' => __( '-- Select Campaign --', 'better-studio' ) ) + Better_Ads_Manager::get_campaigns( $args );
	} else {
		return Better_Ads_Manager::get_campaigns( $args );
	}

}


/**
 * Used to get array of key->name of banners
 *
 * @param int  $count
 * @param bool $empty_label
 *
 * @return array
 */
function better_ads_get_banners_option( $count = 10, $empty_label = FALSE ) {

	$args = array(
		'posts_per_page' => $count,
	);

	if ( $empty_label ) {
		return array( 'none' => __( '-- Select Banner --', 'better-studio' ) ) + Better_Ads_Manager::get_banners( $args );
	} else {
		return Better_Ads_Manager::get_campaigns( $args );
	}

}


/**
 * Handy function to add Ad location fields to panel by it's prefix
 *
 * @param       $fields
 * @param array $args
 */
function better_ads_inject_ad_field_to_fields( &$fields, $args = array() ) {

	$args = wp_parse_args( $args, array(
		'id_prefix'   => '',
		'group'       => TRUE,
		'group_state' => 'open',
		'group_title' => __( 'Ad', 'better-ads' ),
	) );


	if ( empty( $args['id_prefix'] ) ) {
		return;
	}

	if ( $args['group'] ) {
		$fields[] = array(
			'name'  => $args['group_title'],
			'type'  => 'group',
			'state' => $args['group_state'],
		);
	}

	$fields[ $args['id_prefix'] . '_type' ]     = array(
		'name'    => __( 'Ad Type', 'better-studio' ),
		'id'      => $args['id_prefix'] . '_type',
		'desc'    => __( 'Chose campaign or banner.', 'better-studio' ),
		'type'    => 'select',
		'std'     => '',
		'options' => array(
			''         => __( '-- Select Ad type --', 'better-studio' ),
			'campaign' => __( 'Campaign', 'better-studio' ),
			'banner'   => __( 'Banner', 'better-studio' ),
		)
	);
	$fields[ $args['id_prefix'] . '_banner' ]   = array(
		'name'               => __( 'Banner', 'better-studio' ),
		'id'                 => $args['id_prefix'] . '_banner',
		'desc'               => __( 'Chose banner.', 'better-studio' ),
		'type'               => 'select',
		'std'                => 'none',
		'deferred-options'   => array(
			'callback' => 'better_ads_get_banners_option',
			'args'     => array(
				- 1,
				TRUE
			),
		),
		'filter-field'       => $args['id_prefix'] . '_type',
		'filter-field-value' => 'banner',
	);
	$fields[ $args['id_prefix'] . '_campaign' ] = array(
		'name'               => __( 'Campaign', 'better-studio' ),
		'id'                 => $args['id_prefix'] . '_campaign',
		'desc'               => __( 'Chose campaign.', 'better-studio' ),
		'type'               => 'select',
		'std'                => 'none',
		'deferred-options'   => array(
			'callback' => 'better_ads_get_campaigns_option',
			'args'     => array(
				- 1,
				TRUE
			),
		),
		'filter-field'       => $args['id_prefix'] . '_type',
		'filter-field-value' => 'campaign',
	);
	$fields[ $args['id_prefix'] . '_count' ]    = array(
		'name'               => __( 'Max Amount of Allowed Banners', 'better-studio' ),
		'id'                 => $args['id_prefix'] . '_count',
		'desc'               => __( 'How many banners are allowed?.', 'better-studio' ),
		'input-desc'         => __( 'Leave empty to show all banners.', 'better-studio' ),
		'type'               => 'text',
		'std'                => 1,
		'filter-field'       => $args['id_prefix'] . '_type',
		'filter-field-value' => 'campaign',
	);
	$fields[ $args['id_prefix'] . '_columns' ]  = array(
		'name'               => __( 'Columns', 'better-studio' ),
		'id'                 => $args['id_prefix'] . '_columns',
		'desc'               => __( 'Show ads in multiple columns.', 'better-studio' ),
		'type'               => 'select',
		"options"            => array(
			1 => __( '1 Column', 'better-studio' ),
			2 => __( '2 Column', 'better-studio' ),
			3 => __( '3 Column', 'better-studio' ),
		),
		'std'                => 1,
		'filter-field'       => $args['id_prefix'] . '_type',
		'filter-field-value' => 'campaign',
	);
	$fields[ $args['id_prefix'] . '_orderby' ]  = array(
		'name'               => __( 'Order By', 'better-studio' ),
		'id'                 => $args['id_prefix'] . '_orderby',
		'type'               => 'select',
		"options"            => array(
			'date'  => __( 'Date', 'better-studio' ),
			'title' => __( 'Title', 'better-studio' ),
			'rand'  => __( 'Rand', 'better-studio' ),
		),
		'std'                => 'rand',
		'filter-field'       => $args['id_prefix'] . '_type',
		'filter-field-value' => 'campaign',
	);
	$fields[ $args['id_prefix'] . '_order' ]    = array(
		'name'               => __( 'Order', 'better-studio' ),
		'id'                 => $args['id_prefix'] . '_order',
		'type'               => 'select',
		"options"            => array(
			'ASC'  => __( 'Ascending', 'better-studio' ),
			'DESC' => __( 'Descending', 'better-studio' ),
		),
		'std'                => 'ASC',
		'filter-field'       => $args['id_prefix'] . '_type',
		'filter-field-value' => 'campaign',
	);
	$fields[ $args['id_prefix'] . '_align' ]    = array(
		'name'    => __( 'Align', 'better-studio' ),
		'desc'    => __( 'Chose align of ad.', 'better-studio' ),
		'id'      => $args['id_prefix'] . '_align',
		'type'    => 'select',
		"options" => array(
			'left'   => __( 'Left', 'better-studio' ),
			'center' => __( 'Center', 'better-studio' ),
			'right'  => __( 'Right', 'better-studio' ),
		),
		'std'     => 'center',
	);
}


/**
 * Shows ad location code by its panel prefix or data
 *
 * @param string $panel_ad_prefix
 * @param null   $ad_data
 */
function better_ads_show_ad_location( $panel_ad_prefix = '', $ad_data = NULL ) {

	if ( empty( $panel_ad_prefix ) ) {
		return;
	}

	if ( is_null( $ad_data ) || ! is_array( $ad_data ) ) {
		$ad_data = better_ads_get_ad_location_data( $panel_ad_prefix );
	}

	echo Better_Ads_Manager()->show_ads( $ad_data );
}


/**
 * Returns full list of Ad location data from it's prefix inside panel
 *
 * @param string $panel_ad_prefix
 *
 * @return array
 */
function better_ads_get_ad_location_data( $panel_ad_prefix = '' ) {

	$data_ids = array(
		'type'            => '',
		'banner'          => '',
		'campaign'        => '',
		'count'           => '',
		'columns'         => '',
		'orderby'         => '',
		'order'           => '',
		'align'           => '',
	);


	if ( empty( $panel_ad_prefix ) ) {
		$data_ids['active_location'] = FALSE;
		return $data_ids;
	}

	foreach ( $data_ids as $id => $value ) {
		$data_ids[ $id ] = Better_Ads_Manager()->get_option( $panel_ad_prefix . '_' . $id );
	}

	if ( $data_ids['type'] == 'banner' && ( $data_ids['banner'] && $data_ids['banner'] != 'none' ) ) {
		$data_ids['active_location'] = TRUE;
	} elseif ( $data_ids['type'] == 'campaign' && ( $data_ids['campaign'] && $data_ids['campaign'] != 'none' ) ) {
		$data_ids['active_location'] = TRUE;
	}else{
		$data_ids['active_location'] = FALSE;
	}

	return $data_ids;
}


/**
 * Handy function to fetching data from Google Adsense code.
 *
 * @param $code
 *
 * @return array
 */
function better_ads_extract_google_ad_code_data( $code ) {

	$data = array(
		'ad-client' => '',
		'ad-slot'   => '',
		'style'     => '',
	);

	$code = strtolower( $code );

	/**
	 *
	 * data-ad-client
	 *
	 */
	preg_match( '/data-ad-client="(.*)"/', $code, $matches );

	if ( ! empty( $matches[1] ) ) {
		$data['ad-client'] = $matches[1];
	}


	/**
	 *
	 * data-ad-slot
	 *
	 */
	preg_match( '/data-ad-slot="(.*)"/', $code, $matches );

	if ( ! empty( $matches[1] ) ) {
		$data['ad-slot'] = $matches[1];
	}


	/**
	 *
	 * data-ad-slot
	 *
	 */
	preg_match( '/data-ad-format="(.*)"/', $code, $matches );

	if ( ! empty( $matches[1] ) ) {
		$data['ad-format'] = $matches[1];
	}


	/**
	 *
	 * style
	 *
	 */
	preg_match( '/style="(.*)"/', $code, $matches );

	if ( ! empty( $matches[1] ) ) {
		$data['style'] = $matches[1];
	}


	return $data;
}
