<?php

// Admin panel options
add_filter( 'better-framework/panel/options', 'better_ads_manager_option_panel' );

if ( ! function_exists( 'better_ads_manager_option_panel' ) ) {

	/**
	 * Callback: Setup setting panel
	 *
	 * Filter: better-framework/panel/options
	 *
	 * @param $options
	 *
	 * @return array
	 */
	function better_ads_manager_option_panel( $options ) {

		$fields = array();

		/**
		 *
		 * Priorities for help
		 *
		 *
		 * 30  -> Post Ads
		 *      33 -> Post Top Ads
		 *      35 -> Post Bottom Ads
		 *      37 -> Post Inline Ads
		 *
		 *
		 * 90  -> Custom CSS/JS
		 *
		 * 100 -> Import/Export
		 *
		 */
		$fields = apply_filters( 'better-ads/options', $fields );


		// Language  name for smart admin texts
		$lang = bf_get_current_lang_raw();
		if ( $lang != 'none' ) {
			$lang = bf_get_language_name( $lang );
		} else {
			$lang = '';
		}

		$options[ Better_Ads_Manager::$panel_id ] = array(
			'config'     => array(
				'parent'              => FALSE,
				'parent_title'        => '<strong>Better</strong>Ads',
				'slug'                => 'better-studio/better-ads-manager',
				'name'                => __( 'Better Ads Manager', 'better-studio' ),
				'page_title'          => __( 'Better Ads Manager', 'better-studio' ),
				'menu_title'          => __( 'Ads Manager', 'better-studio' ),
				'capability'          => 'manage_options',
				'icon_url'            => NULL,
				'position'            => '59.000',
				'icon'                => '\e033',
				'exclude_from_export' => FALSE,
			),
			'texts'      => array(
				'panel-desc-lang'     => '<p>' . __( '%s Language Ads.', 'better-studio' ) . '</p>',
				'panel-desc-lang-all' => '<p>' . __( 'All Languages Ads.', 'better-studio' ) . '</p>',
				'reset-button'        => ! empty( $lang ) ? sprintf( __( 'Reset %s Ads', 'better-studio' ), $lang ) : __( 'Reset Ads', 'better-studio' ),
				'reset-button-all'    => __( 'Reset All Ads', 'better-studio' ),
				'reset-confirm'       => ! empty( $lang ) ? sprintf( __( 'Are you sure to reset %s Ads?', 'better-studio' ), $lang ) : __( 'Are you sure to reset Ads?', 'better-studio' ),
				'reset-confirm-all'   => __( 'Are you sure to reset all Ads?', 'better-studio' ),
				'save-button'         => ! empty( $lang ) ? sprintf( __( 'Save %s Ads', 'better-studio' ), $lang ) : __( 'Save Ads', 'better-studio' ),
				'save-button-all'     => __( 'Save All Ads', 'better-studio' ),
				'save-confirm-all'    => __( 'Are you sure to save all Ads? this will override specified Ads per languages', 'better-studio' )
			),
			'panel-name' => _x( 'Better Ads Manager', 'Panel title', 'better-studio' ),
			'panel-desc' => '<p>' . __( 'Manage your ads in better way!', 'better-studio' ) . '</p>',
			'fields'     => $fields
		);

		return $options;
	}

}


add_filter( 'better-ads/options', '_better_ads_options_post_ads_tab', 30 );

/**
 * Ads "Post Ads" tab to options
 *
 * @param $fields
 *
 * @return array
 */
function _better_ads_options_post_ads_tab( $fields ) {

	$fields[] = array(
		'name' => __( 'Post Ads', 'better-studio' ),
		'id'   => 'post_ads_tab',
		'type' => 'tab',
		'icon' => 'bsai-page-text',
	);

	return $fields;
}


add_filter( 'better-ads/options', '_better_ads_options_post_top_ads', 33 );

/**
 * Ads "Post Ads" tab to options
 *
 * @param $fields
 *
 * @return array
 */
function _better_ads_options_post_top_ads( $fields ) {

	better_ads_inject_ad_field_to_fields( $fields, array(
		'group'       => TRUE,
		'group_title' => __( 'Post Top Ad', 'better-studio' ),
		'id_prefix'   => 'ad_post_top',
	) );

	return $fields;
}


add_filter( 'better-ads/options', '_better_ads_options_post_bottom_ads', 33 );

/**
 * Ads "Post Bottom Ads" to options
 *
 * @param $fields
 *
 * @return array
 */
function _better_ads_options_post_bottom_ads( $fields ) {

	better_ads_inject_ad_field_to_fields( $fields, array(
		'group'       => TRUE,
		'group_title' => __( 'Post Bottom Ad', 'better-studio' ),
		'id_prefix'   => 'ad_post_bottom',
	) );

	return $fields;

}


add_filter( 'better-ads/options', '_better_ads_options_post_inline_ads', 37 );

/**
 * Ads "Post Ads" tab to options
 *
 * @param $fields
 *
 * @return array
 */
function _better_ads_options_post_inline_ads( $fields ) {

	$fields[]     = array(
		'name'  => __( 'Post Inline Ads', 'better-studio' ),
		'type'  => 'group',
		'state' => 'close',
	);
	$inline_ads   = array();
	$inline_ads[] = array(
		'name'          => __( 'Ad Type', 'better-studio' ),
		'id'            => 'type',
		'desc'          => __( 'Chose campaign or banner.', 'better-studio' ),
		'type'          => 'select',
		'options'       => array(
			''         => __( '-- Select Ad Type --', 'better-studio' ),
			'campaign' => __( 'Campaign', 'better-studio' ),
			'banner'   => __( 'Banner', 'better-studio' ),
		),
		'repeater_item' => TRUE,
	);
	$inline_ads[] = array(
		'name'               => __( 'Campaign', 'better-studio' ),
		'id'                 => 'campaign',
		'desc'               => __( 'Chose campaign.', 'better-studio' ),
		'type'               => 'select',
		'deferred-options'   => array(
			'callback' => 'better_ads_get_campaigns_option',
			'args'     => array(
				- 1,
				TRUE
			),
		),
		'filter-field'       => 'type',
		'filter-field-value' => 'campaign',
		'repeater_item'      => TRUE,
	);
	$inline_ads[] = array(
		'name'               => __( 'Banner', 'better-studio' ),
		'id'                 => 'banner',
		'desc'               => __( 'Chose banner.', 'better-studio' ),
		'type'               => 'select',
		'deferred-options'   => array(
			'callback' => 'better_ads_get_banners_option',
			'args'     => array(
				- 1,
				TRUE
			),
		),
		'filter-field'       => 'type',
		'filter-field-value' => 'banner',
		'repeater_item'      => TRUE,
	);
	$inline_ads[] = array(
		'name'               => __( 'Max Amount of Allowed Banners', 'better-studio' ),
		'id'                 => 'count',
		'desc'               => __( 'How many banners are allowed?.', 'better-studio' ),
		'input-desc'         => __( 'Leave empty to show all banners.', 'better-studio' ),
		'type'               => 'text',
		'filter-field'       => 'type',
		'filter-field-value' => 'campaign',
		'repeater_item'      => TRUE,
	);
	$inline_ads[] = array(
		'name'               => __( 'Columns', 'better-studio' ),
		'id'                 => 'columns',
		'desc'               => __( 'Show ads in multiple columns.', 'better-studio' ),
		'type'               => 'select',
		"options"            => array(
			1 => __( '1 Column', 'better-studio' ),
			2 => __( '2 Column', 'better-studio' ),
			3 => __( '3 Column', 'better-studio' ),
		),
		'filter-field'       => 'type',
		'filter-field-value' => 'campaign',
		'repeater_item'      => TRUE,
	);
	$inline_ads[] = array(
		'name'               => __( 'Order By', 'better-studio' ),
		'id'                 => 'orderby',
		'type'               => 'select',
		"options"            => array(
			'date'  => __( 'Date', 'better-studio' ),
			'title' => __( 'Title', 'better-studio' ),
			'rand'  => __( 'Rand', 'better-studio' ),
		),
		'filter-field'       => 'type',
		'filter-field-value' => 'campaign',
		'repeater_item'      => TRUE,
	);
	$inline_ads[] = array(
		'name'               => __( 'Order', 'better-studio' ),
		'id'                 => 'order',
		'type'               => 'select',
		"options"            => array(
			'ASC'  => __( 'Ascending', 'better-studio' ),
			'DESC' => __( 'Descending', 'better-studio' ),
		),
		'filter-field'       => 'type',
		'filter-field-value' => 'campaign',
		'repeater_item'      => TRUE,
	);
	// todo add image preview
	$inline_ads[] = array(
		'name'          => __( 'Position', 'better-studio' ),
		'id'            => 'position',
		'desc'          => __( 'Chose position of inline ad.', 'better-studio' ),
		'type'          => 'select',
		'options'       => array(
			'left'   => __( 'Left Align', 'better-studio' ),
			'center' => __( 'Center Align', 'better-studio' ),
			'right'  => __( 'Right Align', 'better-studio' ),
		),
		'repeater_item' => TRUE,
	);
	$inline_ads[] = array(
		'name'          => __( 'After Paragraph', 'better-studio' ),
		'id'            => 'paragraph',
		'desc'          => __( 'Content of each post will analyzed and it will inject an ad after the selected number of paragraphs.', 'better-studio' ),
		'input-desc'    => __( 'After how many paragraphs the ad will display.', 'better-studio' ),
		'type'          => 'text',
		'repeater_item' => TRUE,
	);

	$fields['ad_post_inline'] = array(
		'name'          => '',
		'desc'          => __( 'Add inline adds inside post content. <br>You can add multiple inline adds for multiple location of post content.', 'better-studio' ),
		'id'            => 'ad_post_inline',
		'type'          => 'repeater',
		'save-std'      => TRUE,
		'default'       => array(
			array(
				'type'      => '',
				'campaign'  => 'none',
				'banner'    => 'none',
				'position'  => 'center',
				'paragraph' => 3,
				'count'     => 3,
				'columns'   => 3,
				'orderby'   => 'rand',
				'order'     => 'ASC',
			),
		),
		'add_label'     => '<i class="fa fa-plus"></i> ' . __( 'Add New Inline Ad', 'better-studio' ),
		'delete_label'  => __( 'Delete Ad', 'better-studio' ),
		'item_title'    => __( 'Inline Ad', 'better-studio' ),
		'section_class' => 'full-with-both',
		'options'       => $inline_ads
	);

	return $fields;
}


add_filter( 'better-ads/options', '_better_ads_options_custom_css_js', 90 );

/**
 * Ads "Custom CSS/JS" to options
 *
 * @param $fields
 *
 * @return array
 */
function _better_ads_options_custom_css_js( $fields ) {

	$fields[] = array(
		'name'       => __( 'Custom CSS/JS', 'better-studio' ),
		'id'         => 'custom_css_settings',
		'type'       => 'tab',
		'icon'       => 'bsai-css3',
		'margin-top' => '20',
	);
	$fields[] = array(
		'name'       => __( 'Custom CSS Code', 'better-studio' ),
		'id'         => 'custom_css_code',
		'type'       => 'textarea',
		'std'        => '',
		'desc'       => __( 'Paste your CSS code, do not include any tags or HTML in the field. Any custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed.', 'better-studio' ),
		'input-desc' => __( 'Please <strong>do not</strong> put code inside &lt;style&gt;&lt;/style&gt; tags.', 'better-studio' ),
	);
	$fields[] = array(
		'name'       => __( 'HTML/JS Code before &lt;/head&gt;', 'better-studio' ),
		'id'         => 'custom_header_code',
		'input-desc' => __( 'Please put js code inside &lt;script&gt;&lt;/script&gt; tags.', 'better-studio' ),
		'std'        => '',
		'type'       => 'textarea',
		'desc'       => __( 'This code will be placed before &lt;/head&gt; tag in html. Useful if you have an external script that requires it.', 'better-studio' )
	);

	return $fields;
}


add_filter( 'better-ads/options', '_better_ads_options_import_export', 100 );

/**
 * Ads "Custom CSS/JS" to options
 *
 * @param $fields
 *
 * @return array
 */
function _better_ads_options_import_export( $fields ) {

	bf_inject_panel_import_export_fields( $fields, array(
		'panel-id'         => Better_Ads_Manager::$panel_id,
		'export-file-name' => 'better-ads-backup',
	) );

	return $fields;
}


