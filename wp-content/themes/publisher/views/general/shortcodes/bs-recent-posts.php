<?php
/**
 * bs-recent-posts.php
 *---------------------------
 * The template to show recent posts shortcode/widget
 *
 * [bs-recent-posts] shortcode
 *
 */

$atts = publisher_get_prop( 'shortcode-bs-recent-posts-atts' );

// Default 5 count
if ( empty( $atts['count'] ) ) {
	$atts['count'] = 5;
}

$args = array(
	'posts_per_page'      => $atts['count'],
	'ignore_sticky_posts' => TRUE,
);

// Category Filter
if ( $atts['category'] != '' ) {
	$args['cat'] = $atts['category'];
	publisher_set_prop( 'listing-prim-cat', $atts['category'] );
}

// Tag filter
if ( $atts['tag'] != '' ) {
	$args['tag__in'] = explode( ',', $atts['tag'] );
}

// Prepares time filter
if ( $atts['time_filter'] != '' ) {
	$args['date_query'] = publisher_get_time_filter_query( $atts['time_filter'] );
}

// Prepares time filter
if ( $atts['order'] != 'recent' ) {
	$args = publisher_get_order_filter_query( $atts['order'], $args );
}

// Custom post type support
if ( $atts['post_type'] != '' ) {
	$args['post_type'] = explode( ',', $atts['post_type'] );
} else {
	$args['post_type'] = 'post';
}

// Init query
$query = new WP_Query( $args );
publisher_set_query( $query );

?>
	<div class="bs-theme-shortcode bs-recent-posts">
		<?php


		switch ( $atts['listing'] ) {

			case 'listing-thumbnail-2':
				publisher_set_prop( 'listing-class', 'columns-2' );
				publisher_get_view( 'loop', $atts['listing'] );
				break;

			case 'listing-text-1':
				publisher_set_prop( 'listing-class', 'columns-1' );
				publisher_get_view( 'loop', $atts['listing'] );
				break;

			case 'listing-text-2':
				publisher_set_prop( 'listing-class', 'columns-1' );
				publisher_get_view( 'loop', $atts['listing'] );
				break;

			default:
				publisher_set_prop( 'meta-show-comments', FALSE );
				publisher_get_view( 'loop', 'widget-' . $atts['listing'] );
				break;

		}

		?>
	</div>
<?php

publisher_clear_query();
publisher_clear_props();
