<?php

$template_directory = trailingslashit( get_template_directory() );
$template_uri       = trailingslashit( get_template_directory_uri() );

if ( ! defined( 'PUBLISHER_THEME_ADMIN_ASSETS_URI' ) ) {
	define( 'PUBLISHER_THEME_ADMIN_ASSETS_URI', $template_uri . 'includes/admin-assets/' );
}

if ( ! defined( 'PUBLISHER_THEME_PATH' ) ) {
	define( 'PUBLISHER_THEME_PATH', $template_directory );
}

if ( ! defined( 'PUBLISHER_THEME_URI' ) ) {
	define( 'PUBLISHER_THEME_URI', $template_uri );
}

add_filter( 'publisher-theme-core/config', 'publisher_config_theme_core', 22, 3 );

if ( ! function_exists( 'publisher_config_theme_core' ) ) {
	/**
	 * Callback: Config "Publisher Theme Core" library needle sections.
	 * Filter: publisher-theme-core/config
	 *
	 * @param array $config
	 *
	 * @return array
	 */
	function publisher_config_theme_core( $config = array() ) {

		$config['dir-path']   = get_template_directory() . '/includes/libs/bs-theme-core/';
		$config['dir-url']    = get_template_directory_uri() . '/includes/libs/bs-theme-core/';
		$config['theme-slug'] = 'publisher';
		$config['theme-name'] = __( 'Publisher', 'publisher' );

		$config['sections']['attr']                   = TRUE;
		$config['sections']['meta-tags']              = TRUE;
		$config['sections']['listing-pagin']          = TRUE;
		$config['sections']['translation']            = TRUE;
		$config['sections']['social-meta-tags']       = TRUE;
		$config['sections']['chat-format']            = TRUE;
		$config['sections']['duplicate-posts']        = TRUE;
		$config['sections']['gallery-slider']         = TRUE;
		$config['sections']['shortcodes-placeholder'] = TRUE;
		$config['sections']['editor-shortcodes']      = TRUE;
		$config['sections']['theme-helpers']          = TRUE;
		$config['sections']['vc-helpers']             = TRUE;
		$config['sections']['version-compatibility']  = TRUE;
		$config['sections']['rebuild-thumbnails']     = TRUE;

		$config['vc-widgets-atts'] = array(
			'before_title'  => '<h5 class="widget-heading"><span class="h-text">',
			'after_title'   => '</span></h5>',
			'before_widget' => '<div id="%1$s" class="widget vc-widget %2$s">',
			'after_widget'  => '</div>',
		);

		return $config;
	}
}


// Init BetterTranslation for theme
add_filter( 'publisher-theme-core/translation/config', 'publisher_translations_config' );

if ( ! function_exists( 'publisher_translations_config' ) ) {
	/**
	 * Callback: Publisher Translation configurations
	 *
	 * Filter: better-translation/config
	 *
	 * @param $config
	 *
	 * @return mixed
	 */
	function publisher_translations_config( $config ) {

		$config['theme-id']      = 'publisher';
		$config['theme-name']    = 'Publisher';
		$config['notice-icon']   = PUBLISHER_THEME_URI . 'images/admin/notice-logo.png';
		$config['menu-parent']   = 'bs-product-pages-welcome';
		$config['menu-position'] = '3.4';

		$config['translations'] = array(
			'en_US' => array(
				'name' => __( 'English - US', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/en_US.json',
			),
			'zh'    => array(
				'name' => __( 'Chinese', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/zh.json',
			),
			'es_ES' => array(
				'name' => __( 'Spanish', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/es_ES.json',
			),
			'hi_IN' => array(
				'name' => __( 'Hindi', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/hi_IN.json',
			),
			'ar'    => array(
				'name' => __( 'Arabic', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/ar.json',
			),
			'pt_PT' => array(
				'name' => __( 'Portuguese', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/pt_PT.json',
			),
			'bn'    => array(
				'name' => __( 'Bengali', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/bn.json',
			),
			'ru_RU' => array(
				'name' => __( 'Russian', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/ru_RU.json',
			),
			'ja_JP' => array(
				'name' => __( 'Japanese (Japan)', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/ja_JP.json',
			),
			'pa'    => array(
				'name' => __( 'Punjabi', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/pa.json',
			),
			'de_DE' => array(
				'name' => __( 'German', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/de_DE.json',
			),
			'jw'    => array(
				'name' => __( 'Javanese', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/jw.json',
			),
			'ms'    => array(
				'name' => __( 'Malay', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/ms.json',
			),
			'te'    => array(
				'name' => __( 'Telugu', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/te.json',
			),
			'vi'    => array(
				'name' => __( 'Vietnamese', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/vi.json',
			),
			'ko_KR' => array(
				'name' => __( 'Korean (South Korea)', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/ko_KR.json',
			),
			'fr'    => array(
				'name' => __( 'French', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/fr.json',
			),
			'mr'    => array(
				'name' => __( 'Marathi', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/mr.json',
			),
			'ta'    => array(
				'name' => __( 'Tamil', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/ta.json',
			),
			'ur'    => array(
				'name' => __( 'Urdu', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/ur.json',
			),
			'tr_TR' => array(
				'name' => __( 'Turkish (Turkey)', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/tr_TR.json',
			),
			'it_IT' => array(
				'name' => __( 'Italian', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/it_IT.json',
			),
			'th_TH' => array(
				'name' => __( 'Thai (Thailand)', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/th_TH.json',
			),
			'fa_IR' => array(
				'name' => __( 'Persian - Iran', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/fa_IR.json',
			),
			'pl_P'  => array(
				'name' => __( 'Polish', 'publisher' ),
				'url'  => PUBLISHER_THEME_URI . 'includes/translations/pl_P.json',
			),
		);

		return $config;
	} // publisher_translations_config
}


/**
 * functions.php
 *---------------------------
 * This file contains general functions that used inside theme to
 * do important sections.
 *
 * We create them in a way that you can override them in child them simply!
 * Simply copy the function into child theme and remove the "if( ! function_exists( '*****' ) ){".
 */

/**
 * Callback: Enable oculus error logging system for theme
 * Filter  : better-framework/oculus/logger/filter
 *
 * @access private
 *
 * @param boolean $bool previous value
 * @param string  $product_dir
 * @param string  $type_dir
 *
 * @return bool true if error belongs to theme, previous value otherwise.
 */
function publisher_return_true_for_themes( $bool, $product_dir, $type_dir ) {
	if ( $type_dir === 'themes' ) {
		return FALSE;
	}

	return $bool;
}

add_filter( 'better-framework/oculus/logger/turn-off', 'publisher_return_true_for_themes', 22, 3 );

if ( ! function_exists( 'publisher_get_theme_panel_id' ) ) {
	/**
	 * Used to get theme panel id
	 *
	 * @return string
	 */
	function publisher_get_theme_panel_id() {
		return 'bs_' . 'publisher_theme_options';
	}
}

// Config demos
include $template_directory . 'includes/demos/init.php';

// Initialize styles
include $template_directory . 'includes/styles/init.php';


if ( ! function_exists( 'publisher_cat_main_slider_config' ) ) {
	/**
	 * Prepare main slider config
	 *
	 * @return array|mixed
	 */
	function publisher_cat_main_slider_config( $term_id = NULL ) {

		// return from cache
		if ( publisher_get_global( 'cat-slider-config' ) != NULL ) {
			return publisher_get_global( 'cat-slider-config' );
		}

		if ( is_null( $term_id ) ) {
			$term_id = get_queried_object()->term_id;
		}

		$config = array(
			'type'      => 'default',
			'style'     => 'default',
			'overlay'   => 'default',
			'show'      => FALSE,
			'in-column' => FALSE,
		);

		// get from current term
		if ( is_category() ) {
			$config['type'] = bf_get_term_meta( 'slider_type', $term_id );
		}

		// slider Type
		if ( $config['type'] == 'default' ) {
			$config['type'] = publisher_get_option( 'cat_slider' );
		}

		if ( ! publisher_is_valid_slider_type( $config['type'] ) ) {
			$config['type'] = 'disable';
		}

		switch ( $config['type'] ) {

			case 'disable':
				$config['style']     = 'disable';
				$config['directory'] = '';
				$config['file']      = '';
				$config['show']      = FALSE;
				$config['posts']     = 0;
				break;

			case 'custom-blocks':

				// get from current term
				if ( is_category() ) {
					$config['style']   = bf_get_term_meta( 'better_slider_style', $term_id );
					$config['overlay'] = bf_get_term_meta( 'better_slider_gradient', $term_id );
				}

				// Slider style
				if ( $config['style'] == 'default' ) {
					$config['style'] = publisher_get_option( 'cat_top_posts' );
				}

				// overlay
				if ( $config['overlay'] == 'default' ) {
					$config['overlay'] = publisher_get_option( 'cat_top_posts_gradient' );
				}

				// Validate it
				if ( ! publisher_is_valid_topposts_style( $config['style'] ) ) {
					$config['style'] = 'disable';
				}

				// Posts config
				switch ( $config['style'] ) {

					case 'style-1':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-1';
						$config['show']      = TRUE;
						$config['posts']     = 4;
						$config['in-column'] = FALSE;
						break;

					case 'style-2':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-1';
						$config['show']      = TRUE;
						$config['posts']     = 4;
						$config['in-column'] = TRUE;
						break;

					case 'style-3':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-2';
						$config['show']      = TRUE;
						$config['posts']     = 5;
						$config['in-column'] = FALSE;
						break;

					case 'style-4':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-2';
						$config['show']      = TRUE;
						$config['posts']     = 5;
						$config['in-column'] = TRUE;
						break;

					case 'style-5':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-3';
						$config['show']      = TRUE;
						$config['posts']     = 3;
						$config['columns']   = 3;
						$config['in-column'] = FALSE;
						break;

					case 'style-6':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-3';
						$config['show']      = TRUE;
						$config['posts']     = 2;
						$config['columns']   = 2;
						$config['in-column'] = TRUE;
						break;

					case 'style-7':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-4';
						$config['show']      = TRUE;
						$config['posts']     = 4;
						$config['columns']   = 4;
						$config['in-column'] = FALSE;
						break;

					case 'style-8':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-4';
						$config['show']      = TRUE;
						$config['posts']     = 3;
						$config['columns']   = 3;
						$config['in-column'] = TRUE;
						break;

					case 'style-9':
						$config['directory'] = 'shortcodes';
						$config['file']      = 'bs-slider-1';
						$config['show']      = TRUE;
						$config['posts']     = 3;
						$config['columns']   = '';
						$config['in-column'] = FALSE;
						break;

					case 'style-10':
						$config['directory'] = 'shortcodes';
						$config['file']      = 'bs-slider-1';
						$config['show']      = TRUE;
						$config['posts']     = 3;
						$config['columns']   = '';
						$config['in-column'] = TRUE;
						break;

					case 'style-11':
						$config['directory'] = 'shortcodes';
						$config['file']      = 'bs-slider-2';
						$config['show']      = TRUE;
						$config['posts']     = 3;
						$config['columns']   = '';
						$config['in-column'] = FALSE;
						break;

					case 'style-12':
						$config['directory'] = 'shortcodes';
						$config['file']      = 'bs-slider-2';
						$config['show']      = TRUE;
						$config['posts']     = 3;
						$config['columns']   = '';
						$config['in-column'] = TRUE;
						break;

					case 'style-13':
						$config['directory'] = 'shortcodes';
						$config['file']      = 'bs-slider-3';
						$config['show']      = TRUE;
						$config['posts']     = 3;
						$config['columns']   = '';
						$config['in-column'] = FALSE;
						break;

					case 'style-14':
						$config['directory'] = 'shortcodes';
						$config['file']      = 'bs-slider-3';
						$config['show']      = TRUE;
						$config['posts']     = 3;
						$config['columns']   = '';
						$config['in-column'] = TRUE;
						break;

					case 'style-15':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-5';
						$config['show']      = TRUE;
						$config['posts']     = 5;
						$config['columns']   = '';
						$config['in-column'] = FALSE;
						break;

					case 'style-16':
						$config['directory'] = 'loop';
						$config['file']      = 'listing-modern-grid-5';
						$config['show']      = TRUE;
						$config['posts']     = 3;
						$config['columns']   = '';
						$config['in-column'] = TRUE;
						break;

					default:
						$config['type']      = 'disable';
						$config['style']     = 'disable';
						$config['directory'] = '';
						$config['file']      = '';
						$config['show']      = FALSE;
						$config['posts']     = 0;

				}

				break;

			case 'rev_slider':

				// get from current term
				if ( is_category() ) {
					$config['style'] = bf_get_term_meta( 'rev_slider_item', $term_id, 'default' );
				}

				// Slider style
				if ( $config['style'] == 'default' || empty( $config['style'] ) ) {
					$config['style'] = publisher_get_option( 'cat_rev_slider_item' );
				}

				// determine show
				if ( ! empty( $config['style'] ) && function_exists( 'putRevSlider' ) ) {
					$config['show'] = TRUE;
				}

				$config['in-column'] = FALSE;

				break;
		}

		// Save it to cache
		publisher_set_global( 'cat-slider-config', $config );

		return $config;

	} // publisher_cat_main_slider_config

} // if


if ( ! function_exists( 'publisher_listing_social_share' ) ) {
	/**
	 * Prints listing share buttons
	 *
	 * @param   null   $label
	 * @param   string $class
	 * @param   bool   $show_title
	 */
	function publisher_listing_social_share( $label = NULL, $class = '', $show_title = FALSE ) {

		$sites = publisher_get_option( 'social_share_sites' );

		if ( is_null( $label ) ) {
			$label = '<i class="fa fa-share-alt"></i>';
		}

		?>
		<div class="post-share <?php echo esc_attr( $class ); ?>">

			<span class="share-handler"><?php echo wp_kses( $label, bf_trans_allowed_html() ); ?></span>

			<ul class="social-list clearfix">
				<?php

				foreach ( (array) $sites as $site_key => $site ) {
					if ( $site ) {
						echo publisher_shortcode_social_share_get_li( $site_key, $show_title );
					}
				}

				?>
			</ul>

		</div>
		<?php

	} // publisher_listing_social_share
} // publisher_listing_social_share


if ( ! function_exists( 'publisher_layout_option_list' ) ) {
	/**
	 * Panels layout field options
	 *
	 * @param bool $default
	 *
	 * @return array
	 */
	function publisher_layout_option_list( $default = FALSE ) {

		$option = array();

		if ( $default ) {
			$option['default'] = array(
				'img'   => bf_get_theme_uri( "images/options/layout-default.png" ),
				'label' => __( '-- Default --', 'publisher' ),
			);
		}

		$option['1-col']       = array(
			'img'   => bf_get_theme_uri( 'images/options/layout-1-col.png' ),
			'label' => __( 'Full Width', 'publisher' ),
		);
		$option['2-col-right'] = array(
			'img'   => bf_get_theme_uri( 'images/options/layout-2-col-right.png' ),
			'label' => __( 'Right Sidebar', 'publisher' ),
		);
		$option['2-col-left']  = array(
			'img'   => bf_get_theme_uri( 'images/options/layout-2-col-left.png' ),
			'label' => __( 'Left Sidebar', 'publisher' ),
		);

		return $option;
	} // publisher_layout_option_list
} // if


if ( ! function_exists( 'publisher_is_valid_layout' ) ) {
	/**
	 * Check the parameter is theme valid layout or not!
	 *
	 * This is because of multiple theme that have same page_layout id for page layout
	 *
	 * @param $layout
	 *
	 * @return bool
	 */
	function publisher_is_valid_layout( $layout ) {
		return in_array( $layout, array(
			'1-col',
			'2-col-left',
			'2-col-right',
		) );
	} // publisher_is_valid_layout
} // if


if ( ! function_exists( 'publisher_get_page_boxed_layout' ) ) {
	/**
	 * Used to get current page boxed layout
	 *
	 * @return bool|mixed|null|string|void
	 */
	function publisher_get_page_boxed_layout() {

		$layout = '';

		if ( is_category() ) {
			$layout = bf_get_term_meta( 'layout_style' );

			$bg_img = bf_get_term_meta( 'bg_image' );
			if ( ! empty( $bg_img['img'] ) ) {
				$layout = 'boxed';
			}
		}

		if ( empty( $layout ) || $layout == FALSE || $layout == 'default' ) {
			$layout = publisher_get_option( 'layout_style' );

			if ( $layout == 'full-width' ) {
				$bg_img = publisher_get_option( 'site_bg_image' );
				if ( ! empty( $bg_img['img'] ) ) {
					$layout = 'boxed';
				}
			}
		}

		return $layout;
	}
}


if ( ! function_exists( 'publisher_get_page_layout' ) ) {
	/**
	 * Used to get current page layout
	 *
	 * @return bool|mixed|null|string|void
	 */
	function publisher_get_page_layout() {

		// Return from cache
		if ( publisher_get_global( 'page-layout' ) ) {
			return publisher_get_global( 'page-layout' );
		}

		$layout = 'default';

		// Homepage layout
		if ( is_home() ) {
			$layout = publisher_get_option( 'home_layout' );
		} // Post Layout
		elseif ( is_singular( 'post' ) ) {
			$layout = bf_get_post_meta( 'page_layout' );

			if ( $layout == 'default' ) {
				$layout = publisher_get_option( 'post_layout' );
			}
		} // Page Layout
		elseif ( is_page() ) {
			$layout = bf_get_post_meta( 'page_layout' );

			if ( $layout == 'default' ) {
				$layout = publisher_get_option( 'page_layout' );
			}
		} // Category Layout
		elseif ( is_category() ) {
			$layout = bf_get_term_meta( 'page_layout' );

			if ( $layout == 'default' ) {
				$layout = publisher_get_option( 'cat_layout' );
			}
		} // Tag Layout
		elseif ( is_tag() ) {
			$layout = bf_get_term_meta( 'page_layout' );

			if ( $layout == 'default' ) {
				$layout = publisher_get_option( 'tag_layout' );
			}
		} // Author Layout
		elseif ( is_author() ) {
			$layout = bf_get_user_meta( 'page_layout' );

			if ( $layout == 'default' ) {
				$layout = publisher_get_option( 'author_layout' );
			}
		} // Search Layout
		elseif ( is_search() ) {
			$layout = publisher_get_option( 'search_layout' );
		} // bbPress Layout
		elseif ( is_post_type_archive( 'forum' ) || is_singular( 'forum' ) || is_singular( 'topic' ) ) {
			$layout = publisher_get_option( 'bbpress_layout' );
		} // Attachments
		elseif ( is_attachment() ) {
			$layout = publisher_get_option( 'attachment_layout' );
		} // WooCommerce
		elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {

			if ( is_shop() ) {
				$layout = bf_get_post_meta( 'page_layout', wc_get_page_id( 'shop' ) );
			} elseif ( is_product() ) {
				$layout = bf_get_post_meta( 'page_layout', get_the_ID() );
			} elseif ( is_cart() ) {
				$layout = bf_get_post_meta( 'page_layout', wc_get_page_id( 'cart' ) );
			} elseif ( is_checkout() ) {
				$layout = bf_get_post_meta( 'page_layout', wc_get_page_id( 'checkout' ) );
			} elseif ( is_account_page() ) {
				$layout = bf_get_post_meta( 'page_layout', wc_get_page_id( 'myaccount' ) );
			} elseif ( is_product_category() || is_product_tag() ) {
				$layout = bf_get_term_meta( 'page_layout', get_queried_object()->term_id );
			}

			if ( $layout == 'default' ) {
				$layout = publisher_get_option( 'shop_layout' );
			}

		}


		// Return default
		if ( $layout == 'default' || ! publisher_is_valid_layout( $layout ) ) {
			$layout = publisher_get_option( 'general_layout' );
		}

		// Cache
		publisher_set_global( 'page-layout', $layout );

		return $layout;

	} // publisher_get_page_layout
}// if


if ( ! function_exists( 'publisher_listing_option_list' ) ) {
	/**
	 * Panels posts listing field option
	 *
	 * @param bool $default
	 *
	 * @return array
	 */
	function publisher_listing_option_list( $default = FALSE ) {

		$option = array();

		if ( $default ) {
			$option['default'] = array(
				'img'   => bf_get_theme_uri( 'images/options/listing-default.png' ),
				'label' => __( '-- Default --', 'publisher' ),
			);
		}

		$option['grid-1']    = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-grid-1.png' ),
			'label' => __( 'Grid 1', 'publisher' ),
		);
		$option['grid-1-3']  = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-grid-1-3.png' ),
			'label' => __( 'Grid 1 - 3 Column', 'publisher' ),
		);
		$option['grid-2']    = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-grid-2.png' ),
			'label' => __( 'Grid 2', 'publisher' ),
		);
		$option['grid-2-3']  = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-grid-2-3.png' ),
			'label' => __( 'Grid 2 - 3 Column', 'publisher' ),
		);
		$option['blog-1']    = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-blog-1.png' ),
			'label' => __( 'Blog 1', 'publisher' ),
		);
		$option['blog-2']    = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-blog-2.png' ),
			'label' => __( 'Blog 2', 'publisher' ),
		);
		$option['blog-3']    = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-blog-3.png' ),
			'label' => __( 'Blog 3', 'publisher' ),
		);
		$option['blog-4']    = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-blog-4.png' ),
			'label' => __( 'Blog 4', 'publisher' ),
		);
		$option['blog-5']    = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-blog-5.png' ),
			'label' => __( 'Blog 5', 'publisher' ),
		);
		$option['classic-1'] = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-classic-1.png' ),
			'label' => __( 'Classic 1', 'publisher' ),
		);
		$option['classic-2'] = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-classic-2.png' ),
			'label' => __( 'Classic 2', 'publisher' ),
		);
		$option['classic-3'] = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-classic-3.png' ),
			'label' => __( 'Classic 3', 'publisher' ),
		);
		$option['tall-1']    = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-tall-1.png' ),
			'label' => __( 'Tall 1', 'publisher' ),
		);
		$option['tall-1-4']  = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-tall-1-4.png' ),
			'label' => __( 'Tall 1 - 4 Column', 'publisher' ),
		);
		$option['tall-2']    = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-tall-2.png' ),
			'label' => __( 'Tall 2', 'publisher' ),
		);
		$option['tall-2-4']  = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-tall-2-4.png' ),
			'label' => __( 'Tall 2 - 4 Column', 'publisher' ),
		);
		$option['mix-4-1']   = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-mix-4-1.png' ),
			'label' => __( 'Mix 10', 'publisher' ),
		);
		$option['mix-4-2']   = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-mix-4-2.png' ),
			'label' => __( 'Mix 11', 'publisher' ),
		);
		$option['mix-4-3']   = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-mix-4-3.png' ),
			'label' => __( 'Mix 12', 'publisher' ),
		);
		$option['mix-4-4']   = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-mix-4-4.png' ),
			'label' => __( 'Mix 13', 'publisher' ),
		);
		$option['mix-4-5']   = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-mix-4-5.png' ),
			'label' => __( 'Mix 14', 'publisher' ),
		);
		$option['mix-4-6']   = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-mix-4-6.png' ),
			'label' => __( 'Mix 15', 'publisher' ),
		);
		$option['mix-4-7']   = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-mix-4-7.png' ),
			'label' => __( 'Mix 16', 'publisher' ),
		);
		$option['mix-4-8']   = array(
			'img'   => bf_get_theme_uri( 'images/options/listing-mix-4-8.png' ),
			'label' => __( 'Mix 17', 'publisher' ),
		);

		return $option;
	} // publisher_listing_option_list
} // if


if ( ! function_exists( 'publisher_is_valid_listing' ) ) {
	/**
	 * Checks parameter to be a theme valid listing
	 *
	 * @param $listing
	 *
	 * @return bool
	 */
	function publisher_is_valid_listing( $listing ) {
		return array_key_exists( $listing, publisher_listing_option_list() );
	} // publisher_is_valid_listing

} // if


if ( ! function_exists( 'publisher_get_page_listing' ) ) {
	/**
	 * Used to get current page posts listing
	 *
	 * @param WP_Query|null $wp_query
	 *
	 * @return mixed|string
	 */
	function publisher_get_page_listing( $wp_query = NULL ) {

		if ( is_null( $wp_query ) ) {
			$wp_query = publisher_get_query();
		}

		// Return from cache
		if ( publisher_get_global( 'page-listing' ) ) {
			return publisher_get_global( 'page-listing' );
		}

		$listing = 'default';

		// Homepage listing
		if ( $wp_query->is_home ) {
			$listing = publisher_get_option( 'home_listing' );
		} // Category Layout
		elseif ( $wp_query->is_category ) {

			$listing = bf_get_term_meta( 'page_listing', $wp_query->get_queried_object_id() );

			if ( $listing == 'default' ) {
				$listing = publisher_get_option( 'cat_listing' );
			}
		} // Tag Layout
		elseif ( $wp_query->is_tag ) {
			$listing = bf_get_term_meta( 'page_listing', $wp_query->get_queried_object_id() );

			if ( $listing == 'default' ) {
				$listing = publisher_get_option( 'tag_listing' );
			}
		} // Author Layout
		elseif ( $wp_query->is_author ) {
			$listing = bf_get_user_meta( 'page_listing', $wp_query->get_queried_object() );

			if ( $listing == 'default' ) {
				$listing = publisher_get_option( 'author_listing' );
			}
		} // Search Layout
		elseif ( $wp_query->is_search ) {
			$listing = publisher_get_option( 'search_listing' );
		}


		// check to be valid theme listing or use default
		if ( $listing == 'default' || ! publisher_is_valid_listing( $listing ) ) {
			$listing = publisher_get_option( 'general_listing' );
		}

		switch ( $listing ) {

			case 'grid-1';
				publisher_set_prop( 'listing-class', 'columns-2' );
				break;

			case 'grid-1-3';
				publisher_set_prop( 'listing-class', 'columns-3' );
				$listing = 'grid-1';
				break;

			case 'grid-2';
				publisher_set_prop( 'listing-class', 'columns-2' );
				break;

			case 'grid-2-3';
				publisher_set_prop( 'listing-class', 'columns-3' );
				$listing = 'grid-2';
				break;

			case 'tall-1';
				publisher_set_prop( 'listing-class', 'columns-3' );
				break;

			case 'tall-1-4';
				publisher_set_prop( 'listing-class', 'columns-4' );
				$listing = 'tall-1';
				break;

			case 'tall-2';
				publisher_set_prop( 'listing-class', 'columns-3' );
				break;

			case 'tall-2-4';
				publisher_set_prop( 'listing-class', 'columns-4' );
				$listing = 'tall-2';
				break;

		}

		// Cache
		publisher_set_global( 'page-listing', 'listing-' . $listing );

		return 'listing-' . $listing;

	} // publisher_get_page_listing
} // if


if ( ! function_exists( 'publisher_pagination_option_list' ) ) {
	/**
	 * Panels archives pagination field options
	 *
	 * @param bool $default
	 *
	 * @return array
	 */
	function publisher_pagination_option_list( $default = FALSE ) {

		$option = array();

		if ( $default ) {
			$option['default'] = __( '-- Default pagination --', 'publisher' );
		}

		// simple paginations
		$option['numbered'] = __( 'Numbered pagination buttons', 'publisher' );
		$option['links']    = __( 'Newer & Older buttons', 'publisher' );

		// advanced ajax pagination
		$option['ajax_next_prev']         = __( 'Ajax - Next Prev buttons', 'publisher' );
		$option['ajax_more_btn']          = __( 'Ajax - Load more button', 'publisher' );
		$option['ajax_more_btn_infinity'] = __( 'Ajax - Load more button + Infinity loading', 'publisher' );
		$option['ajax_infinity']          = __( 'Ajax - Infinity loading', 'publisher' );

		return $option;

	} // publisher_pagination_option_list
} // if


if ( ! function_exists( 'publisher_is_valid_pagination' ) ) {
	/**
	 * Checks parameter to be a theme valid pagination
	 *
	 * @param $pagination
	 *
	 * @return bool
	 */
	function publisher_is_valid_pagination( $pagination ) {
		return array_key_exists( $pagination, publisher_pagination_option_list() );
	} // publisher_is_valid_pagination
} // if


if ( ! function_exists( 'publisher_get_pagination_style' ) ) {
	/**
	 * Used to get current page pagination style
	 */
	function publisher_get_pagination_style() {

		// Return from cache
		if ( publisher_get_global( 'page-pagination' ) ) {
			return publisher_get_global( 'page-pagination' );
		}

		$pagination = 'default';

		$paged = bf_get_query_var_paged();

		// Homepage pagination
		if ( is_home() ) {
			$pagination = publisher_get_option( 'home_pagination_type' );
		} // Categories pagination
		elseif ( is_category() ) {

			$pagination = bf_get_term_meta( 'term_pagination_type' );

			if ( $pagination == 'default' ) {
				$pagination = publisher_get_option( 'cat_pagination_type' );
			}

		} // Tags pagination
		elseif ( is_tag() ) {

			$pagination = bf_get_term_meta( 'term_pagination_type' );

			if ( $pagination == 'default' ) {
				$pagination = publisher_get_option( 'tag_pagination_type' );
			}

		} // Author pagination
		elseif ( is_author() ) {
			$pagination = bf_get_user_meta( 'author_pagination_type' );

			if ( $pagination == 'default' ) {
				$pagination = publisher_get_option( 'author_pagination_type' );
			}
		} // Search page pagination
		elseif ( is_search() ) {
			$pagination = publisher_get_option( 'search_pagination_type' );
		}

		// fix for when request is from robots,
		// e.g. user agent: 'Mozilla/5.0 (compatible; YandexBot/3.0; +http://yandex.com/bots)'
		// fix for when paged and is ajax pagination then it should show simple numbered pagination
		if (
			( $paged > 1 && in_array( $pagination, array(
					'ajax_infinity',
					'ajax_more_btn',
					'ajax_next_prev',
					'ajax_more_btn_infinity'
				) ) ) ||
			( bf_is_crawler() && in_array( $pagination, array(
					'ajax_infinity',
					'ajax_more_btn',
					'ajax_next_prev',
					'ajax_more_btn_infinity'
				) ) )
		) {
			$pagination = 'numbered';
		}

		// get default pagination
		if ( $pagination == 'default' ) {
			$pagination = publisher_get_option( 'pagination_type' );
		}

		// check to be valid theme pagination
		if ( ! publisher_is_valid_pagination( $pagination ) ) {
			$pagination = key( publisher_pagination_option_list() );
		}

		// Cache
		publisher_set_global( 'page-pagination', $pagination );

		return $pagination;

	} // publisher_get_pagination_style
}


if ( ! function_exists( 'publisher_header_style_option_list' ) ) {
	/**
	 * Panels header style field options
	 *
	 * @param bool $default
	 *
	 * @return array
	 */
	function publisher_header_style_option_list( $default = FALSE ) {

		$option = array();

		if ( $default ) {
			$option['default'] = array(
				'img'   => bf_get_theme_uri( 'images/options/header-default.png' ),
				'label' => __( '-- Default --', 'publisher' ),
			);
		}

		$option['style-1'] = array(
			'img'   => bf_get_theme_uri( 'images/options/header-style-1.png' ),
			'label' => __( 'Style 1', 'publisher' ),
		);
		$option['style-2'] = array(
			'img'   => bf_get_theme_uri( 'images/options/header-style-2.png' ),
			'label' => __( 'Style 2', 'publisher' ),
		);
		$option['style-3'] = array(
			'img'   => bf_get_theme_uri( 'images/options/header-style-3.png' ),
			'label' => __( 'Style 3', 'publisher' ),
		);
		$option['style-4'] = array(
			'img'   => bf_get_theme_uri( 'images/options/header-style-4.png' ),
			'label' => __( 'Style 4', 'publisher' ),
		);
		$option['style-5'] = array(
			'img'   => bf_get_theme_uri( 'images/options/header-style-5.png' ),
			'label' => __( 'Style 5', 'publisher' ),
		);
		$option['style-6'] = array(
			'img'   => bf_get_theme_uri( 'images/options/header-style-6.png' ),
			'label' => __( 'Style 6', 'publisher' ),
		);
		$option['style-7'] = array(
			'img'   => bf_get_theme_uri( 'images/options/header-style-7.png' ),
			'label' => __( 'Style 7', 'publisher' ),
		);
		$option['style-8'] = array(
			'img'   => bf_get_theme_uri( 'images/options/header-style-8.png' ),
			'label' => __( 'Style 8', 'publisher' ),
		);


		return $option;
	} // publisher_header_style_option_list
} // if


if ( ! function_exists( 'publisher_topposts_option_list' ) ) {
	/**
	 * Panels category toposts field options
	 *
	 * @param bool $default
	 *
	 * @return array
	 */
	function publisher_topposts_option_list( $default = FALSE ) {

		$option = array();

		if ( $default ) {
			$option['default'] = array(
				'img'   => bf_get_theme_uri( 'images/options/cat-slider-default.png' ),
				'label' => __( '-- Default --', 'publisher' ),
			);
		}

		$option['style-1']  = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-1.png' ),
			'label' => __( 'Style 1', 'publisher' ),
		);
		$option['style-2']  = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-2.png' ),
			'label' => __( 'Style 2', 'publisher' ),
		);
		$option['style-3']  = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-3.png' ),
			'label' => __( 'Style 3', 'publisher' ),
		);
		$option['style-4']  = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-4.png' ),
			'label' => __( 'Style 4', 'publisher' ),
		);
		$option['style-5']  = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-5.png' ),
			'label' => __( 'Style 5', 'publisher' ),
		);
		$option['style-6']  = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-6.png' ),
			'label' => __( 'Style 6', 'publisher' ),
		);
		$option['style-7']  = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-7.png' ),
			'label' => __( 'Style 7', 'publisher' ),
		);
		$option['style-8']  = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-8.png' ),
			'label' => __( 'Style 8', 'publisher' ),
		);
		$option['style-9']  = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-9.png' ),
			'label' => __( 'Style 9', 'publisher' ),
		);
		$option['style-10'] = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-10.png' ),
			'label' => __( 'Style 10', 'publisher' ),
		);
		$option['style-11'] = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-11.png' ),
			'label' => __( 'Style 11', 'publisher' ),
		);
		$option['style-12'] = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-12.png' ),
			'label' => __( 'Style 12', 'publisher' ),
		);
		$option['style-13'] = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-13.png' ),
			'label' => __( 'Style 13', 'publisher' ),
		);
		$option['style-14'] = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-14.png' ),
			'label' => __( 'Style 14', 'publisher' ),
		);
		$option['style-15'] = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-15.png' ),
			'label' => __( 'Style 15', 'publisher' ),
		);
		$option['style-16'] = array(
			'img'   => bf_get_theme_uri( 'images/options/cat-slider-style-16.png' ),
			'label' => __( 'Style 16', 'publisher' ),
		);


		return $option;
	} // publisher_topposts_option_list
} // if


if ( ! function_exists( 'publisher_is_valid_topposts_style' ) ) {
	/**
	 * Check the parameter is theme valid topposts style
	 *
	 * @param $layout
	 *
	 * @return bool
	 */
	function publisher_is_valid_topposts_style( $layout ) {
		return array_key_exists( $layout, publisher_topposts_option_list() );
	} // publisher_is_valid_topposts_style
} // if


if ( ! function_exists( 'publisher_slider_types_option_list' ) ) {
	/**
	 * Panels category slider field options
	 *
	 * @param bool $default
	 *
	 * @return array
	 */
	function publisher_slider_types_option_list( $default = FALSE ) {

		$option = array();

		if ( $default ) {
			$option['default'] = __( '-- Default --', 'publisher' );
		}

		$option['disable']       = __( 'Disabled', 'publisher' );
		$option['custom-blocks'] = __( 'Top posts', 'publisher' );
		$option['rev_slider']    = __( 'Slider Revolution', 'publisher' );

		return $option;
	} // publisher_slider_types_option_list
} // if


if ( ! function_exists( 'publisher_is_valid_slider_type' ) ) {
	/**
	 * Check the parameter is theme valid slider type
	 *
	 * @param $layout
	 *
	 * @return bool
	 */
	function publisher_is_valid_slider_type( $layout ) {
		return array_key_exists( $layout, publisher_slider_types_option_list() );
	} // publisher_is_valid_slider_type
} // if


if ( ! function_exists( 'publisher_get_header_style' ) ) {
	/**
	 * Used to get current page header style
	 *
	 * @return bool|mixed|null|string
	 */
	function publisher_get_header_style() {

		$style = 'default';

		if ( is_category() ) {
			$style = bf_get_term_meta( 'header_style' );
		} elseif ( is_singular( 'page' ) ) {
			$style = bf_get_post_meta( 'header_style' );;
		}

		if ( $style == 'default' || ! publisher_is_valid_header_style( $style ) ) {
			$style = publisher_get_option( 'header_style' );
		}

		return $style;

	} // publisher_get_header_style
} // if


if ( ! function_exists( 'publisher_is_valid_header_style' ) ) {
	/**
	 * Check the parameter is theme valid layout or not!
	 *
	 * This is because of multiple theme that have same header_style id for page headers
	 *
	 * @param $layout
	 *
	 * @return bool
	 */
	function publisher_is_valid_header_style( $layout ) {
		return array_key_exists( $layout, publisher_header_style_option_list() );
	} // publisher_is_valid_header_style
} // if


if ( ! function_exists( 'publisher_get_header_layout' ) ) {
	/**
	 * Returns header layout for current page
	 *
	 * @return bool
	 */
	function publisher_get_header_layout() {

		// Return from cache
		if ( publisher_get_global( 'header-layout' ) ) {
			return publisher_get_global( 'header-layout' );
		}

		$layout = 'default';

		if ( is_category() ) {
			$layout = bf_get_term_meta( 'header_layout' );
		} elseif ( is_singular( 'page' ) ) {
			$layout = bf_get_post_meta( 'header_layout' );
		}

		if ( $layout == 'default' ) {
			$layout = publisher_get_option( 'header_layout' );
		}

		// Cache
		publisher_set_global( 'header-layout', $layout );

		return $layout;

	} // publisher_get_header_layout
}


// Add filter for VC elements add-on
add_filter( 'better-framework/shortcodes/title', 'publisher_bf_shortcodes_title' );

if ( ! function_exists( 'publisher_bf_shortcodes_title' ) ) {
	/**
	 * Filter For Generating BetterFramework Shortcodes Title
	 *
	 * @param $atts
	 *
	 * @return mixed
	 */
	function publisher_bf_shortcodes_title( $atts ) {

		// Icon
		if ( ! empty( $atts['icon'] ) ) {
			$icon = bf_get_icon_tag( $atts['icon'] ) . ' ';
		} else {
			$icon = '';
		}

		// Title link
		if ( ! empty( $atts['title_link'] ) ) {
			$link = $atts['title_link'];
		} elseif ( ! empty( $atts['category'] ) ) {
			$link = get_category_link( $atts['category'] );
			if ( empty( $atts['title'] ) ) {
				$cat           = get_category( $atts['category'] );
				$atts['title'] = $cat->name;
			}
		} elseif ( ! empty( $atts['tag'] ) ) {
			$link = get_tag_link( $atts['tag'] );
			if ( empty( $atts['title'] ) ) {
				$tag           = get_tag( $atts['tag'] );
				$atts['title'] = $tag->name;
			}
		} else {
			$link = '';
		}

		if ( empty( $atts['title'] ) ) {
			$atts['title'] = publisher_translation_get( 'recent_posts' );
		}

		?>
		<h3 class="section-heading">
			<?php if ( ! empty( $link ) ){ ?>
			<a href="<?php echo esc_url( $link ); ?>">
				<?php } ?>
				<span class="h-text"><?php echo $icon . esc_html( $atts['title'] ); // $icon escaped before ?></span>
				<?php if ( ! empty( $link ) ){ ?>
			</a>
		<?php } ?>
		</h3>
		<?php
	}
} // if


if ( ! function_exists( 'publisher_block_create_query_args' ) ) {
	/**
	 * Handy function to create master listing query args
	 *
	 * todo remove this!
	 *
	 * @param $$atts
	 *
	 * @return bool
	 */
	function publisher_block_create_query_args( &$atts ) {

		$args = array(
			'post_type' => array( 'post' ),
			'order'     => $atts['order'],
			'orderby'   => $atts['order_by'],
		);

		// Category
		if ( ! empty( $atts['category'] ) ) {
			$args['cat'] = $atts['category'];
		}

		// Tag
		if ( $atts['tag'] ) {
			$args['tag__and'] = explode( ',', $atts['tag'] );
		}

		// Post id filters
		if ( ! empty( $atts['post_ids'] ) ) {

			$post_id_array = explode( ',', $atts['post_ids'] );
			$post_in       = array();
			$post_not_in   = array();

			// Split ids into post_in and post_not_in
			foreach ( $post_id_array as $post_id ) {

				$post_id = trim( $post_id );

				if ( is_numeric( $post_id ) ) {
					if ( intval( $post_id ) < 0 ) {
						$post_not_in[] = str_replace( '-', '', $post_id );
					} else {
						$post_in[] = $post_id;
					}
				}
			}

			if ( ! empty( $post_not_in ) ) {
				$wp_query_args['post__not_in'] = $post_not_in;
			}

			if ( ! empty( $post_in ) ) {
				$args['post__in'] = $post_in;
				$args['orderby']  = 'post__in';
			}
		}


		// Custom post types
		if ( $atts['post_type'] ) {
			$args['post_type'] = explode( ',', $atts['post_type'] );
		}

		if ( ! empty( $atts['count'] ) && intval( $atts['count'] ) > 0 ) {
			$args['posts_per_page'] = $atts['count'];
		} else {
			switch ( $atts['style'] ) {

				//
				// Grid Listing
				//
				case 'listing-grid':

					switch ( $atts['columns'] ) {

						case 1:
							$args['posts_per_page'] = 4;
							break;

						case 2:
							$args['posts_per_page'] = 4;
							break;

						case 3:
							$args['posts_per_page'] = 6;
							break;

						case 4:
							$args['posts_per_page'] = 8;
							break;

						default:
							$args['posts_per_page'] = 6;
							break;

					}
					break;

				//
				// Thumbnail Listing 1
				//
				case 'listing-thumbnail-1':
					switch ( $atts['columns'] ) {

						case 1:
							$args['posts_per_page'] = 4;
							break;

						case 2:
							$args['posts_per_page'] = 6;
							break;

						case 3:
							$args['posts_per_page'] = 9;
							break;

						case 4:
							$args['posts_per_page'] = 12;
							break;

						default:
							$args['posts_per_page'] = 6;
							break;
					}
					break;

				//
				// Thumbnail Listing 2
				//
				case 'listing-thumbnail-2':
					$args['posts_per_page'] = 4;
					break;


				//
				// Blog Listing
				//
				case 'listing-blog':
					switch ( $atts['columns'] ) {

						case 1:
							$args['posts_per_page'] = 4;
							break;

						case 2:
							$args['posts_per_page'] = 6;
							break;

						case 3:
							$args['posts_per_page'] = 9;
							break;

						case 4:
							$args['posts_per_page'] = 12;
							break;


						default:
							$args['posts_per_page'] = 6;
							break;
					}
					break;


				//
				// mix Listing
				//
				case 'listing-mix-1-1':
					$args['posts_per_page'] = 5;
					break;
				case 'listing-mix-1-2':
					$args['posts_per_page'] = 5;
					break;
				case 'listing-mix-1-3':
					$args['posts_per_page'] = 7;
					break;
				case 'listing-mix-2-1':
					$args['posts_per_page'] = 8;
					break;
				case 'listing-mix-2-2':
					$args['posts_per_page'] = 10;
					break;
				case 'listing-mix-3-1':
					$args['posts_per_page'] = 4;
					break;
				case 'listing-mix-3-2':
					$args['posts_per_page'] = 5;
					break;
				case 'listing-mix-3-3':
					$args['posts_per_page'] = 5;
					break;


				//
				// Text Listing 1
				//
				case 'listing-text-1':
					switch ( $atts['columns'] ) {

						case 1:
							$args['posts_per_page'] = 3;
							break;

						case 2:
							$args['posts_per_page'] = 6;
							break;

						case 3:
							$args['posts_per_page'] = 9;
							break;

						case 4:
							$args['posts_per_page'] = 12;
							break;

						default:
							$args['posts_per_page'] = 3;
							break;
					}
					break;

				//
				// Text Listing 2
				//
				case 'listing-text-2':
					switch ( $atts['columns'] ) {

						case 1:
							$args['posts_per_page'] = 4;
							break;

						case 2:
							$args['posts_per_page'] = 8;
							break;

						case 3:
							$args['posts_per_page'] = 12;
							break;

						case 4:
							$args['posts_per_page'] = 16;
							break;

						default:
							$args['posts_per_page'] = 4;
							break;
					}
					break;


				//
				// Modern Grid Listing
				//
				case 'modern-grid-listing-1':
					$args['posts_per_page'] = 4;
					break;

				case 'modern-grid-listing-2':
					$args['posts_per_page'] = 5;
					break;

				case 'modern-grid-listing-3':
					$args['posts_per_page'] = 3;
					break;


				default:
					$args['posts_per_page'] = 6;
			}
		}


		/*

		compatibility for better reviews

		if( $atts['order_by'] == 'reviews' ){
			$args['orderby'] = 'date';
			$args['meta_key'] = '_bs_review_enabled';
			$args['meta_value'] = '1';
		}

		*/

		// Order by views count
		if ( $atts['order_by'] == 'views' ) {
			$args['meta_key'] = 'better-views-count';
			$args['orderby']  = 'meta_value_num';
		}

		// Time filter
		if ( $atts['time_filter'] != '' ) {
			$args['date_query'] = publisher_get_time_filter_query( $atts['time_filter'] );
		}

		return $args;
	}
}


if ( ! function_exists( 'publisher_block_create_tabs' ) ) {
	/**
	 * Handy function to create master listing tabs
	 *
	 * @param $atts
	 *
	 * todo check time filter and order by
	 *
	 * @return array
	 */
	function publisher_block_create_tabs( &$atts ) {

		// 1. collect all tabs array
		// 2. chose to be tab or single column
		// 3. print it
		$tabs = array();

		$active = TRUE; // flag to identify the main tab


		//
		// First tab ( main )
		//
		if ( ! empty( $atts['category'] ) ) {

			$cat = get_category( $atts['category'] );

			// is valid category
			if ( $cat && ! is_wp_error( $cat ) ) {

				if ( empty( $atts['title'] ) ) {
					$atts['title'] = $cat->name;
				}

				// Icon
				if ( ! empty( $atts['icon'] ) ) {
					$icon = bf_get_icon_tag( $atts['icon'] ) . ' ';
				} else {
					$icon = '';
				}

				$tabs[] = array(
					'title'   => $atts['title'],
					'link'    => get_category_link( $atts['category'] ),
					'type'    => 'category',
					'term_id' => $atts['category'],
					'id'      => 'tab-' . rand( 1, 9999999 ),
					'icon'    => $icon,
					'class'   => 'main-term-' . $atts['category'],
					'active'  => $active,
				);

				$active = FALSE; // only one active

			} // not valid category -> default tab
			else {

				$tabs[] = publisher_block_create_tabs_default_tab( $atts, $active );

				$active = FALSE; // only one active

			}

		} elseif ( ! empty( $atts['tag'] ) ) {

			$tags = explode( ',', $atts['tag'] );

			$tag = FALSE;

			foreach ( $tags as $_tag ) {
				$tag = get_tag( $_tag );
				if ( $tag && ! is_wp_error( $tag ) ) {
					break;
				}
			}

			if ( $tag && ! is_wp_error( $tag ) ) {

				if ( empty( $atts['title'] ) ) {
					$atts['title'] = $tag->name;
				}

				// Icon
				if ( ! empty( $atts['icon'] ) ) {
					$icon = bf_get_icon_tag( $atts['icon'] ) . ' ';
				} else {
					$icon = '';
				}

				$tabs[] = array(
					'title'   => $atts['title'],
					'link'    => get_tag_link( $tag->term_id ),
					'type'    => 'tag',
					'term_id' => $tag->term_id,
					'id'      => 'tab-' . rand( 1, 9999999 ),
					'icon'    => $icon,
					'class'   => 'main-term-none',
					'active'  => $active,
				);

				$active = FALSE; // only one active

			} // not valid tag -> default tab
			else {

				$tabs[] = publisher_block_create_tabs_default_tab( $atts, $active );

				$active = FALSE; // only one active

			}

		} // default tab
		else {

			$tabs[] = publisher_block_create_tabs_default_tab( $atts, $active );

			$active = FALSE; // only one active

		}

		// not return other tabs if they will not shown!
		if ( ( ! empty( $atts['hide_title'] ) && $atts['hide_title'] ) ||
		     ( ! empty( $atts['show_title'] ) && ! $atts['show_title'] )
		) {
			return $tabs;
		}

		//
		// Other Tabs
		//
		if ( isset( $atts['tabs'] ) && ! empty( $atts['tabs'] ) ) {

			switch ( $atts['tabs'] ) {

				//
				// Category tabs
				//
				case 'cat_filter':

					if ( empty( $atts['tabs_cat_filter'] ) ) {
						break;
					} else if ( is_string( $atts['tabs_cat_filter'] ) ) {
						$atts['tabs_cat_filter'] = explode( ',', $atts['tabs_cat_filter'] );
					}


					foreach ( $atts['tabs_cat_filter'] as $term_id ) {

						$_term = get_category( $term_id );

						if ( ! is_object( $_term ) || is_wp_error( $_term ) ) {
							continue;
						}

						$tabs[] = array(
							'title'   => $_term->name,
							'link'    => get_category_link( $term_id ),
							'type'    => 'category',
							'term_id' => $term_id,
							'id'      => 'tab-' . rand( 1, 9999999 ),
							'icon'    => '',
							'class'   => 'main-term-' . $term_id,
							'active'  => $active,
						);

						// only one active
						if ( $active ) {
							$active = FALSE;
						}

					}

					break;

				case 'sub_cat_filter':

					if ( ! empty( $atts['category'] ) ) {

						$cat = get_category( $atts['category'] );

						if ( ! is_object( $cat ) || is_wp_error( $cat ) ) {
							continue;
						}

						$categories = get_categories( array( 'child_of' => $cat->term_id, 'number' => 20 ) );

						foreach ( $categories as $_cat ) {

							$tabs[] = array(
								'title'   => $_cat->name,
								'link'    => get_category_link( $_cat ),
								'type'    => 'category',
								'term_id' => $_cat->term_id,
								'id'      => 'tab-' . rand( 1, 9999999 ),
								'icon'    => '',
								'class'   => 'main-term-' . $_cat->term_id,
								'active'  => $active,
							);

							// only one active
							if ( $active ) {
								$active = FALSE;
							}
						}
					}

					break;

			}

		}

		return $tabs;
	} // publisher_block_create_tabs
}

if ( ! function_exists( 'publisher_block_create_tabs_default_tab' ) ) {
	/**
	 * Handy internal function to get default tab from atts
	 *
	 * @param      $atts
	 * @param bool $active
	 *
	 * @return array
	 */
	function publisher_block_create_tabs_default_tab( &$atts, $active = TRUE ) {

		if ( empty( $atts['title'] ) ) {
			$atts['title'] = publisher_translation_get( 'recent_posts' );
		}

		// Icon
		if ( ! empty( $atts['icon'] ) ) {
			$icon = bf_get_icon_tag( $atts['icon'] ) . ' ';
		} else {
			$icon = '';
		}

		return array(
			'title'   => $atts['title'],
			'link'    => '',
			'type'    => 'custom',
			'term_id' => '',
			'id'      => 'tab-' . rand( 1, 9999999 ),
			'icon'    => $icon,
			'class'   => 'main-term-none',
			'active'  => $active,
		);

	}
}

if ( ! function_exists( 'publisher_block_the_heading' ) ) {
	/**
	 * Handy function to create master listing tabs
	 *
	 * @param   $tabs
	 * @param   $multi_tab
	 *
	 * @return  bool
	 */
	function publisher_block_the_heading( &$atts, &$tabs, $multi_tab = FALSE ) {

		$show_title = TRUE;

		if ( ! Better_Framework::widget_manager()->get_current_sidebar() ) {

			if ( ! empty( $atts['hide_title'] ) && $atts['hide_title'] ) {
				$show_title = FALSE;
			}

			if ( ! empty( $atts['show_title'] ) && ! $atts['show_title'] ) {
				$show_title = FALSE;
			}

		}

		if ( $show_title ) { ?>
			<h3 class="section-heading <?php

			echo esc_attr( $tabs[0]['class'] );

			if ( ! empty( $atts['deferred_load_tabs'] ) ) {
				echo esc_attr( ' bs-deferred-tabs' );
			}

			if ( $multi_tab ) {
				echo esc_attr( ' multi-tab' );
			}

			?>">

				<?php if ( ! $multi_tab ) { ?>

					<?php if ( ! empty( $tabs[0]['link'] ) ) { ?>
						<a href="<?php echo esc_url( $tabs[0]['link'] ); ?>" class="main-link">
							<span
								class="h-text <?php echo esc_attr( $tabs[0]['class'] ); ?>"><?php echo $tabs[0]['icon'], esc_html( $tabs[0]['title'] ); // icon escaped before ?></span>
						</a>
					<?php } else { ?>
						<span
							class="h-text <?php echo esc_attr( $tabs[0]['class'] ); ?> main-link"><?php echo $tabs[0]['icon'], esc_html( $tabs[0]['title'] ); // icon escaped before ?></span>
					<?php } ?>

				<?php } else { ?>

					<?php foreach ( (array) $tabs as $tab ) { ?>
						<a href="#<?php echo esc_attr( $tab['id'] ) ?>" data-toggle="tab"
						   aria-expanded="<?php echo $tab['active'] ? 'true' : 'false'; ?>"
						   class="<?php echo $tab['active'] ? 'main-link active' : 'other-link'; ?>"
							<?php if ( isset( $tab['data'] ) ) {
								foreach ( $tab['data'] as $key => $value ) {
									printf( ' data-%s="%s"', sanitize_key( $key ), esc_attr( $value ) );
								}
							} ?>
						>
							<span
								class="h-text <?php echo esc_attr( $tab['class'] ); ?>"><?php echo $tab['icon'] . esc_html( $tab['title'] ); // icon escaped before ?></span>
						</a>
					<?php } ?>

				<?php } ?>

			</h3>
			<?php

		}


	}// publisher_block_the_heading
}


if ( ! function_exists( 'publisher_format_icon' ) ) {
	/**
	 * Handy function used to get post format badge
	 *
	 * @param   bool $echo Echo or return
	 *
	 * @return string
	 */
	function publisher_format_icon( $echo = TRUE ) {

		$output = '';

		if ( get_post_type() == 'post' ) {

			$format = get_post_format();

			if ( $format ) {

				switch ( $format ) {

					case 'video':
						$output = '<span class="format-icon format-' . $format . '"><i class="fa fa-play"></i></span>';
						break;

					case 'aside':
						$output = '<span class="format-icon format-' . $format . '"><i class="fa fa-pencil"></i></span>';
						break;

					case 'quote':
						$output = '<span class="format-icon format-' . $format . '"><i class="fa fa-quote-left"></i></span>';
						break;

					case 'gallery':
					case 'image':
						$output = '<span class="format-icon format-' . $format . '"><i class="fa fa-camera"></i></span>';
						break;

					case 'status':
						$output = '<span class="format-icon format-' . $format . '"><i class="fa fa-refresh"></i></span>';
						break;

					case 'audio':
						$output = '<span class="format-icon format-' . $format . '"><i class="fa fa-music"></i></span>';
						break;

					case 'chat':
						$output = '<span class="format-icon format-' . $format . '"><i class="fa fa-coffee"></i></span>';
						break;

					case 'link':
						$output = '<span class="format-icon format-' . $format . '"><i class="fa fa-link"></i></span>';
						break;

				}

			}

		}

		if ( $echo ) {
			echo $output; // escaped before
		} else {
			return $output;
		}

	} // publisher_format_badge_code
} // if


if ( ! function_exists( 'publisher_get_links_pagination' ) ) {
	/**
	 * @param array $options
	 *
	 * @return string
	 */
	function publisher_get_links_pagination( $options = array() ) {

		// Default Options
		$default_options = array(
			'echo' => TRUE,
		);

		// Texts with RTL support
		if ( is_rtl() ) {
			$default_options['older-text'] = '<i class="fa fa-angle-double-right"></i> ' . publisher_translation_get( 'pagination_newer' );
			$default_options['next-text']  = publisher_translation_get( 'pagination_older' ) . ' <i class="fa fa-angle-double-left"></i>';
		} else {
			$default_options['next-text']  = '<i class="fa fa-angle-double-left"></i> ' . publisher_translation_get( 'pagination_older' );
			$default_options['older-text'] = publisher_translation_get( 'pagination_newer' ) . ' <i class="fa fa-angle-double-right"></i>';
		}

		// Merge default and passed options
		$options = wp_parse_args( $options, $default_options );

		if ( ! $options['echo'] ) {
			ob_start();
		}

		// fix category posts link because of offset
		if ( is_category() ) {
			$term_id       = get_queried_object()->term_id;
			$count         = bf_get_term_posts_count( $term_id, array( 'include_childs' => TRUE ) );
			$limit         = get_option( 'posts_per_page' );
			$slider_config = publisher_cat_main_slider_config();

			// Custom count per category
			if ( bf_get_term_meta( 'term_posts_count', get_queried_object()->term_id, '' ) != '' ) {
				$limit = bf_get_term_meta( 'term_posts_count', get_queried_object()->term_id, '' );
			} // Custom count for all categories
			elseif ( publisher_get_option( 'cat_posts_count' ) != '' && intval( publisher_get_option( 'cat_posts_count' ) ) > 0 ) {
				$limit = publisher_get_option( 'cat_posts_count' );
			}

			if ( $slider_config['show'] && $slider_config['type'] == 'custom-blocks' ) {
				$max_items = ceil( ( $count - intval( $slider_config['posts'] ) ) / $limit );
			} else {
				$max_items = publisher_get_query()->max_num_pages;
			}

		} else {
			$max_items = publisher_get_query()->max_num_pages;
		}

		if ( $max_items > 1 ) {
			?>
			<div <?php publisher_attr( 'pagination', 'bs-links-pagination clearfix' ) ?>>
				<div class="older"><?php next_posts_link( $options['next-text'], $max_items ); ?></div>
				<div class="newer"><?php previous_posts_link( $options['older-text'] ); ?></div>
			</div>
			<?php
		}

		if ( ! $options['echo'] ) {
			return ob_get_clean();
		}

	} // publisher_get_links_pagination
} // if


if ( ! function_exists( 'publisher_get_pagination' ) ) {
	/**
	 * BetterTemplate Custom Pagination
	 *
	 * @param array $options extend options for paginate_links()
	 *
	 * @return array|mixed|string
	 *
	 * @see paginate_links()
	 */
	function publisher_get_pagination( $options = array() ) {

		global $wp_rewrite;

		// Default Options
		$default_options = array(
			'echo'            => TRUE,
			'use-wp_pagenavi' => TRUE,
			'users-per-page'  => 6,
		);

		// Prepare query
		if ( publisher_get_query() != NULL ) {
			$default_options['query'] = publisher_get_query();
		} else {
			global $wp_query;
			$default_options['query'] = $wp_query;
		}

		// Merge default and passed options
		$options = wp_parse_args( $options, $default_options );


		// Texts with RTL support
		if ( ! isset( $options['next-text'] ) && ! isset( $options['prev-text'] ) ) {
			if ( is_rtl() ) {
				$options['next-text'] = publisher_translation_get( 'pagination_next' ) . ' <i class="fa fa-angle-left"></i>';
				$options['prev-text'] = '<i class="fa fa-angle-right"></i> ' . publisher_translation_get( 'pagination_prev' );
			} else {
				$options['next-text'] = publisher_translation_get( 'pagination_next' ) . ' <i class="fa fa-angle-right"></i>';
				$options['prev-text'] = ' <i class="fa fa-angle-left"></i> ' . publisher_translation_get( 'pagination_prev' );
			}
		}


		// WP-PageNavi Plugin
		if ( $options['use-wp_pagenavi'] && function_exists( 'wp_pagenavi' ) && ! is_a( $options['query'], 'WP_User_Query' ) ) {

			ob_start();

			// Use WP-PageNavi plugin to generate pagination
			wp_pagenavi(
				array(
					'query' => $options['query']
				)
			);

			$pagination = ob_get_clean();

		} // Custom Pagination With WP Functionality
		else {

			$paged = $options['query']->get( 'paged', '' ) ? $options['query']->get( 'paged', '' ) : ( $options['query']->get( 'page', '' ) ? $options['query']->get( 'page', '' ) : 1 );

			if ( is_a( $options['query'], 'WP_User_Query' ) ) {

				$offset = $options['users-per-page'] * ( $paged - 1 );

				$total_pages = ceil( $options['query']->total_users / $options['users-per-page'] );

			} else {
				$total_pages = $options['query']->max_num_pages;

				// fix category posts link because of offset
				if ( is_category() ) {
					$term_id = get_queried_object()->term_id;
					$count   = bf_get_term_posts_count( $term_id, array( 'include_childs' => TRUE ) );

					$limit         = get_option( 'posts_per_page' );
					$slider_config = publisher_cat_main_slider_config( $term_id );

					// Custom count per category
					if ( bf_get_term_meta( 'term_posts_count', $term_id, '' ) != '' ) {
						$limit = bf_get_term_meta( 'term_posts_count', $term_id, '' );
					} // Custom count for all categories
					elseif ( publisher_get_option( 'cat_posts_count' ) != '' && intval( publisher_get_option( 'cat_posts_count' ) ) > 0 ) {
						$limit = publisher_get_option( 'cat_posts_count' );
					}

					if ( $slider_config['show'] && $slider_config['type'] == 'custom-blocks' ) {
						$total_pages = ceil( ( $count - intval( $slider_config['posts'] ) ) / $limit );
					}
				}

			}

			if ( $total_pages <= 1 ) {
				return '';
			}

			$args = array(
				'base'      => add_query_arg( 'paged', '%#%' ),
				'current'   => max( 1, $paged ),
				'total'     => $total_pages,
				'next_text' => $options['next-text'],
				'prev_text' => $options['prev-text']
			);

			if ( is_a( $options['query'], 'WP_User_Query' ) ) {
				$args['offset'] = $offset;
			}

			if ( $wp_rewrite->using_permalinks() ) {
				$big          = 999999999;
				$args['base'] = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
			}

			if ( is_search() ) {
				$args['add_args'] = array(
					's' => urlencode( get_query_var( 's' ) )
				);
			}

			$pagination = paginate_links( array_merge( $args, $options ) );

			$pagination = preg_replace( '/&#038;paged=1(\'|")/', '\\1', trim( $pagination ) );

		}

		$pagination = '<div ' . publisher_get_attr( 'pagination', 'bs-numbered-pagination' ) . '>' . $pagination . '</div>';

		if ( $options['echo'] ) {
			echo $pagination; // escaped before
		} else {
			return $pagination;
		}

	} // publisher_get_pagination
} // if


add_filter( 'publisher/archive/before-loop', 'publisher_archive_show_pagination' );
add_filter( 'publisher/archive/after-loop', 'publisher_archive_show_pagination' );
if ( ! function_exists( 'publisher_archive_show_pagination' ) ) {
	/**
	 * used to add pagination
	 *
	 * note: do not call this manually. it should be fire with following callbacks:
	 * 1. publisher/archive/before-loop
	 * 2. publisher/archive/after-loop
	 */
	function publisher_archive_show_pagination() {

		$wp_query = publisher_get_query();

		$pagination = publisher_get_pagination_style(); // determine current page pagination (with inner cache)

		$filter = current_filter();

		switch ( TRUE ) {

			case $pagination == 'numbered' && $filter == 'publisher/archive/before-loop':
				return;
				break;

			case $pagination == 'numbered' && $filter == 'publisher/archive/after-loop':
				publisher_get_pagination();

				return;
				break;

			case $pagination == 'links' && $filter == 'publisher/archive/before-loop':
				return;
				break;

			case $pagination == 'links' && $filter == 'publisher/archive/after-loop':
				publisher_get_links_pagination();

				return;
				break;

			case $pagination == 'ajax_more_btn_infinity' && $filter == 'publisher/archive/before-loop':
			case $pagination == 'ajax_infinity' && $filter == 'publisher/archive/before-loop':
			case $pagination == 'ajax_more_btn' && $filter == 'publisher/archive/before-loop':
			case $pagination == 'ajax_next_prev' && $filter == 'publisher/archive/before-loop':

				$max_num_pages = bf_get_wp_query_total_pages( $wp_query );

				// fix for when there is no more pages
				if ( $max_num_pages <= 1 ) {
					return;
				}

				// Create valid name for BS_Pagination
				$pagin_style = str_replace( 'ajax_', '', $pagination );

				$atts = array(
					'paginate'        => $pagin_style,
					'have_pagination' => TRUE,
				);

				publisher_theme_pagin_manager()->wrapper_start( $atts );

				break;

			case $pagination == 'ajax_more_btn_infinity' && $filter == 'publisher/archive/after-loop':
			case $pagination == 'ajax_infinity' && $filter == 'publisher/archive/after-loop':
			case $pagination == 'ajax_more_btn' && $filter == 'publisher/archive/after-loop':
			case $pagination == 'ajax_next_prev' && $filter == 'publisher/archive/after-loop':

				$max_num_pages = bf_get_wp_query_total_pages( $wp_query );

				// fix for when there is no more pages
				if ( $max_num_pages <= 1 ) {
					return;
				}

				// Create valid name for BS_Pagination
				$pagin_style = str_replace( 'ajax_', '', $pagination );

				$atts = array(
					'paginate'        => $pagin_style,
					'have_pagination' => TRUE,
					'show_label'      => publisher_theme_pagin_manager()->get_pagination_label( 1, $max_num_pages ),
					'next_page_link'  => next_posts( 0, FALSE ), // next page link for better SEO

					'query_vars' => bf_get_wp_query_vars( $wp_query )
				);

				publisher_theme_pagin_manager()->wrapper_end();

				publisher_theme_pagin_manager()->display_pagination( $atts, $wp_query, 'Publisher::bs_pagin_ajax_archive', 'custom' );
		}
	} // publisher_archive_show_pagination
} // if


if ( ! function_exists( 'publisher_general_fix_shortcode_vc_style' ) ) {
	/**
	 * Fixes shortcode style for generated style from VC -> General fixes
	 *
	 * @param $atts
	 */
	function publisher_general_fix_shortcode_vc_style( &$atts ) {

		switch ( $atts['shortcode-id'] ) {

			case 'bs-modern-grid-listing-5':
				$bg_color = bf_shortcode_custom_css_prop( $atts['css'], 'background-color' );

				if ( empty( $bg_color ) ) {
					return;
				}

				$class = bf_shortcode_custom_css_class( $atts );

				bf_add_css( '.' . $class . ' .listing-mg-5-item-big .content-container{ background-color:' . $bg_color . ' !important}', TRUE, TRUE );

				break;

			// Classic Listing 3 content BG Fix
			case 'bs-classic-listing-3':
			case 'bs-mix-listing-4-7':
			case 'bs-mix-listing-4-2':
			case 'bs-mix-listing-4-1':
				$bg_color = bf_shortcode_custom_css_prop( $atts['css'], 'background-color' );

				if ( empty( $bg_color ) ) {
					return;
				}

				$class = bf_shortcode_custom_css_class( $atts );

				bf_add_css( '.' . $class . ' .listing-item-classic-3 .featured .title{ background-color:' . $bg_color . '}', TRUE, TRUE );

				break;

		}

		return; // It's for inner style!
	}
}// publisher_fix_shortcode_vc_style


if ( ! function_exists( 'publisher_fix_shortcode_vc_style' ) ) {
	/**
	 * Fixes shortcode style for generated style from VC
	 *
	 * @param $atts
	 */
	function publisher_fix_shortcode_vc_style( &$atts ) {

		publisher_general_fix_shortcode_vc_style( $atts ); // general fixes

		return; // It's for inner style!
	}
}// publisher_fix_shortcode_vc_style


add_filter( 'better-framework/shortcodes/atts', 'publisher_fix_bs_listing_vc_atts' );

if ( ! function_exists( 'publisher_fix_bs_listing_vc_atts' ) ) {
	/**
	 * Used to customize bs listing atts for VC
	 *
	 * @param $atts
	 *
	 * @return mixed
	 */
	function publisher_fix_bs_listing_vc_atts( $atts ) {

		if ( empty( $atts['css'] ) ) {
			return $atts;
		}

		publisher_fix_shortcode_vc_style( $atts );

		return $atts;
	}
}


if ( ! function_exists( 'publisher_get_single_template' ) ) {
	/**
	 * Used to get template for single page
	 *
	 * @return string
	 */
	function publisher_get_single_template() {

		// default for other post types
		if ( ! is_singular( 'post' ) ) {
			return 'style-1';
		}

		$template = bf_get_post_meta( 'post_template' );

		if ( $template == 'default' ) {
			$template = publisher_get_option( 'post_template' );
		}

		// validate
		if ( $template != 'default' && ! publisher_is_valid_single_template( $template ) ) {
			$template = 'default';
		}

		// default is style-1
		if ( $template == 'default' ) {
			$template = 'style-1';
		}

		return $template;

	}
}// publisher_fix_shortcode_vc_style


if ( ! function_exists( 'publisher_is_valid_single_template' ) ) {
	/**
	 * Used to get template for single page
	 *
	 * @return string
	 */
	function publisher_get_single_template_option( $default = FALSE ) {

		$option = array();

		if ( $default ) {
			$option['default'] = array(
				'img'   => bf_get_theme_uri( 'images/options/post-default.png' ),
				'label' => __( '-- Default --', 'publisher' ),
			);
		}

		$option['style-1']  = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-1.png' ),
			'label' => __( 'Style 1', 'publisher' ),
		);
		$option['style-2']  = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-2.png' ),
			'label' => __( 'Style 2', 'publisher' ),
		);
		$option['style-3']  = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-3.png' ),
			'label' => __( 'Style 3', 'publisher' ),
		);
		$option['style-4']  = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-4.png' ),
			'label' => __( 'Style 4', 'publisher' ),
		);
		$option['style-5']  = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-5.png' ),
			'label' => __( 'Style 5', 'publisher' ),
		);
		$option['style-6']  = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-6.png' ),
			'label' => __( 'Style 6', 'publisher' ),
		);
		$option['style-7']  = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-7.png' ),
			'label' => __( 'Style 7', 'publisher' ),
		);
		$option['style-8']  = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-8.png' ),
			'label' => __( 'Style 8', 'publisher' ),
		);
		$option['style-9']  = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-9.png' ),
			'label' => __( 'Style 9', 'publisher' ),
		);
		$option['style-10'] = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-10.png' ),
			'label' => __( 'Style 10', 'publisher' ),
		);
		$option['style-11'] = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-11.png' ),
			'label' => __( 'Style 11', 'publisher' ),
		);
		$option['style-12'] = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-12.png' ),
			'label' => __( 'Style 12', 'publisher' ),
		);
		$option['style-13'] = array(
			'img'   => bf_get_theme_uri( 'images/options/post-style-13.png' ),
			'label' => __( 'Style 13', 'publisher' ),
		);

		return $option;

	}
}// publisher_fix_shortcode_vc_style


if ( ! function_exists( 'publisher_is_valid_single_template' ) ) {
	/**
	 * Checks parameter to be a theme valid single template
	 *
	 * @param $template
	 *
	 * @return bool
	 */
	function publisher_is_valid_single_template( $template ) {
		return array_key_exists( $template, publisher_get_single_template_option() );
	} // publisher_is_valid_listing
}


if ( ! function_exists( 'publisher_social_counter_options_list_callback' ) ) {
	/**
	 * Handy deferred function for improving performance
	 *
	 * @return array
	 */
	function publisher_social_counter_options_list_callback() {

		if ( ! class_exists( 'Better_Social_Counter' ) ) {
			return array();
		} else {
			return Better_Social_Counter_Data_Manager::self()->get_widget_options_list();
		}

	}
}

if ( ! function_exists( 'publisher_is_animated_thumbnail_active' ) ) {
	/**
	 * Returns the condition of animated thumbnail activation
	 *
	 * @return bool
	 */
	function publisher_is_animated_thumbnail_active() {
		return TRUE;
	}
}


if ( ! function_exists( 'publisher_get_related_post_type' ) ) {
	/**
	 * Returns type of related posts for current page
	 *
	 * @return bool|mixed|null|string|void
	 */
	function publisher_get_related_post_type() {

		$related_post = 'default';

		if ( is_singular( 'post' ) || is_singular( 'page' ) ) {
			$related_post = bf_get_post_meta( 'post_related' );
		}

		if ( $related_post == 'default' || $related_post == '' || $related_post == FALSE ) {
			$related_post = publisher_get_option( 'post_related' );
		}

		return $related_post;

	}
}


if ( ! function_exists( 'publisher_get_post_comments_type' ) ) {
	/**
	 * Returns type of comments for current page
	 *
	 * @return bool|mixed|null|string|void
	 */
	function publisher_get_post_comments_type() {

		// Return from cache
		if ( publisher_get_global( 'post-comments-type-' . get_the_ID(), FALSE ) ) {
			return publisher_get_global( 'post-comments-type-' . get_the_ID(), FALSE );
		}

		$type = 'default';

		// for pages and posts
		if ( is_singular( 'post' ) || is_singular( 'page' ) ) {
			$type = bf_get_post_meta( 'post_comments', get_the_ID(), 'default' );
		}

		// get default from panel
		if ( empty( $type ) || $type == FALSE || $type == 'default' ) {
			if ( is_singular( 'page' ) ) {
				$type = publisher_get_option( 'page_comments' );
			} else {
				$type = publisher_get_option( 'post_comments' );
			}
		}

		// if ajaxify is not enabled
		if ( $type == 'show-ajaxified' && ! publisher_is_ajaxified_comments_active() ) {
			$type = 'show-simple';
		}

		// if tyle is not valid
		if ( ! in_array( $type, array( 'show-ajaxified', 'show-simple', 'hide' ) ) ) {
			$type = 'show-simple';
		}

		//
		// If related post is infinity then posts loaded from ajax should have show comments button
		//
		if ( publisher_get_related_post_type() == 'infinity-related-post' || ( defined( 'PUBLISHER_THEME_AJAXIFIED_LOAD_POST' ) && PUBLISHER_THEME_AJAXIFIED_LOAD_POST ) ) {
			$type = 'show-ajaxified';
		}

		// Change ajaxified to show simple when user submitted an comment before
		if ( $type == 'show-ajaxified' && ! empty( $_GET['publisher-theme-comment-inserted'] ) && $_GET['publisher-theme-comment-inserted'] == '1' ) {
			$type = 'show-simple';
		}

		// Cache it
		publisher_set_global( 'post-comments-type-' . get_the_ID(), $type );

		return $type;
	}
}


if ( ! function_exists( 'publisher_comments_template' ) ) {
	/**
	 * Handy function to getting correct comments file
	 */
	function publisher_comments_template() {

		switch ( publisher_get_post_comments_type() ) {

			case 'show-simple':
				comments_template();
				break;

			case 'show-ajaxified':
				comments_template( '/comments-ajaxified.php' );
				break;

			case FALSE:
			case '':
			case 'hide':
				return;

		}

	}
}
