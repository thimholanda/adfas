<?php
/**
 * bs-social-share.php
 *---------------------------
 * [bs-social-share] short code & widget
 *
 */

/**
 * Publisher Social Share Shortcode
 */
class Publisher_Social_Share_Shortcode extends BF_Shortcode {

	function __construct( $id, $options ) {

		$id = 'bs-social-share';

		$this->name = __( 'Social Share Buttons', 'publisher' );

		$this->description = '';

		$_options = array(
			'defaults'       => array(
				'title'              => publisher_translation_get( 'widget_share' ),
				'show_title'         => 1,
				'show-section-title' => TRUE,
				'style'              => 'button',
				'colored'            => TRUE,
				'sites'              => array(
					'facebook'    => TRUE,
					'twitter'     => TRUE,
					'google_plus' => TRUE,
					'email'       => TRUE,
					'pinterest'   => FALSE,
					'linkedin'    => FALSE,
					'tumblr'      => FALSE,
					'telegram'    => FALSE,
				),
				'bs-show-desktop'    => TRUE,
				'bs-show-tablet'     => TRUE,
				'bs-show-phone'      => TRUE,
			),
			'have_widget'    => TRUE,
			'have_vc_add_on' => TRUE,
		);

		$_options = wp_parse_args( $_options, $options );

		parent::__construct( $id, $_options );

	}


	/**
	 * Filter custom css codes for shortcode widget!
	 *
	 * @param $fields
	 *
	 * @return array
	 */
	function register_custom_css( $fields ) {
		return $fields;
	}


	/**
	 * Handle displaying of shortcode
	 *
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	function display( array $atts, $content = '' ) {

		ob_start();

		publisher_set_prop( 'shortcode-bs-social-share-atts', $atts );
		publisher_get_view( 'shortcodes', 'bs-social-share' );
		publisher_clear_props();

		return ob_get_clean();

	}

	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {

		vc_map( array(
			"name"        => $this->name,
			"base"        => $this->id,
			"description" => $this->description,
			"weight"      => 1,

			"wrapper_height" => 'full',

			"category" => __( 'Publisher', 'publisher' ),

			"params" => array(


				array(
					'heading'       => __( 'Style', 'publisher' ),
					'type'          => 'bf_image_radio',
					"admin_label"   => TRUE,
					"param_name"    => 'style',
					"value"         => $this->defaults['style'],
					'section_class' => 'style-floated-left',
					'options'       => array(
						'button'                 => array(
							'label' => __( 'Button Style', 'publisher' ),
							'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-button.png' )
						),
						'button-no-text'         => array(
							'label' => __( 'Icon Button Style', 'publisher' ),
							'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-button-no-text.png' )
						),
						'outline-button'         => array(
							'label' => __( 'Outline Style', 'publisher' ),
							'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-outline-button.png' )
						),
						'outline-button-no-text' => array(
							'label' => __( 'Icon Outline Style', 'publisher' ),
							'img'   => bf_get_theme_uri( 'images/shortcodes/bs-social-share-outline-button-no-text.png' )
						),
					),
					'group'         => __( 'Style', 'publisher' ),
				),

				array(
					"type"       => 'bf_switchery',
					"heading"    => __( 'Show in colored  style?', 'publisher' ),
					"param_name" => 'colored',
					"value"      => $this->defaults['colored'],
					'group'      => __( 'Style', 'publisher' ),
				),

				array(
					"type"          => 'bf_sorter_checkbox',
					"admin_label"   => TRUE,
					"heading"       => __( 'Active and Sort Sites', 'publisher' ),
					"param_name"    => 'sites',
					"value"         => $this->defaults['sites'],
					'section_class' => 'bf-social-share-sorter',
					'options'       => array(
						'facebook'    => array(
							'label'     => '<i class="fa fa-facebook"></i> ' . __( 'Facebook', 'publisher' ),
							'css-class' => 'active-item'
						),
						'twitter'     => array(
							'label'     => '<i class="fa fa-twitter"></i> ' . __( 'Twitter', 'publisher' ),
							'css-class' => 'active-item'
						),
						'google_plus' => array(
							'label'     => '<i class="fa fa-google-plus"></i> ' . __( 'Google+', 'publisher' ),
							'css-class' => 'active-item'
						),
						'pinterest'   => array(
							'label'     => '<i class="fa fa-pinterest"></i> ' . __( 'Pinterest', 'publisher' ),
							'css-class' => 'active-item'
						),
						'linkedin'    => array(
							'label'     => '<i class="fa fa-linkedin"></i> ' . __( 'Linkedin', 'publisher' ),
							'css-class' => 'active-item'
						),
						'tumblr'      => array(
							'label'     => '<i class="fa fa-tumblr"></i> ' . __( 'Tumblr', 'publisher' ),
							'css-class' => 'active-item'
						),
						'email'       => array(
							'label'     => '<i class="fa fa-envelope "></i> ' . __( 'Email', 'publisher' ),
							'css-class' => 'active-item'
						),
					),
					'group'         => __( 'Style', 'publisher' ),
				),


				array(
					"type"        => 'textfield',
					"admin_label" => TRUE,
					"heading"     => __( 'Section Title', 'publisher' ),
					"param_name"  => 'title',
					"value"       => $this->defaults['title'],
					'group'       => __( 'Heading', 'publisher' ),
				),

				array(
					"type"       => 'bf_switchery',
					"heading"    => __( 'Show Title?', 'publisher' ),
					"param_name" => 'show_title',
					"value"      => $this->defaults['show_title'],
					'group'      => __( 'Heading', 'publisher' ),
				),

				array(
					"type"          => 'bf_switchery',
					"heading"       => __( 'Show on Desktop', 'publisher' ),
					"param_name"    => 'bs-show-desktop',
					"admin_label"   => FALSE,
					"value"         => $this->defaults['bs-show-desktop'],
					'section_class' => 'style-floated-left bordered bf-css-edit-switch',
					'group'         => __( 'Design options', 'publisher' ),
				),
				array(
					"type"          => 'bf_switchery',
					"heading"       => __( 'Show on Tablet Portrait', 'publisher' ),
					"param_name"    => 'bs-show-tablet',
					"admin_label"   => FALSE,
					"value"         => $this->defaults['bs-show-tablet'],
					'section_class' => 'style-floated-left bordered bf-css-edit-switch',
					'group'         => __( 'Design options', 'publisher' ),
				),
				array(
					"type"          => 'bf_switchery',
					"heading"       => __( 'Show on Phone', 'publisher' ),
					"param_name"    => 'bs-show-phone',
					"admin_label"   => FALSE,
					"value"         => $this->defaults['bs-show-phone'],
					'section_class' => 'style-floated-left bordered bf-css-edit-switch',
					'group'         => __( 'Design options', 'publisher' ),
				),

				array(
					'type'       => 'css_editor',
					'heading'    => __( 'CSS box', 'publisher' ),
					'param_name' => 'css',
					'group'      => __( 'Design options', 'publisher' ),
				)
			)

		) );

	}
} // Publisher_Social_Share_Shortcode


if ( ! function_exists( 'publisher_shortcode_social_share_get_li' ) ) {
	/**
	 * Used for generating lis for social share list
	 *
	 * @param string $id
	 * @param        $show_title
	 *
	 * @return string
	 */
	function publisher_shortcode_social_share_get_li( $id = '', $show_title = TRUE ) {

		if ( empty( $id ) ) {
			return '';
		}

		switch ( $id ) {

			case 'facebook':
				$link  = "javascript: window.open('http://www.facebook.com/sharer.php?u=" . get_permalink( get_the_ID() ) . "','_blank', 'width=900, height=450');";
				$title = __( 'Facebook', 'publisher' );
				$icon  = '<i class="fa fa-facebook"></i>';
				break;

			case 'twitter':
				$link  = "javascript: window.open('http://twitter.com/home?status=" . get_permalink( get_the_ID() ) . "','_blank', 'width=900, height=450');";
				$title = __( 'Twitter', 'publisher' );
				$icon  = '<i class="fa fa-twitter"></i>';
				break;

			case 'google_plus':
				$link  = "javascript: window.open('http://plus.google.com/share?url=" . get_permalink( get_the_ID() ) . "','_blank', 'width=500, height=450');";
				$title = __( 'Google+', 'publisher' );
				$icon  = '<i class="fa fa-google-plus"></i>';
				break;

			case 'pinterest':
				$_img_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$link     = "javascript: window.open('http://pinterest.com/pin/create/button/?url=" . get_permalink( get_the_ID() ) . '&media=' . $_img_src[0] . "&description=" . get_the_title() . "','_blank', 'width=900, height=450');";
				$title    = __( 'Pinterest', 'publisher' );
				$icon     = '<i class="fa fa-pinterest"></i>';
				break;

			case 'linkedin':
				$link  = "javascript: window.open('http://www.linkedin.com/shareArticle?mini=true&url=" . get_permalink( get_the_ID() ) . "&title=" . get_the_title() . "','_blank', 'width=500, height=450');";
				$title = __( 'Linkedin', 'publisher' );
				$icon  = '<i class="fa fa-linkedin"></i>';
				break;

			case 'tumblr':
				$link  = "javascript: window.open('http://www.tumblr.com/share/link?url=" . get_permalink( get_the_ID() ) . "&name=" . get_the_title() . "','_blank', 'width=500, height=450');";
				$title = __( 'Tumblr', 'publisher' );
				$icon  = '<i class="fa fa-tumblr"></i>';
				break;

			case 'email':
				$link  = "mailto:?subject=" . get_the_title() . "&body=" . esc_url( get_permalink( get_the_ID() ) );
				$title = publisher_translation_get( 'widget_email' );
				$icon  = '<i class="fa fa-envelope"></i>';
				break;

			case 'telegram':
				$link  = "javascript: window.open('https://telegram.me/share/url?url=" . esc_url( get_permalink( get_the_ID() ) ) . "&text=" . get_the_title() . "','_blank', 'width=900, height=450');";
				$title = __( 'Telegram', 'publisher' );
				$icon  = '<i class="fa fa-send"></i>';
				break;


			default:
				return '';
		}

		$output = '<li class="social-item ' . esc_attr( $id ) . '"><a href="' . $link . '" target="_blank" rel="nofollow">';

		$output .= $icon;

		if ( $show_title ) {
			$output .= '<span class="item-title">' . wp_kses( $title, bf_trans_allowed_html() ) . '</span></a>';
		}

		$output .= '</a></li>';

		return $output;

	}// publisher_shortcode_social_share_get_li
}// if


/**
 * Publisher Social Share Widget
 */
class Publisher_Social_Share_Widget extends BF_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {

		// haven't title in any location
		$this->with_title = TRUE;

		// Back end form fields
		$this->fields = array(
			array(
				'name'    => __( 'Title', 'publisher' ),
				'attr_id' => 'title',
				'type'    => 'text',
			),

			array(
				'name'          => __( 'Buttons Style', 'publisher' ),
				'attr_id'       => 'style',
				'type'          => 'image_select',
				'section_class' => 'style-floated-left',
				'value'         => 'clean',
				'options'       => array(
					'button'                 => array(
						'label' => __( 'Button Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'includes/admin-assets/images/vc-social-share-button.png' )
					),
					'button-no-text'         => array(
						'label' => __( 'Icon Button Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'includes/admin-assets/images/vc-social-share-button-no-text.png' )
					),
					'outline-button'         => array(
						'label' => __( 'Outline Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'includes/admin-assets/images/vc-social-share-outline-button.png' )
					),
					'outline-button-no-text' => array(
						'label' => __( 'Icon Outline Style', 'publisher' ),
						'img'   => bf_get_theme_uri( 'includes/admin-assets/images/vc-social-share-outline-button-no-text.png' )
					),
				),
			),

			array(
				'name'      => __( 'Colored Style', 'publisher' ),
				'attr_id'   => 'colored',
				'type'      => 'switch',
				'on-label'  => __( 'Yes', 'publisher' ),
				'off-label' => __( 'No', 'publisher' ),
			),

			array(
				'name'          => __( 'Active Sites', 'publisher' ),
				'attr_id'       => 'sites',
				'type'          => 'sorter_checkbox',
				'options'       => array(
					'facebook'    => array(
						'label'     => '<i class="fa fa-facebook"></i> ' . __( 'Facebook', 'publisher' ),
						'css-class' => 'active-item'
					),
					'twitter'     => array(
						'label'     => '<i class="fa fa-twitter"></i> ' . __( 'Twitter', 'publisher' ),
						'css-class' => 'active-item'
					),
					'google_plus' => array(
						'label'     => '<i class="fa fa-google-plus"></i> ' . __( 'Google+', 'publisher' ),
						'css-class' => 'active-item'
					),
					'pinterest'   => array(
						'label'     => '<i class="fa fa-pinterest"></i> ' . __( 'Pinterest', 'publisher' ),
						'css-class' => 'active-item'
					),
					'linkedin'    => array(
						'label'     => '<i class="fa fa-linkedin"></i> ' . __( 'Linkedin', 'publisher' ),
						'css-class' => 'active-item'
					),
					'tumblr'      => array(
						'label'     => '<i class="fa fa-tumblr"></i> ' . __( 'Tumblr', 'publisher' ),
						'css-class' => 'active-item'
					),
					'telegram'    => array(
						'label'     => '<i class="fa fa-send"></i> ' . __( 'Telegram', 'publisher' ),
						'css-class' => 'active-item'
					),
					'email'       => array(
						'label'     => '<i class="fa fa-envelope "></i> ' . __( 'Email', 'publisher' ),
						'css-class' => 'active-item'
					),
				),
				'section_class' => 'publisher-theme-social-share-sorter',
			),
		);

		parent::__construct(
			'bs-social-share',
			__( 'Publisher - Social Share', 'publisher' ),
			array( 'description' => __( 'Social Share Widget', 'publisher' ) )
		);
	} // __construct

} // Publisher_Social_Share_Widget class
