<?php

// Add Ability to setting short code in text widget
add_filter( 'widget_text', 'do_shortcode' );

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

		?>
		<div <?php publisher_attr( 'pagination', 'bs-links-pagination clearfix' ) ?>>

			<div class="older"><?php next_posts_link( $options['next-text'] ); ?></div>

			<div class="newer"><?php previous_posts_link( $options['older-text'] ); ?></div>

		</div>
		<?php

		if ( ! $options['echo'] ) {
			return ob_get_clean();
		}

	} // publisher_get_links_pagination
} // if


// Hook to WP categories list functionality
add_filter( 'wp_list_categories', 'publisher_category_list_post_count_filter' );

if ( ! function_exists( 'publisher_category_list_post_count_filter' ) ) {
	/**
	 * Used to wrap categories count inside span
	 *
	 * @param $links
	 *
	 * @return mixed
	 */
	function publisher_category_list_post_count_filter( $links ) {

		$links = str_replace( '</a> (', ' <span class="post-count">', $links );

		$links = str_replace( ')', '</span></a>', $links );

		return $links;

	} // publisher_category_list_post_count_filter
} // if

// Hook to get_archives_link
add_filter( 'get_archives_link', 'publisher_archive_list_post_count_filter' );

if ( ! function_exists( 'publisher_archive_list_post_count_filter' ) ) {
	/**
	 * Used to wrap archive links count inside span for better style
	 *
	 * @param $link
	 *
	 * @return mixed
	 */
	function publisher_archive_list_post_count_filter( $link ) {

		$link = str_replace( '(', '<span class="post-count">', $link );

		$link = str_replace( ')', '</span>', $link );

		return $link;

	} // publisher_archive_list_post_count_filter
} // if

// add theme title tag support
add_theme_support( 'title-tag' );
// Backwards Compatibility For Theme title-tag Feature
if ( ! function_exists( '_wp_render_title_tag' ) ) {

	add_action( 'wp_head', 'publisher_theme_slug_render_title' );
	if ( ! function_exists( 'publisher_theme_slug_render_title' ) ) {
		/**
		 * Hooked to wp_head to add title tag
		 */
		function publisher_theme_slug_render_title() {
			?>
			<title><?php wp_title( '|', TRUE, 'right' ); ?></title>
			<?php
		} // publisher_theme_slug_render_title
	} // if
} // if


if ( ! function_exists( 'publisher_get_time_filter_query' ) ) {
	/**
	 * Handy function used to generate array of time filter from ID
	 *
	 * @param $filter_id
	 *
	 * @return array
	 */
	function publisher_get_time_filter_query( $filter_id ) {

		$date_query = array();

		switch ( $filter_id ) {

			// Today posts
			case 'today':

				$date_query = array(
					array(
						'after' => '1 day ago', // should not escaped because will be passed to WP_Query
					),
				);

				break;

			// Today + Yesterday posts
			case 'yesterday':

				$date_query = array(
					array(
						'after' => '2 day ago', // should not escaped because will be passed to WP_Query
					),
				);

				break;


			// Week posts
			case 'week':

				$date_query = array(
					array(
						'after' => '1 week ago', // should not escaped because will be passed to WP_Query
					),
				);

				break;

			// Month posts
			case 'month':

				$date_query = array(
					array(
						'after' => '1 month ago', // should not escaped because will be passed to WP_Query
					),
				);

				break;

			// Year posts
			case 'year':

				$date_query = array(
					array(
						'after' => '1 year ago', // should not escaped because will be passed to WP_Query
					),
				);

				break;
		}

		return $date_query;
	} // publisher_get_time_filter_query
} // if


if ( ! function_exists( 'publisher_get_order_filter_query' ) ) {
	/**
	 * Handy function used to generate array of order filter from ID
	 *
	 * @param $filter_id
	 *
	 * @return array
	 */
	function publisher_get_order_filter_query( $filter_id, $args = NULL ) {

		if ( is_null( $args ) || ! is_array( $args ) ) {
			$args = array();
		}

		switch ( $filter_id ) {

			case 'recent':
			case 'date':
				$args['orderby'] = 'date';
				break;

			case 'comment_count':
				$args['orderby'] = 'comment_count';
				break;

			case 'popular':
				$args['meta_key'] = 'better-views-count';
				$args['orderby']  = 'meta_value_num';
				break;

			case 'popular_7days':
				$args['meta_key'] = 'better-views-7days-total';
				$args['orderby']  = 'meta_value_num';
				break;

			default:
				$args['orderby'] = $filter_id;
		}

		return $args;
	} // publisher_get_order_filter_query
} // if


if ( ! function_exists( 'publisher_get_order_field_option' ) ) {
	/**
	 * Handy function used to get list of order select field options
	 *
	 * @return array
	 */
	function publisher_get_order_field_option() {
		$options = array(
			'date'          => __( 'Published Date', 'publisher' ),
			'modified'      => __( 'Modified Date', 'publisher' ),
			'rand'          => __( 'Random', 'publisher' ),
			'comment_count' => __( 'Number of Comments', 'publisher' )
		);

		// Order by post views
		if ( function_exists( 'The_Better_Views' ) ) {
			$options['popular'] = __( 'Popular', 'publisher' );
			if ( Better_Post_Views()->is_active( '7days' ) ) {
				$options['popular_7days'] = __( '7 Days popular', 'publisher' );
			}
		}

		return $options;

	} // publisher_get_order_filter_query
} // if


// Hooked to show user custom avatar
add_filter( 'get_avatar', 'publisher_get_avatar_filter', 10, 5 );

if ( ! function_exists( 'publisher_get_avatar_filter' ) ) {
	/**
	 * Callback: Used for using user avatar field
	 *
	 * Filter: get_avatar
	 *
	 * @param $avatar
	 * @param $id_or_email
	 * @param $size
	 * @param $default
	 * @param $alt
	 *
	 * @return string
	 */
	function publisher_get_avatar_filter( $avatar, $id_or_email, $size, $default, $alt ) {

		if ( is_numeric( $id_or_email ) ) {

			$id = (int) $id_or_email;

		} elseif ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) ) {

			$id = (int) $id_or_email->user_id;

		} else {
			return $avatar;
		}

		if ( ! function_exists( 'bf_get_user_meta' ) ) {

			$out = get_user_meta( $id, 'avatar', TRUE );
			if ( $out != '' ) {
				$avatar = "<img alt='{$alt}' src='{$out}' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";
			}

		} elseif ( bf_get_user_meta( 'avatar', $id, '' ) != '' ) {

			$out = bf_get_user_meta( 'avatar', $id );

			$avatar = "<img alt='{$alt}' src='{$out}' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";

		}

		return $avatar;

	} // publisher_get_avatar_filter
} // if

// Hooked to filter comments nav next page attributes
add_filter( 'next_comments_link_attributes', 'publisher_next_comments_link_attributes_filter' );

if ( ! function_exists( 'publisher_next_comments_link_attributes_filter' ) ) {
	/**
	 * Callback: ads class to comments nav attributes
	 *
	 * @param $attributes
	 *
	 * @return string
	 */
	function publisher_next_comments_link_attributes_filter( $attributes ) {
		return $attributes . ' class="next-page" ';
	}
}


// Hooked to filter comments nav next page attributes
add_filter( 'previous_comments_link_attributes', 'publisher_previous_comments_link_attributes_filter' );

if ( ! function_exists( 'publisher_previous_comments_link_attributes_filter' ) ) {
	/**
	 * Callback: ads class to comments nav attributes
	 *
	 * @param $attributes
	 *
	 * @return string
	 */
	function publisher_previous_comments_link_attributes_filter( $attributes ) {
		return $attributes . ' class="prev-page" ';
	}
}


if ( ! function_exists( 'publisher_the_author_social_icons' ) ) {
	/**
	 * Generates author social links UL
	 *
	 * @param null $author
	 */
	function publisher_the_author_social_icons( $author = NULL ) {

		if ( is_null( $author ) ) {

			// Get current post author id
			if ( is_singular() ) {
				$author = get_the_author_meta( 'ID' );
			} // Get current archive user
			elseif ( is_author() ) {
				$author = bf_get_author_archive_user();
			} // Return
			else {
				return;
			}
		}

		if ( is_int( $author ) ) {
			$author = get_user_by( 'id', $author );
		}

		// Contains links of author
		$links = array();

		// Github Link
		if ( $github_url = bf_get_user_meta( 'github_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-github"></i>',
				'href'  => $github_url,
				'class' => 'github',
			);
		}

		// Pinterest Link
		if ( $pinterest_url = bf_get_user_meta( 'pinterest_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-pinterest"></i>',
				'href'  => $pinterest_url,
				'class' => 'pinterest',
			);
		}

		// Youtube Link
		if ( $youtube_url = bf_get_user_meta( 'youtube_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-youtube"></i>',
				'href'  => $youtube_url,
				'class' => 'youtube',
			);
		}

		// Linkedin Link
		if ( $linkedin_url = bf_get_user_meta( 'linkedin_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-linkedin"></i>',
				'href'  => $linkedin_url,
				'class' => 'linkedin',
			);
		}

		// Dribbble Link
		if ( $dribbble_url = bf_get_user_meta( 'dribbble_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-dribbble"></i>',
				'href'  => $dribbble_url,
				'class' => 'dribbble',
			);
		}

		// Vimeo Link
		if ( $vimeo_url = bf_get_user_meta( 'vimeo_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-vimeo-square"></i>',
				'href'  => $vimeo_url,
				'class' => 'vimeo',
			);
		}

		// Delicious Link
		if ( $delicious_url = bf_get_user_meta( 'delicious_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-delicious"></i>',
				'href'  => $delicious_url,
				'class' => 'delicious',
			);
		}

		// SoundCloud Link
		if ( $soundcloud_url = bf_get_user_meta( 'soundcloud_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-soundcloud"></i>',
				'href'  => $soundcloud_url,
				'class' => 'soundcloud',
			);
		}

		// Behance Link
		if ( $behance_url = bf_get_user_meta( 'behance_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-behance"></i>',
				'href'  => $behance_url,
				'class' => 'behance',
			);
		}

		// Flickr Link
		if ( $flickr_url = bf_get_user_meta( 'flickr_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-flickr"></i>',
				'href'  => $flickr_url,
				'class' => 'flickr',
			);
		}

		// Instagram Link
		if ( $instagram_url = bf_get_user_meta( 'instagram_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-instagram"></i>',
				'href'  => $instagram_url,
				'class' => 'instagram',
			);
		}

		// Google+ Link
		if ( $gplus_url = bf_get_user_meta( 'gplus_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-google-plus"></i>',
				'href'  => $gplus_url,
				'class' => 'google-plus',
			);
		}

		// Twitter Link
		if ( $twitter_url = bf_get_user_meta( 'twitter_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-twitter"></i>',
				'href'  => $twitter_url,
				'class' => 'twitter',
			);
		}

		// Facebook Link
		if ( $facebook_url = bf_get_user_meta( 'facebook_url', $author->ID ) ) {
			$links[] = array(
				'title' => '<i class="fa fa-facebook"></i>',
				'href'  => $facebook_url,
				'class' => 'facebook',
			);
		}

		// Fix order issue in RTL languages
		if ( is_rtl() ) {
			$links = array_reverse( $links );
		}

		?>
		<ul class="author-social-icons">
			<?php

			foreach ( $links as $link ) {
				?>
				<li class="<?php echo esc_attr( $link['class'] ); ?>"><a href="<?php echo esc_url( $link['href'] ); ?>"
				                                                         target="_blank"><?php echo $link['title']; // escaped before in top ?></a>
				</li>
				<?php
			}

			?>
		</ul>
		<?php

	} // publisher_the_author_social_icons
} // if


if ( ! function_exists( 'publisher_limit_words' ) ) {
	/**
	 * Truncates string to the word closest to a certain number of characters
	 *
	 * @param        $string
	 * @param int    $width
	 * @param string $append
	 *
	 * @return string
	 */
	function publisher_limit_words( $string, $width = 100, $append = '&hellip;' ) {

		if ( $width < 1 ) {
			return $string;
		}

		// do nothing if length is smaller or equal filter!
		if ( strlen( $string ) <= $width ) {
			return $string;
		}

		$parts       = preg_split( '/([\s\n\r]+)/u', $string, NULL, PREG_SPLIT_DELIM_CAPTURE );
		$parts_count = count( $parts );

		$length    = 0;
		$last_part = 0;
		for ( ; $last_part < $parts_count; ++ $last_part ) {
			$length += mb_strlen( $parts[ $last_part ] );

			if ( $length > $width ) {
				break;
			}
		}

		if ( $length > $width ) {
			return trim( implode( array_slice( $parts, 0, $last_part ) ) ) . $append;
		} else {
			return implode( array_slice( $parts, 0, $last_part ) );
		}
	}
}


if ( ! function_exists( 'publisher_html_limit_words' ) ) {
	/**
	 * Truncates string to the word closest to a certain number of characters
	 *
	 * @param string $html
	 * @param int    $width
	 * @param string $append
	 *
	 * @return string
	 */
	function publisher_html_limit_words( $html, $width = 100, $append = '&hellip;' ) {
		if ( $width < 1 ) {
			return $html;
		}
		$html = preg_replace( '/\s+/', ' ', $html );

		//TODO: Fix RegEx to prevent match none html inputs
		if ( ( preg_match_all( '/( [^\<]* ) (<)? (?(2)	 (\/?) ([^\>]+ ) > )/isx', $html, $match ) ) && array_filter( $match[2] ) ) {

			// do nothing if length is smaller or equal filter!
			if ( strlen( $html ) <= $width ) {
				return $html;
			}

			$break = FALSE;
			$texts = &$match[1];
			$tags  = &$match[4];

			$length         = 0;
			$result         = '';
			$open_tags_list = array();

			foreach ( $texts as $index => $text ) {
				$slice_size = $width - $length;
				if ( $slice_size < 1 ) {
					$break = TRUE;
					break;
				}

				$sliced_text = publisher_limit_words( $text, $slice_size, '' );
				$length += mb_strlen( $text );
				$result .= $sliced_text;

				if ( $sliced_text !== $text ) {
					$break = TRUE;
					break;
				}

				$tag_data = $tags[ $index ];
				$tag_data = explode( ' ', $tag_data, 2 );

				$tag  = &$tag_data[0];
				$atts = isset( $tag_data[1] ) ? ' ' . $tag_data[1] : '';

				$is_open_tag = empty( $match[3][ $index ] );

				if ( $is_open_tag ) {
					$open_tags_list[] = $tag;

					if ( $tag ) {
						$result .= '<' . $tag . $atts . '>';
					}
				} else {

					do {
						$last_open_tag = array_pop( $open_tags_list );

						$result .= '</' . $last_open_tag . '>';
					} while( $last_open_tag && $last_open_tag !== $tag );
				}
			}

			do {
				if ( $last_open_tag = array_pop( $open_tags_list ) ) {
					$result .= '</' . $last_open_tag . '>';
				}
			} while( $last_open_tag );

			if ( $break ) {
				$result .= $append;
			}

			/* remove empty tags
				 $result = preg_replace('/\s*<([^\s\>]+).*?>\s*(?:<\s*\/\\1\s*>)?/i', '', $result); */

			return $result;
		} else {
			return publisher_limit_words( $html, $width, $append );
		}
	}
}


if ( ! function_exists( 'publisher_echo_limit_words' ) ) {
	/**
	 * Truncates string to the word closest to a certain number of characters
	 *
	 * @param        $string
	 * @param int    $width
	 * @param string $append
	 */
	function publisher_echo_limit_words( $string, $width = 100, $append = '&hellip;' ) {
		echo publisher_limit_words( $string, $width, $append ); // escaped before
	}
}


if ( ! function_exists( 'publisher_echo_html_limit_words' ) ) {
	/**
	 * Truncates HTML to the word closest to a certain number of characters
	 * with support of HTML tags inside text also this fixes unclosed tags inside HTML
	 *
	 * @param        $html
	 * @param int    $width
	 * @param string $append
	 */
	function publisher_echo_html_limit_words( $html, $width = 100, $append = '&hellip;' ) {
		echo publisher_html_limit_words( $html, $width, $append ); // escaped before
	}
}


if ( ! function_exists( 'publisher_strpos_array' ) ) {

	/**
	 * Used to find first element with string inside array
	 *
	 * @param     $haystack_string
	 * @param     $needle_array
	 * @param int $offset
	 *
	 * @return bool
	 */
	function publisher_strpos_array( $haystack_string, $needle_array, $offset = 0 ) {

		foreach ( $needle_array as $query ) {
			if ( strpos( $haystack_string, $query, $offset ) !== FALSE ) {
				return TRUE;
			}
		}

		return FALSE;
	}
} // publisher_strpos_array
