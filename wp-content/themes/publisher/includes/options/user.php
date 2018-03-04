<?php
/**
 * user.php
 *---------------------------
 * Registers options for authors
 *
 */

add_filter( 'better-framework/user-metabox/options', 'publisher_user_options', 100 );


if ( ! function_exists( 'publisher_user_options' ) ) {
	/**
	 * Setup users metaboxe's
	 *
	 * @param $options
	 *
	 * @return array
	 */
	function publisher_user_options( $options ) {

		$fields = array();

		/**
		 * => Style
		 */
		$fields[]                         = array(
			'name' => __( 'Style', 'publisher' ),
			'id'   => 'tab_style',
			'type' => 'tab',
			'icon' => 'bsai-paint',
		);
		$fields['avatar']                 = array(
			'name'         => __( 'User Avatar', 'publisher' ),
			'id'           => 'avatar',
			'type'         => 'media_image',
			'std'          => '',
			'upload_label' => __( 'Upload Avatar', 'publisher' ),
			'remove_label' => __( 'Upload Avatar', 'publisher' ),
			'desc'         => __( 'Upload your avatar. Use this to override Gravatar and WordPress default avatar.', 'publisher' ),
		);
		$fields['page_layout']            = array(
			'name'             => __( 'Author Page Layout', 'publisher' ),
			'id'               => 'page_layout',
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Select & override page layout for this author.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);
		$fields['page_listing']           = array(
			'name'             => __( 'Posts Listing', 'publisher' ),
			'id'               => 'page_listing',
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Select & override posts listing for this author.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_listing_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);
		$fields['author_posts_count']     = array(
			'name' => __( 'Number of Post to Show', 'publisher' ),
			'id'   => 'author_posts_count',
			'desc' => wp_kses( sprintf( __( 'Leave this empty for default. <br>Default: %s', 'publisher' ), publisher_get_option( 'archive_author_posts_count' ) != '' ? publisher_get_option( 'archive_author_posts_count' ) : get_option( 'posts_per_page' ) ), bf_trans_allowed_html() ),
			'type' => 'text',
			'std'  => '',
		);
		$fields['author_pagination_type'] = array(
			'name'             => __( 'Author pagination', 'publisher' ),
			'id'               => 'author_pagination_type',
			'std'              => 'default',
			'type'             => 'select',
			'desc'             => __( 'Select pagination of profile archive.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_pagination_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);

		/**
		 * => Social Links
		 */
		$fields[]                 = array(
			'name' => __( 'Social Links', 'publisher' ),
			'id'   => 'tab_social_links',
			'type' => 'tab',
			'icon' => 'bsai-link',
		);
		$fields['twitter_url']    = array(
			'name' => __( 'Twitter URL', 'publisher' ),
			'id'   => 'twitter_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Twitter profile URL.', 'publisher' ),
		);
		$fields['facebook_url']   = array(
			'name' => __( 'Facebook URL', 'publisher' ),
			'id'   => 'facebook_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Facebook page or profile link.', 'publisher' ),
		);
		$fields['gplus_url']      = array(
			'name' => __( 'Google+ URL', 'publisher' ),
			'id'   => 'gplus_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Google+ page link.', 'publisher' ),
		);
		$fields['youtube_url']    = array(
			'name' => __( 'Youtube URL', 'publisher' ),
			'id'   => 'youtube_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Youtube chanel or profile URL.', 'publisher' ),
		);
		$fields['linkedin_url']   = array(
			'name' => __( 'Linkedin URL', 'publisher' ),
			'id'   => 'linkedin_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Linkedin profile URL.', 'publisher' ),
		);
		$fields['github_url']     = array(
			'name' => __( 'Github URL', 'publisher' ),
			'id'   => 'github_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Github URL.', 'publisher' ),
		);
		$fields['pinterest_url']  = array(
			'name' => __( 'Pinterest URL', 'publisher' ),
			'id'   => 'pinterest_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Pinterest URL.', 'publisher' ),
		);
		$fields['dribbble_url']   = array(
			'name' => __( 'Dribbble URL', 'publisher' ),
			'id'   => 'dribbble_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Dribbble profile URL.', 'publisher' ),
		);
		$fields['vimeo_url']      = array(
			'name' => __( 'Vimeo URL', 'publisher' ),
			'id'   => 'vimeo_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Vimeo chanel or video URL.', 'publisher' ),
		);
		$fields['delicious_url']  = array(
			'name' => __( 'Delicious URL', 'publisher' ),
			'id'   => 'delicious_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Delicious profile URL.', 'publisher' ),
		);
		$fields['soundcloud_url'] = array(
			'name' => __( 'SoundCloud URL', 'publisher' ),
			'id'   => 'soundcloud_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter SoundCloud profile URL.', 'publisher' ),
		);
		$fields['behance_url']    = array(
			'name' => __( 'Behance URL', 'publisher' ),
			'id'   => 'behance_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Behance profile URL.', 'publisher' ),
		);
		$fields['flickr_url']     = array(
			'name' => __( 'Flickr URL', 'publisher' ),
			'id'   => 'flickr_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Flickr profile URL.', 'publisher' ),
		);
		$fields['instagram_url']  = array(
			'name' => __( 'Instagram URL', 'publisher' ),
			'id'   => 'instagram_url',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Enter Instagram profile URL.', 'publisher' ),
		);


		/**
		 *
		 * Adds custom CSS options for metabox
		 *
		 */
		bf_inject_panel_custom_css_fields( $fields );


		/**
		 * General Post Options
		 */
		$options['better_author_options'] = array(
			'config'   => array(
				'title'    => __( 'Better Author Options', 'publisher' ),
				'pages'    => array( 'post', 'page' ),
				'context'  => 'normal',
				'prefix'   => FALSE,
				'priority' => 'high'
			),
			'panel-id' => publisher_get_theme_panel_id(),
			'fields'   => $fields
		);

		return $options;

	} //publisher_user_options
} // if