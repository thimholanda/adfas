<?php


if ( ! function_exists( 'publisher_pagin_filter_wp_query_args' ) ) {
	/**
	 * Filter $atts array and return only required index for ajax handler
	 * @see Publisher_Theme_Listing_Pagin_Manager::handle_ajax_response()
	 *
	 * @param array  $args BF_Shortcode Class $atts array
	 * @param string $view listing class name, otherwise or callback name
	 *
	 * @return array filtered $atts values
	 */
	function publisher_pagin_filter_wp_query_args( $args, $view ) {

		$query_fields  = array(
			'category',
			'tag',
			'post_ids',
			'post_type',
			'count',
			'order_by',
			'order',
			'time_filter',
			'offset',

			// publisher_pagin_create_query_args() function also use style & columns index to generate query
			'style',

			'post__not_in',
			'category__in',

			'show_excerpt',
			'author'
		);
		$valid_indexes = apply_filters(
			'publisher-theme-core/pagination/filter-data/' . $view,
			Publisher_Theme_Listing_Pagin_Manager::get_valid_indexes_data()
		);
		$query_fields  = array_merge( $query_fields, $valid_indexes );

		return wp_array_slice_assoc( $args, $query_fields );
	}
}


if ( ! function_exists( 'publisher_pagin_filter_pagin_args' ) ) {
	/**
	 * Filter $atts array and return only required index for ajax handler
	 * @see Publisher_Theme_Listing_Pagin_Manager::handle_ajax_response()
	 *
	 * @param array $args Custom function args
	 *
	 * @return array filtered $atts values
	 */
	function publisher_pagin_filter_pagin_args( $args ) {

		$pagin_fields = array(
			'have_pagination',
			'have_slider',
		);

		return array_diff_key( $args, array_flip( (array) $pagin_fields ) );
	}
}


if ( ! function_exists( 'publisher_pagin_create_query_args' ) ) {
	/**
	 * Handy function to create master listing query args
	 *
	 * @param array $atts
	 * @param int   $paged
	 *
	 * @return bool
	 */
	function publisher_pagin_create_query_args( &$atts, $paged = 1 ) {

		$args = array();

		// order_by
		if ( ! empty( $atts['order_by'] ) ) {
			$args = publisher_get_order_filter_query( $atts['order_by'] );
		}

		// order
		if ( ! empty( $atts['order'] ) ) {
			$args['order'] = $atts['order'];
		}

		// post type
		if ( ! empty( $atts['post_type'] ) ) {
			$args['post_type'] = $atts['post_type'];
		}

		// posts per page
		if ( ! empty( $atts['count'] ) && intval( $atts['count'] ) > 0 ) {
			$args['posts_per_page'] = $atts['count'];
		}

		// paged
		if ( isset( $atts['paginate'] ) && substr( $atts['paginate'], 0, 6 ) === 'simple' ) {
			$paged = $args['paged'] = bf_get_query_var_paged();
		}

		// offset
		if ( ! empty( $atts['offset'] ) ) {
			if ( $paged > 1 ) {
				$args['offset'] = intval( $atts['offset'] ) + ( ( $paged - 1 ) * $args['posts_per_page'] );
			} else {
				$args['offset'] = intval( $atts['offset'] );
			}
		}

		// Category
		if ( ! empty( $atts['category'] ) ) {
			$cat = get_category( $atts['category'] );

			if ( $cat && ! is_wp_error( $cat ) ) {
				$args['cat'] = $atts['category'];
			}
		}

		// Tag
		if ( ! empty( $atts['tag'] ) ) {

			if ( is_array( $atts['tag'] ) ) {
				$tags = $atts['tag'];
			} else {
				$tags = explode( ',', $atts['tag'] );
			}

			// collect only valid tags
			$valid_tags = array();
			foreach ( $tags as $_tag ) {
				$tag = get_tag( $_tag );
				if ( $tag && ! is_wp_error( $tag ) ) {
					$valid_tags[] = $tag->term_id;
				}
			}

			$args['tag__in'] = $valid_tags;
		}

		// Post id filters
		if ( ! empty( $atts['post_ids'] ) ) {

			if ( is_array( $atts['post_ids'] ) ) {
				$post_id_array = $atts['post_ids'];
			} else {
				$post_id_array = explode( ',', $atts['post_ids'] );
			}

			$post_in     = array();
			$post_not_in = array();

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
				$args['post__not_in'] = $post_not_in;
			}

			if ( ! empty( $post_in ) ) {
				$args['post__in'] = $post_in;
				$args['orderby']  = 'post__in';
			}
		}

		// Custom post types
		if ( ! empty( $atts['post_type'] ) ) {
			if ( is_array( $atts['post_type'] ) ) {
				$args['post_type'] = $atts['post_type'];
			} else {
				$args['post_type'] = explode( ',', $atts['post_type'] );
			}
		}

		// Time filter
		if ( ! empty( $atts['time_filter'] ) ) {
			$args['date_query'] = publisher_get_time_filter_query( $atts['time_filter'] );
		}

		if ( ! isset( $args['ignore_sticky_posts'] ) ) {
			$args['ignore_sticky_posts'] = TRUE;
		}

		if ( isset( $atts['category__in'] ) ) {
			$args['category__in'] = array_map( 'absint', (array) $atts['category__in'] );
		}

		if ( isset( $atts['post__not_in'] ) ) {
			$args['post__not_in'] = array_map( 'absint', (array) $atts['post__not_in'] );
		}

		if ( isset( $atts['author'] ) ) {
			$args['author'] = intval( $atts['author'] );
		}

		return $args;
	} // publisher_pagin_create_query_args
}


if ( ! function_exists( 'publisher_theme_pagin_manager' ) ) {

	/**
	 * Get Publisher_Theme_Listing_Pagin_Manager Class instance
	 *
	 * @return Publisher_Theme_Listing_Pagin_Manager
	 */
	function publisher_theme_pagin_manager() {
		return Publisher_Theme_Listing_Pagin_Manager::Run();
	}  // publisher_theme_pagin_manager
}


if ( ! function_exists( 'publisher_pagin_hash_generate' ) ) {

	/**
	 * Generate unique hash for input data
	 *
	 * @param array|object $array
	 *
	 * @return bool|string hash string on success or false otherwise
	 */
	function publisher_pagin_hash_generate( $array ) {

		if ( is_object( $array ) ) {
			$array = get_object_vars( $array );
		} else if ( ! is_array( $array ) ) {
			return FALSE;
		}
		$keys_to_remove = array(
			'paged' => '',
		);

		//remove some indexes
		$array = array_diff_key( $array, $keys_to_remove );
		$array = map_deep( $array, 'publisher_pagin_hash_data_filter' );
		ksort( $array );

		$hash = substr( wp_hash( serialize( $array ), 'nonce' ), 5, 7 );

		return $hash;
	}
}


if ( ! function_exists( 'publisher_pagin_hash_verify' ) ) {
	/**
	 * Verify Hash
	 *
	 * @param string       $hash
	 * @param array|object $data
	 *
	 * @return bool true on success or false on failure.
	 */
	function publisher_pagin_hash_verify( $hash, $data ) {
		return $hash === publisher_pagin_hash_generate( $data );
	}
}


if ( ! function_exists( 'publisher_pagin_hash_data_filter' ) ) {
	/**
	 * Filters data for making correct hash from it
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	function publisher_pagin_hash_data_filter( $data ) {
		$new_data = filter_var( $data, FILTER_VALIDATE_INT );

		return $new_data === FALSE ? $data : $new_data;
	}
}


if ( ! function_exists( 'publisher_pagin_js_data_filter' ) ) {
	/**
	 * Converts boolean values to it for JS of pagination
	 *
	 * @param $data
	 *
	 * @return string
	 */
	function publisher_pagin_js_data_filter( $data ) {
		return is_bool( $data ) ? (int) $data : $data;
	}
}
