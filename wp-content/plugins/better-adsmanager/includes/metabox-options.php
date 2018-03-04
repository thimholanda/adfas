<?php

// Meta box options
add_filter( 'better-framework/metabox/options', 'better_ads_manager_metabox_options', 100 );


if ( ! function_exists( 'better_ads_manager_metabox_options' ) ) {

	/**
	 * Setup custom metaboxes for BetterMag
	 *
	 * @param $options
	 *
	 * @return array
	 */
	function better_ads_manager_metabox_options( $options ) {

		/**
		 * => Banner Options
		 */
		$fields['ad_options']  = array(
			'name' => __( 'Ad', 'better-studio' ),
			'id'   => 'ad_options',
			'type' => 'tab',
			'icon' => 'bsai-advertise',
		);
		$fields['campaign']    = array(
			'name'             => __( 'Campaign', 'better-studio' ),
			'desc'             => __( 'Chose campaign for ad.', 'better-studio' ),
			'id'               => 'campaign',
			'type'             => 'select',
			'std'              => 'none',
			'deferred-options' => array(
				'callback' => 'better_ads_get_campaigns_option',
				'args'     => array(
					- 1,
					TRUE
				),
			),
			'section-css'      => array(
				'background' => '#FCFCFC'
			)
		);
		$fields['type']        = array(
			'name'    => __( 'Ad Type', 'better-studio' ),
			'desc'    => __( 'Chose type of ad.', 'better-studio' ),
			'id'      => 'type',
			'type'    => 'select',
			'std'     => '',
			'options' => array(
				''            => __( '-- Select Ad type -- ', 'better-studio' ),
				'code'        => __( 'Google Adsense Code', 'better-studio' ),
				'custom_code' => __( 'Custom Code', 'better-studio' ),
				'image'       => __( 'Image', 'better-studio' ),
			)
		);
		$fields['code']        = array(
			'name'               => __( 'Google Adsense Code', 'better-studio' ),
			'id'                 => 'code',
			'desc'               => __( 'Paste your Google Adsense or any other ad code here.', 'better-studio' ),
			'type'               => 'textarea',
			'std'                => '',
			'filter-field'       => 'type',
			'filter-field-value' => 'code',
		);
		$fields['custom_code'] = array(
			'name'               => __( 'Custom Ad Code', 'better-studio' ),
			'id'                 => 'custom_code',
			'desc'               => __( 'Paste any ad code here.', 'better-studio' ),
			'type'               => 'textarea',
			'std'                => '',
			'filter-field'       => 'type',
			'filter-field-value' => 'custom_code',
		);
		// todo change and add image url directly
		$fields['img']                  = array(
			'name'               => __( 'Image', 'better-studio' ),
			'id'                 => 'img',
			'desc'               => __( 'Upload or chose ad image.', 'better-studio' ),
			'type'               => 'media_image',
			'std'                => '',
			'media_title'        => __( 'Select or Upload Ad Image', 'better-studio' ),
			'media_button'       => __( 'Select Image', 'better-studio' ),
			'upload_label'       => __( 'Upload Ad Image', 'better-studio' ),
			'remove_label'       => __( 'Remove ', 'better-studio' ),
			'filter-field'       => 'type',
			'filter-field-value' => 'image',
		);
		$fields['url']                  = array(
			'name'               => __( 'Link', 'better-studio' ),
			'id'                 => 'url',
			'desc'               => __( 'Paste you ad link here.', 'better-studio' ),
			'type'               => 'text',
			'std'                => '',
			'filter-field'       => 'type',
			'filter-field-value' => 'image',
		);
		$fields['target']               = array(
			'name'               => __( 'Link Target', 'better-studio' ),
			'desc'               => __( 'Chose where to open the link?', 'better-studio' ),
			'id'                 => 'target',
			'type'               => 'select',
			'std'                => '_blank',
			"options"            => array(
				'_blank'  => __( '_blank - in new window or tab', 'better-studio' ),
				'_self'   => __( '_self - in the same frame as it was clicked', 'better-studio' ),
				'_parent' => __( '_parent - in the parent frame', 'better-studio' ),
				'_top'    => __( '_top - in the full body of the window', 'better-studio' ),
			),
			'filter-field'       => 'type',
			'filter-field-value' => 'image',
		);
		$fields['caption']              = array(
			'name'               => __( 'Caption', 'better-studio' ),
			'id'                 => 'caption',
			'desc'               => __( 'Optional caption that will be shown after ad.', 'better-studio' ),
			'type'               => 'text',
			'std'                => '',
			'filter-field'       => 'type',
			'filter-field-value' => 'image',
		);
		$fields['no_follow']            = array(
			'name'               => __( 'Link Rel No Follow', 'better-studio' ),
			'desc'               => __( 'Do you want to add rel nofollow to your link?', 'better-studio' ),
			'id'                 => 'no_follow',
			'type'               => 'switch',
			'std'                => FALSE,
			'on-label'           => __( 'Yes', 'better-studio' ),
			'off-label'          => __( 'No', 'better-studio' ),
			'filter-field'       => 'type',
			'filter-field-value' => 'image',
		);
		$fields['show_desktop']         = array(
			'name'            => __( 'Enable on Desktop', 'better-studio' ),
			'id'              => 'show_desktop',
			'type'            => 'switch',
			'std'             => '1',
			'on-label'        => __( 'Enable', 'better-studio' ),
			'off-label'       => __( 'Disable', 'better-studio' ),
			'container_class' => 'better-enable-field',
		);
		$fields['show_tablet_portrait'] = array(
			'name'            => __( 'Enable on Tablet Portrait', 'better-studio' ),
			'id'              => 'show_tablet_portrait',
			'type'            => 'switch',
			'std'             => TRUE,
			'on-label'        => __( 'Enable', 'better-studio' ),
			'off-label'       => __( 'Disable', 'better-studio' ),
			'container_class' => 'better-enable-field',
		);
		$fields['show_phone']           = array(
			'name'            => __( 'Enable on Phone', 'better-studio' ),
			'id'              => 'show_phone',
			'type'            => 'switch',
			'std'             => TRUE,
			'on-label'        => __( 'Enable', 'better-studio' ),
			'off-label'       => __( 'Disable', 'better-studio' ),
			'container_class' => 'better-enable-field',
		);


		/**
		 * => Advanced Settings
		 */
		$fields['style_tab']    = array(
			'name' => __( 'Style', 'better-studio' ),
			'id'   => 'style_tab',
			'type' => 'tab',
			'icon' => 'bsai-paint',
		);
		$fields['custom_class'] = array(
			'name' => __( 'Custom Class', 'better-studio' ),
			'id'   => 'custom_class',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'This classes will be added to banner wrapper tag.<br>Separate classes with space.', 'better-studio' )
		);
		$fields['custom_id']    = array(
			'name' => __( 'Custom ID', 'better-studio' ),
			'id'   => 'custom_id',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'This id will be added to banner wrapper tag.', 'better-studio' )
		);
		$fields['custom_css']   = array(
			'name' => __( 'Custom CSS', 'better-studio' ),
			'id'   => 'custom_css',
			'type' => 'textarea',
			'std'  => '',
			'desc' => __( 'Paste your CSS code, do not include any tags or HTML in the field. Any custom CSS entered here will override the default CSS. In some cases, the !important tag may be needed.', 'better-studio' )
		);


		/**
		 * => AdBlock Fallback
		 * todo change icon to better one
		 */
		$fields['adblock_options']    = array(
			'name'       => __( 'Ad Blockers', 'better-studio' ),
			'id'         => 'adblock_options',
			'type'       => 'tab',
			'icon'       => 'bsai-delete',
			'margin-top' => '20',
			'badge'      => array(
				'text'  => __( 'New', 'better-studio' ),
				'color' => '#62D393'
			)
		);
		$fields[]                     = array(
			'name'          => __( 'Ad Blockers Fallback', 'better-studio' ),
			'id'            => 'adblock-help',
			'type'          => 'info',
			'std'           => __( '
                <p>Ad Blockers prevents page elements, mainly advertisements from being displayed that can hurts the main purpose of your site advertisement goals.</p>
                <p>We take and advanced attention to this and you can use following options to make fallback for when the main ad was detected with blockers.</p>
                <p><strong>Note:</strong> Ad Blockers can not detect simple image ads but use this option to external ad generators like Google Adsense.</p>
                                ', 'better-studio' ),
			'state'         => 'open',
			'info-type'     => 'help',
			'section_class' => 'widefat',
		);
		$fields['fallback_type']      = array(
			'name'    => __( 'Fallback Type', 'better-studio' ),
			'desc'    => __( 'Chose type of fallback for ad.', 'better-studio' ),
			'id'      => 'fallback_type',
			'type'    => 'select',
			'std'     => 'image',
			'options' => array(
				'image' => __( 'Image', 'better-studio' ),
				'code'  => __( 'HTML Code', 'better-studio' ),
			)
		);
		$fields['fallback_code']      = array(
			'name'               => __( 'Custom HTML Code', 'better-studio' ),
			'id'                 => 'fallback_code',
			'desc'               => __( 'Paste your custom HTML code. Yo can add css code also within &lt;style&gt;&lt;/style&gt;', 'better-studio' ),
			'type'               => 'textarea',
			'std'                => '',
			'filter-field'       => 'fallback_type',
			'filter-field-value' => 'code',
		);
		$fields['fallback_img']       = array(
			'name'               => __( 'Fallback Image', 'better-studio' ),
			'id'                 => 'fallback_img',
			'desc'               => __( 'Upload or chose fallback image for ad.', 'better-studio' ),
			'type'               => 'media_image',
			'std'                => '',
			'media_title'        => __( 'Select or Upload Ad Image', 'better-studio' ),
			'media_button'       => __( 'Select Image', 'better-studio' ),
			'upload_label'       => __( 'Upload Image', 'better-studio' ),
			'remove_label'       => __( 'Remove', 'better-studio' ),
			'filter-field'       => 'fallback_type',
			'filter-field-value' => 'image',
		);
		$fields['fallback_caption']   = array(
			'name'               => __( 'Caption', 'better-studio' ),
			'id'                 => 'fallback_caption',
			'desc'               => __( 'Optional caption that will be shown after Image.', 'better-studio' ),
			'type'               => 'text',
			'std'                => '',
			'filter-field'       => 'fallback_type',
			'filter-field-value' => 'image',
		);
		$fields['fallback_url']       = array(
			'name'               => __( 'Link', 'better-studio' ),
			'id'                 => 'fallback_url',
			'desc'               => __( 'Paste you ad link here.', 'better-studio' ),
			'type'               => 'text',
			'std'                => '',
			'filter-field'       => 'fallback_type',
			'filter-field-value' => 'image',
		);
		$fields['fallback_target']    = array(
			'name'               => __( 'Link Target', 'better-studio' ),
			'desc'               => __( 'Chose where To Open The link?', 'better-studio' ),
			'id'                 => 'fallback_target',
			'type'               => 'select',
			'std'                => '_blank',
			"options"            => array(
				'_blank'  => __( '_blank - in new window or tab', 'better-studio' ),
				'_self'   => __( '_self - in the same frame as it was clicked', 'better-studio' ),
				'_parent' => __( '_parent - in the parent frame', 'better-studio' ),
				'_top'    => __( '_top - in the full body of the window', 'better-studio' ),
			),
			'filter-field'       => 'fallback_type',
			'filter-field-value' => 'image',
		);
		$fields['fallback_no_follow'] = array(
			'name'               => __( 'Link Rel No Follow', 'better-studio' ),
			'desc'               => __( 'Do you want to add rel nofollow to your link?', 'better-studio' ),
			'id'                 => 'fallback_no_follow',
			'type'               => 'switch',
			'std'                => FALSE,
			'on-label'           => __( 'Yes', 'better-studio' ),
			'off-label'          => __( 'No', 'better-studio' ),
			'filter-field'       => 'fallback_type',
			'filter-field-value' => 'image',
		);


		$options['better_ads_banner_options'] = array(
			'config'   => array(
				'title'    => __( 'Better Banner', 'better-studio' ),
				'pages'    => array( 'better-banner' ),
				'context'  => 'normal',
				'prefix'   => FALSE,
				'priority' => 'high'
			),
			'panel-id' => Better_Ads_Manager::$panel_id,
			'fields'   => $fields
		);


		/**
		 * => Campaign Metabox
		 */
		$fields                                 = array();
		$fields['campaign_options']             = array(
			'name' => __( 'Campaign', 'better-studio' ),
			'id'   => 'campaign_options',
			'type' => 'tab',
			'icon' => 'bsai-gear',
		);
		$fields['desc']                         = array(
			'name'          => __( 'Campaign Note & Description', 'better-studio' ),
			'id'            => 'desc',
			'type'          => 'textarea',
			'std'           => '',
			'section_class' => 'full-with-both',
		);
		$options['better_ads_campaign_options'] = array(
			'config'   => array(
				'title'    => __( 'Better Campaign Options', 'better-studio' ),
				'pages'    => array( 'better-campaign' ),
				'context'  => 'normal',
				'prefix'   => FALSE,
				'priority' => 'high'
			),
			'panel-id' => Better_Ads_Manager::$panel_id,
			'fields'   => $fields
		);

		return $options;

	} //setup_bf_metabox

}
