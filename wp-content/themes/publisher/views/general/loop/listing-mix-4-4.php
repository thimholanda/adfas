<?php
/**
 * listing-mix-4-4.php
 *---------------------------
 * Mix listing 4-4 template
 */

$_posts_count = publisher_get_prop( 'posts-count', 0 );
?>
<div class="listing listing-mix-4-4 clearfix <?php publisher_echo_prop( 'listing-class' ); ?>">
	<?php

	publisher_set_prop( 'show-excerpt', TRUE );

	$_counter = 0;
	while( publisher_have_posts() ) {

		publisher_set_prop( 'posts-count', 1 );

		if ( publisher_have_posts() ) {
			$_counter ++;
			publisher_set_prop( 'listing-class', 'columns-1' );
			publisher_get_view( 'loop', 'listing-classic-2' );
		}

		publisher_unset_prop( 'posts-counter' );

		publisher_set_prop( 'posts-count', 2 );

		if ( publisher_have_posts() ) {
			$_counter += 2;
			publisher_set_prop( 'listing-class', 'columns-2' );
			publisher_get_view( 'loop', 'listing-grid-1' );
		}

		publisher_unset_prop( 'posts-counter' );

		if ( $_posts_count && $_counter >= $_posts_count ) {
			break;
		}
	}

	?>
</div>
