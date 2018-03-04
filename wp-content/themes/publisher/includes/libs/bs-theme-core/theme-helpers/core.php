<?php
/**
 * Core functions for BetterTemplate
 *
 * @package    BetterTemplate
 * @author     BetterStudio <info@betterstudio.com>
 * @copyright  Copyright (c) 2015, BetterStudio
 */

//
//
// Global variable that used for save blocks property
//
//

// Used to save all template properties
$GLOBALS['publisher_theme_core_props_cache'] = array();

// Used to save globals variables
$GLOBALS['publisher_theme_core_globals_cache'] = array();

// Used to save template query
$GLOBALS['publisher_theme_core_query'] = NULL;


if ( ! function_exists( 'publisher_get_theme_panel_id' ) ) {
	/**
	 * Returns theme panel id, This should be override in theme
	 *
	 * @return string
	 */
	function publisher_get_theme_panel_id() {
		return Better_Framework::options()->get_theme_panel_id();
	}
}


if ( ! function_exists( 'publisher_get_option' ) ) {
	/**
	 * Used to get theme panel options
	 *
	 * @param $field_id
	 *
	 * @return mixed|null
	 */
	function publisher_get_option( $field_id ) {
		return bf_get_option( $field_id, publisher_get_theme_panel_id() );
	}
}


if ( ! function_exists( 'publisher_echo_option' ) ) {
	/**
	 * Used to get theme panel options
	 *
	 * @param $field_id
	 *
	 * @return mixed|null
	 */
	function publisher_echo_option( $field_id ) {
		echo publisher_get_option( $field_id ); // escaped before
	}
}


if ( ! function_exists( 'publisher_get_style' ) ) {
	/**
	 * Used to get current active style.
	 *
	 * Default style: general
	 *
	 * @return  string
	 */
	function publisher_get_style() {
		return 'general'; // 'default' is also valid for general
	}
}


if ( ! function_exists( 'publisher_get_view' ) ) {
	/**
	 * Used to print view/partials.
	 *
	 * @param   string $folder Folder name
	 * @param   string $file   File name
	 * @param   string $style  Style
	 * @param   bool   $echo   Echo the result or not
	 *
	 * @return null|string
	 */
	function publisher_get_view( $folder, $file = '', $style = '', $echo = TRUE ) {

		// If style is not provided
		if ( empty( $style ) ) {
			// Get current style if not defined
			$style = publisher_get_style();
		}

		if ( $style == 'default' ) {
			$style = 'general';
		} // fix for new structure

		// If file name passed as folder argument for short method call
		if ( ! empty( $folder ) && empty( $file ) ) {
			$file   = $folder;
			$folder = '';
		}


		$templates = array();

		// File is inside another folder
		if ( ! empty( $folder ) ) {

			$templates[] = 'views/' . $style . '/' . $folder . '/' . $file . '.php';

			// Fallback to general file
			if ( $style != 'general' ) {
				$templates[] = 'views/general/' . $folder . '/' . $file . '.php';
			}

		} // File is inside style base folder
		else {

			$templates[] = 'views/' . $style . '/' . $file . '.php';

			// Fallback to general file
			if ( $style != 'general' ) {
				$templates[] = 'views/general/' . $file . '.php';
			}

		}

		$template = locate_template( $templates, FALSE, FALSE );

		if ( $echo == FALSE ) {
			ob_start();
		}

		do_action( 'publisher-theme-core/view/before/' . $file );

		if ( ! empty( $template ) ) {
			include $template;
		}

		do_action( 'publisher-theme-core/view/after/' . $file );

		if ( $echo == FALSE ) {
			return ob_get_clean();
		}

	} // publisher_get_view
}


//
//
// Blocks properties
//
//


if ( ! function_exists( 'publisher_get_prop' ) ) {
	/**
	 * Used to get a property value.
	 *
	 * @param   string $id
	 * @param   mixed  $default
	 *
	 * @return  mixed
	 */
	function publisher_get_prop( $id, $default = NULL ) {

		global $publisher_theme_core_props_cache;

		if ( isset( $publisher_theme_core_props_cache[ $id ] ) ) {
			return $publisher_theme_core_props_cache[ $id ];
		} else {
			return $default;
		}
	}
}


if ( ! function_exists( 'publisher_echo_prop' ) ) {
	/**
	 * Used to print a property value.
	 *
	 * @param   string $id
	 * @param   mixed  $default
	 *
	 * @return  mixed
	 */
	function publisher_echo_prop( $id, $default = NULL ) {

		global $publisher_theme_core_props_cache;

		if ( isset( $publisher_theme_core_props_cache[ $id ] ) ) {
			echo $publisher_theme_core_props_cache[ $id ]; // escaped before
		} else {
			echo $default; // escaped before
		}
	}
}


if ( ! function_exists( 'publisher_get_prop_class' ) ) {
	/**
	 * Used to get block class property.
	 *
	 * @return string
	 */
	function publisher_get_prop_class() {

		global $publisher_theme_core_props_cache;

		if ( isset( $publisher_theme_core_props_cache['class'] ) ) {
			return $publisher_theme_core_props_cache['class'];
		} else {
			return '';
		}
	}
}


if ( ! function_exists( 'publisher_get_prop_thumbnail_size' ) ) {
	/**
	 * Used to get block thumbnail size property.
	 *
	 * @param   string $default
	 *
	 * @return  string
	 */
	function publisher_get_prop_thumbnail_size( $default = 'thumbnail' ) {

		global $publisher_theme_core_props_cache;

		if ( isset( $publisher_theme_core_props_cache['thumbnail-size'] ) ) {
			return $publisher_theme_core_props_cache['thumbnail-size'];
		} else {
			return $default;
		}
	}
}


if ( ! function_exists( 'publisher_set_prop' ) ) {
	/**
	 * Used to set a block property value.
	 *
	 * @param   string $id
	 * @param   mixed  $value
	 *
	 * @return  mixed
	 */
	function publisher_set_prop( $id, $value ) {

		global $publisher_theme_core_props_cache;

		$publisher_theme_core_props_cache[ $id ] = $value;
	}
}


if ( ! function_exists( 'publisher_set_prop_class' ) ) {
	/**
	 * Used to set a block class property value.
	 *
	 * @param   mixed $value
	 * @param   bool  $clean
	 *
	 * @return  mixed
	 */
	function publisher_set_prop_class( $value, $clean = FALSE ) {

		global $publisher_theme_core_props_cache;

		if ( $clean ) {
			$publisher_theme_core_props_cache['class'] = $value;
		} else {
			$publisher_theme_core_props_cache['class'] = $value . ' ' . publisher_get_prop_class();
		}
	}
}


if ( ! function_exists( 'publisher_set_prop_thumbnail_size' ) ) {
	/**
	 * Used to set a block property value.
	 *
	 * @param   mixed $value
	 *
	 * @return  mixed
	 */
	function publisher_set_prop_thumbnail_size( $value = 'thumbnail' ) {

		global $publisher_theme_core_props_cache;

		$publisher_theme_core_props_cache['thumbnail-size'] = $value;
	}
}


if ( ! function_exists( 'publisher_set_prop_count_multi_column' ) ) {
	/**
	 * Used For Finding Best Count For Multiple columns
	 *
	 * @param int $post_counts
	 * @param int $columns
	 * @param int $current_column
	 */
	function publisher_set_prop_count_multi_column( $post_counts = 0, $columns = 1, $current_column = 1 ) {

		if ( $post_counts == 0 ) {
			return;
		}

		$count = floor( $post_counts / $columns );

		$reminder = $post_counts % $columns;

		if ( $reminder >= $current_column ) {
			$count ++;
		}

		publisher_set_prop( "posts-count", $count );
	}
}


if ( ! function_exists( 'publisher_unset_prop' ) ) {
	/**
	 * Used to remove a property from block property list.
	 *
	 * @param   string $id
	 *
	 * @return  mixed
	 */
	function publisher_unset_prop( $id ) {

		global $publisher_theme_core_props_cache;

		unset( $publisher_theme_core_props_cache[ $id ] );
	}
}


if ( ! function_exists( 'publisher_clear_props' ) ) {
	/**
	 * Used to clear all properties.
	 *
	 * @return  void
	 */
	function publisher_clear_props() {

		global $publisher_theme_core_props_cache;

		$publisher_theme_core_props_cache = array();
	}
}


//
//
// Global Variables
//
//


if ( ! function_exists( 'publisher_set_global' ) ) {
	/**
	 * Used to set a global variable.
	 *
	 * @param   string $id
	 * @param   mixed  $value
	 *
	 * @return  mixed
	 */
	function publisher_set_global( $id, $value ) {

		global $publisher_theme_core_globals_cache;

		$publisher_theme_core_globals_cache[ $id ] = $value;
	}
}


if ( ! function_exists( 'publisher_unset_global' ) ) {
	/**
	 * Used to remove a global variable.
	 *
	 * @param   string $id
	 *
	 * @return  mixed
	 */
	function publisher_unset_global( $id ) {

		global $publisher_theme_core_globals_cache;

		unset( $publisher_theme_core_globals_cache[ $id ] );
	}
}


if ( ! function_exists( 'publisher_get_global' ) ) {
	/**
	 * Used to get a global value.
	 *
	 * @param   string $id
	 * @param   mixed  $default
	 *
	 * @return  mixed
	 */
	function publisher_get_global( $id, $default = NULL ) {

		global $publisher_theme_core_globals_cache;

		if ( isset( $publisher_theme_core_globals_cache[ $id ] ) ) {
			return $publisher_theme_core_globals_cache[ $id ];
		} else {
			return $default;
		}
	}
}


if ( ! function_exists( 'publisher_echo_global' ) ) {
	/**
	 * Used to print a global value.
	 *
	 * @param   string $id
	 * @param   mixed  $default
	 *
	 * @return  mixed
	 */
	function publisher_echo_global( $id, $default = NULL ) {

		global $publisher_theme_core_globals_cache;

		if ( isset( $publisher_theme_core_globals_cache[ $id ] ) ) {
			echo $publisher_theme_core_globals_cache[ $id ]; // escaped before
		} else {
			echo $default; // escaped before
		}
	}
}


if ( ! function_exists( 'publisher_clear_globals' ) ) {
	/**
	 * Used to clear all properties.
	 *
	 * @return  void
	 */
	function publisher_clear_globals() {

		global $publisher_theme_core_globals_cache;

		$publisher_theme_core_globals_cache = array();
	}
}


//
//
// Queries
//
//


if ( ! function_exists( 'publisher_get_query' ) ) {
	/**
	 * Used to get current query.
	 *
	 * @return  WP_Query|null
	 */
	function publisher_get_query() {

		global $publisher_theme_core_query;

		// Add default query to Publisher query if its not added or default query is used.
		if ( ! is_a( $publisher_theme_core_query, 'WP_Query' ) ) {
			global $wp_query;

			$publisher_theme_core_query = &$wp_query;
		}

		return $publisher_theme_core_query;
	}
}


if ( ! function_exists( 'publisher_set_query' ) ) {
	/**
	 * Used to get current query.
	 *
	 * @param   WP_Query $query
	 */
	function publisher_set_query( &$query ) {

		global $publisher_theme_core_query;

		$publisher_theme_core_query = $query;
	}
}


if ( ! function_exists( 'publisher_clear_query' ) ) {
	/**
	 * Used to get current query.
	 *
	 * @param   bool $reset_query
	 */
	function publisher_clear_query( $reset_query = TRUE ) {

		global $publisher_theme_core_query;

		$publisher_theme_core_query = NULL;

		// This will remove obscure bugs that occur when the previous wp_query object is not destroyed properly before another is set up.
		if ( $reset_query ) {
			wp_reset_postdata();
		}
	}
}


if ( ! function_exists( 'publisher_have_posts' ) ) {
	/**
	 * Used for checking have posts in advanced way!
	 */
	function publisher_have_posts() {

		// Add default query to better_template query if its not added or default query is used.
		if ( ! publisher_get_query() instanceof WP_Query ) {
			global $wp_query;

			publisher_set_query( $wp_query );
		}

		// If count customized
		if ( publisher_get_prop( 'posts-count', NULL ) != NULL ) {
			if ( publisher_get_prop( 'posts-counter', 1 ) > publisher_get_prop( 'posts-count' ) ) {
				return FALSE;
			} else {
				if ( publisher_get_query()->current_post + 1 < publisher_get_query()->post_count ) {
					return TRUE;
				} else {
					return FALSE;
				}
			}
		} else {
			return publisher_get_query()->current_post + 1 < publisher_get_query()->post_count;
		}
	}
}


if ( ! function_exists( 'publisher_the_post' ) ) {
	/**
	 * Custom the_post for custom counter functionality
	 */
	function publisher_the_post() {

		// If count customized
		if ( publisher_get_prop( 'posts-count', NULL ) != NULL ) {
			publisher_set_prop( 'posts-counter', absint( publisher_get_prop( 'posts-counter', 1 ) ) + 1 );
		}

		// Do default the_post
		publisher_get_query()->the_post();
	}
}


if ( ! function_exists( 'publisher_is_main_query' ) ) {
	/**
	 * Detects and returns that current query is main query or not? with support of better_{get|set}_query
	 *
	 * @return  WP_Query|null
	 */
	function publisher_is_main_query() {

		global $publisher_theme_core_query;

		// Add default query to better_template query if its not added or default query is used.
		if ( ! is_a( $publisher_theme_core_query, 'WP_Query' ) ) {
			global $wp_query;

			return $wp_query->is_main_query();
		}

		return $publisher_theme_core_query->is_main_query();
	}
}
